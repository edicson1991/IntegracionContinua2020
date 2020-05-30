<?php
// archivo de configuración
require_once "config.php";
 
// Definir variables
$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";
 
// Procesando datos del formulario
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // valor de entrada
    $id = $_POST["id"];
    
    // Validar nombre
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Por favor ingrese un nombre.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Por favor ingrese un nombre válido.";
    } else{
        $name = $input_name;
    }
    
    // Validar dirección
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Por favor ingrese una dirección.";     
    } else{
        $address = $input_address;
    }
    
    // Validar salario
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Por favor ingrese el monto del salario del empleado.";     
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Por favor ingrese un valor positivo y válido.";
    } else{
        $salary = $input_salary;
    }
    
    // Verifique los errores de entrada antes de insertar en la base de datos
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // preparando la declaricion de acualizar
        $sql = "UPDATE employees SET name=?, address=?, salary=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // vincular la declaraciones con los parametros
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_address, $param_salary, $param_id);
            
            // obtener parametros
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            $param_id = $id;
            
            // intentar ejecutar la declaración
            if(mysqli_stmt_execute($stmt)){
                // actualización exitosa. Redirige al index
                header("location: index.php");
                exit();
            } else{
                echo "Algo salió mal, intente más tarde.";
            }
        }
         
        // Cerrar declaración
        mysqli_stmt_close($stmt);
    }
    
    // Cerrar conexión
    mysqli_close($link);
} else{
    // verificar la existencia del id
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Preparando la declaración
        $sql = "SELECT * FROM employees WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // vincular variables a la declaración
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // obtener parametros
            $param_id = $id;
            
            // intentar ejecutar declaración
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // campos individuales
                    $name = $row["name"];
                    $address = $row["address"];
                    $salary = $row["salary"];
                } else{
                    // URL no contiene id valido. redirige a la pagina de error
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Algo salió mal. Por favor, intente más tarde.";
            }
        }
        
        // Cerrar declaración
        mysqli_stmt_close($stmt);
        
        // Cerrar conexión
        mysqli_close($link);
    }  else{
        //  Redirige a la pagina de error
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Registro</title>
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
                        <h2>Actualizar Registro</h2>
                    </div>
                    <p>Edite los valores de entrada y envíe para actualizar el registro.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Direccion</label>
                            <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
                            <span class="help-block"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($salary_err)) ? 'has-error' : ''; ?>">
                            <label>Sueldo</label>
                            <input type="text" name="salary" class="form-control" value="<?php echo $salary; ?>">
                            <span class="help-block"><?php echo $salary_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
