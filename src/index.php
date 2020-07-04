<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Proyecto Poli</title>
    <link rel="icon" type="image/jpg" href="img/favicon.jpg">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
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
</BR></BR></BR>
<div class="container">


<div class="card">
  <div class="card-header">
    Proyecto Integracion Continua, Politecnico Gran colombiano
  </div>
  <div class="card-body">
    <h5 class="card-title">Bienvenidos a Todos!</h5>
    <p class="card-text">Este es nuestro proyecto para aplicar la integracion continua</p></br>
    <p class="card-text">En esta seccion usted podra hacer la gestion de los empleados de nuestra base de datos, aca puedes podificar crear editar y eliminar, pero la funcion principal de la seccion es crear empleados</p>
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
    <div class="container">
        <div class="container-fluid">
            <div>
                <div class="card">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Empleados</h2><a href="create.php" class="btn btn-success">Agregar nuevo empleado</a>
                        
                    </div>
                    <?php
                    // archivo de configuración
                    require_once "config.php";
                    
                    // Intente seleccionar la ejecución de la consulta
                    $sql = "SELECT * FROM employees";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Nombre</th>";
                                        echo "<th>Dirección</th>";
                                        echo "<th>Sueldo</th>";
                                        echo "<th>Acción</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";
                                        echo "<td>" . $row['salary'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?id=". $row['id'] ."' title='Ver' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update.php?id=". $row['id'] ."' title='Actualizar' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Borrar' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // resultados
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No hay empleados registrados.</em></p>";
                        }
                    } else{
                        echo "ERROR: no se pudo ejecutar $sql. " . mysqli_error($link);
                    }
 
                    // Cerrar conexión
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</br></br></br>
</body>
</html>
