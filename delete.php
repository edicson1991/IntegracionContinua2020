<?php
// proceso de eliminar datos después de la confirmación
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // archivo de configuración
    require_once "config.php";
    
    // Preparando la declaración para eliminar
    $sql = "DELETE FROM employees WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // vincular las variables
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // establecer parametros
        $param_id = trim($_POST["id"]);
        
        // ejecutando la declaración
        if(mysqli_stmt_execute($stmt)){
            // eliminado exitosa. Redirige al index
            header("location: index.php");
            exit();
        } else{
            echo "Oops! Algo salió mal. Intentelo más tarde.";
        }
    }
     
    // Cerrar declaración
    mysqli_stmt_close($stmt);
    
    // Cerrar conexión
    mysqli_close($link);
} else{
    // Verificar la existencia de ID
    if(empty(trim($_GET["id"]))){
        // URL no contiene parametro ID. Redirige a la pagina de error.
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Borrar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Borrar Registro</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Está seguro que deseas borrar el registro</p><br>
                            <p>
                                <input type="submit" value="Si" class="btn btn-danger">
                                <a href="index.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>