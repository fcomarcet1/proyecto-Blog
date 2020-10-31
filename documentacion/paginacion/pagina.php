<!DOCTYPE html>
<html>
<head>
<title>Paginación usando PHP MySqli</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<meta charset="utf-8">
<style type="text/css">
  .pagina {
   padding:8px 16px;
   border:1px solid #ccc;
   color:#333;
   font-weight:bold;
  }
</style>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="./">BaulPHP</a> </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li ><a href="./">INICIO <span class="sr-only">(current)</span></a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>Paginación usando PHP MySqli</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
<div class="panel-body">


<?php
$conexion = mysqli_connect("localhost", "root", "", "php_paginacion");

/****************************************************** */
/***********PAGINACION***********************************/

//nº de registros por pagina
$record_per_page = 5;

//variable pagina
$pagina = '';
if (isset($_GET["pagina"])) {

    $pagina = $_GET["pagina"];
} 
else {
     $pagina = 1;
 }

$start_from = ($pagina - 1) * $record_per_page ;

$query = "SELECT * FROM alumnos order by alumno_id DESC LIMIT $start_from, $record_per_page";
$result = mysqli_query($conexion, $query);

/********************************************************************************* */
?>

<div class="table-responsive">
    <table class="table table-bordered">
     <tr>
      <th>ID</th>
      <th>Nombres</th>
      <th>Teléfonos</th>
     </tr>
     <?php
     $number=0;
     while ($row = mysqli_fetch_array($result)) {
         $number++; ?>
     <tr>
      <td><?php echo $number; ?></td>
      <td><?php echo $row["nombres"]; ?></td>
      <td><?php echo $row["telefonos"]; ?></td>
     </tr>
     <?php
     }
     ?>
    </table>
     <div align="center">
    <br />
    
    <?php
    $page_query = "SELECT * FROM alumnos ORDER BY alumno_id DESC";
    $page_result = mysqli_query($conexion, $page_query);
    $total_records = mysqli_num_rows($page_result);

    $total_pages = ceil($total_records/$record_per_page);

    $start_loop = $pagina;
    $diferencia = $total_pages - $pagina;

    if ($diferencia <= 5) {
        $start_loop = $total_pages - 5;
    }

    $end_loop = $start_loop + 4;

    if ($pagina > 1) {
        echo "<a class='pagina' href='pagina.php?pagina=1'>Primera</a>";
        echo "<a class='pagina' href='pagina.php?pagina=".($pagina - 1)."'><<</a>";
    }
    for ($i=$start_loop; $i<=$end_loop; $i++) {
        echo "<a class='pagina' href='pagina.php?pagina=".$i."'>".$i."</a>";
    }
    if ($pagina <= $end_loop) {
        echo "<a class='pagina' href='pagina.php?pagina=".($pagina + 1)."'>>></a>";
        echo "<a class='pagina' href='pagina.php?pagina=".$total_pages."'>Última</a>";
    }
    
    
    ?>
    </div>
    <br /><br />

 </div>


</div>
</div>
  </div>
</div>
<div class="panel-footer">
  <div class="container">
    <p>Códigos <a href="https://www.baulphp.com/" target="_blank">BaulPHP</a></p>
  </div>
</div>
</body>
</html>