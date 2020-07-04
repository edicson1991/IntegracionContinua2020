<?php
// Verifique la existencia del parámetro id antes de seguir procesando
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // archivo de configuración
    require_once "config.php";
    
    // Preparar la declaración
    $sql = "SELECT * FROM employees WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // vincular las variables
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Establecer parámetros
        $param_id = trim($_GET["id"]);
        
        // Intentar ejecutar la declaración preparada
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Obtener la fila de resultados como una matriz asociativa. Desde el conjunto de resultados contiene solo una fila, no necesitamos usar el ciclo while */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Campo individual
                $name = $row["name"];
                $address = $row["address"];
                $salary = $row["salary"];
            } else{
                // URL no contiene id valido. Redirige a la página de error
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Cerrar declaracion
    mysqli_stmt_close($stmt);
    
    // Cerrar conexión
    mysqli_close($link);
} else{
    // URL no contiene id valido. Redirige a la página de error
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Empleado</title>
    <link rel="icon" type="image/jpg" href="img/favicon.jpg">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Gestion de Empleados<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Contenido HTML/acercadelproyecto.html">Acerca del proyecto</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Contenido HTML/Autoresproyecto.html">Autores del proyecto</a>
      </li>

    </ul>
  </div>
</nav>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Ver Empleado</h1>
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <p class="form-control-static"><?php echo $row["name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <p class="form-control-static"><?php echo $row["address"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Sueldo</label>
                        <p class="form-control-static"><?php echo $row["salary"]; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Volver</a></p>
                </div>
            </div>        
        </div>
    </div>
    <br/>
    <div class="container">


<div class="card">
  <div class="card-header">
    Proyecto Integracion Continua, Politecnico Gran colombiano
  </div>
  <div class="card-body">
    <p class="card-text">Este es nuestro proyecto para aplicar la integracion continua</p></br>
    <p class="card-text">En esta seccion usted podra ver las caracteristicas del empleado registrado</p>
  </div>
</div>

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/poli.png" class="d-block w-100" width="300px" height="400px">
    </div>
    <div class="carousel-item">
      <img src="img/jenkins.png" class="d-block w-100" width="300px" height="450px">
    </div>
    <div class="carousel-item">
      <img src="img/bootstrap.png" class="d-block w-100" width="300px" height="400px">
    </div>
    <div class="carousel-item">
      <img src="img/php.png" class="d-block w-100" width="300px" height="400px">
    </div>
    <div class="carousel-item">
      <img src="img/sql.png" class="d-block w-100" width="300px" height="400px">
    </div>
    <div class="carousel-item">
      <img src="img/html.JPG" class="d-block w-100" width="300px" height="400px">
    </div>
    <div class="carousel-item">
      <img src="img/jquery.png" class="d-block w-100" width="300px" height="400px">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</br></br></br>
</body>
</html>