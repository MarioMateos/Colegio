
<?php

include '../../database_connection/database_connection.php';

$mysql_query_1 = "SELECT * FROM students_assumption";


if(isset($_POST["btn_search"])){

  $search_by = $_POST["filter-by"];
  $search_term = $_POST["txt_search_term"];

  if($search_by!=""&& $search_term!=""){

    switch ($search_by) {
      case 'Filter By':
        $mysql_query_1 = "SELECT * FROM students_assumption";

        break;

      case 'First Name':

      $mysql_query_1 = "SELECT * FROM students_assumption WHERE first_name LIKE '%$search_term%'";

      break;

      case 'Last Name':

      $mysql_query_1 = "SELECT * FROM students_assumption WHERE last_name LIKE '%$search_term%'";

      break;

      case 'Index Number':

      $mysql_query_1 = "SELECT * FROM students_assumption WHERE index_number LIKE '%$search_term%'";

        break;

      case 'Programme':

      $mysql_query_1 = "SELECT * FROM students_assumption WHERE programme LIKE '%$search_term%'";

        break;

      case 'Level':

      $mysql_query_1 = "SELECT * FROM students_assumption WHERE level LIKE '%$search_term%'";

        break;

      case 'Session':

      $mysql_query_1 = "SELECT * FROM students_assumption WHERE session LIKE '%$search_term%'";


      case 'Region':

      $mysql_query_1 = "SELECT * FROM students_assumption WHERE company_region LIKE '%$search_term%'";

        break;

    case 'Company':

    $mysql_query_1 = "SELECT * FROM students_assumption WHERE company_name LIKE '%$search_term%'";

      break;

      default:

      $mysql_query_1 = "SELECT * FROM students_assumption";


        break;
    }
  }
}

 ?>


<!DOCTYPE html>
<html lang="en" class="bg-pink">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>tusolutionweb</title>

  <link rel="stylesheet" href="../../css/bootstrap-theme.min.css"/>
  <link rel="stylesheet" href="../../css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../../css/main_page_style.css"/>
  <link rel="stylesheet" href="students_assumptions.css"/>

  <script type="text/javascript" src="../../js/jquery-3.1.1.min.js"/></script>
  <script type="text/javascript" src="../../js/bootstrap.min.js"/></script>

</head>
<body>

<div id="top-navigation">
<div id="header_logo"><img src="../../img/header_log.png" class="img-responsive" alt="logo" style="float:left;width:150px; height:50px;position:relative;left:20px"/></div>
<div id="student_name"><span style="color:rgb(255, 198, 0);font-size:1.1em"><em>Bienvenido,</em>&nbsp; </span><span style="font-family:serif"><?php echo "Admin"?></span></div>
</div>

<div id="left_side_bar">
<ul id="menu_list">
  <a class="menu_items_link" href="../view_registered_students/view_registered_students.php"><li class="menu_items_list">Estudiantes Registrados</li></a>
  <a class="menu_items_link" href="students_assumptions.php"><li class="menu_items_list" style="background-color:orange;padding-left:16px">Supuestos del estudiante</li></a>
  <a class="menu_items_link" href="../assign_supervisors/assign_supervisors.php"><li class="menu_items_list">Asignar supervisores
</li></a>
  <a class="menu_items_link" href="../visiting_score/visiting_supervisors_score.php"><li class="menu_items_list">Supervisores visitantes de puntuaciones</li></a>
  <a class="menu_items_link" href="../company_score/company_supervisor_score.php"><li class="menu_items_list">Puntuación del supervisor de la compañía
</li></a>
  <a class="menu_items_link" href="../change_password/change_password.php"><li class="menu_items_list">Cambia la contraseña
</li></a>
  <a class="menu_items_link" href="../../index.php"><li class="menu_items_list">Cerrar sesión
</li></a>
</ul>
</div>

<div class="container-fluid">
<div id="main_content">
    <div class = "panel">
       <div class = "panel-heading phead">
          <h2 class = "panel-title ptitle"> Asunción de estudiantes
 </h2>
       </div>
            <div class = "panel-body pbody">

              <form method="post" action="">
                  <div class="row">
                      <div class="col-xs-5 col-xs-offset-6">
              		    <div class="input-group">
                              <div class="input-group-btn search-panel">
                                  <select class="form-control search_by_side" name="filter-by">
                                    <option>Filtrado por</option>
                                    <option>Nombre</option>
                                    <option>Apellido</option>
                                    <option>Número de índice</option>
                                    <option>Programa</option>
                                    <option>Nivel</option>
                                    <option>Sesión</option>
                                    <option>Región</option>
                                    <option>Empresa</option>


                                  </select>

                              </div>
                              <input type="hidden" name="search_param" value="all" id="search_param">
                              <input type="text" class="form-control" name="txt_search_term" placeholder="Search term...">
                              <span class="input-group-btn">
                                  <input type="submit" class="btn btn-primary" value="search" name="btn_search" id="btn_search">
                              </span>
                            </form>
                          </div>
                      </div>
              	</div>

              <br>
              <table class="table table-bordered table-hover">

                  <thead>
                    <tr>
                        <th style="text-align:center">Nombre del estudiante</th>
                        <th style="text-align:center">Número de índice</th>
                        <th style="text-align:center">Programa</th>
                        <th style="text-align:center">Nivel</th>
                        <th style="text-align:center">Sesión</th>
                        <th style="text-align:center">Nombre del supervisor</th>
                        <th style="text-align:center">Supervisor de contacto</th>
                        <th style="text-align:center" width="5%">Supervisor E-mail</th>
                        <th style="text-align:center">nombre de empresa</th>
                        <th style="text-align:center">Región de la compañía</th>
                        <th style="text-align:center">Dirección de la empresa</th>

                    </tr>

                  </thead>

                  <tbody>
                    <?php
                    $mysql_query_command_1 = $mysql_query_1;
                    $execute_result_query = mysqli_query($conn,$mysql_query_command_1);
                    while ($row_set = mysqli_fetch_array($execute_result_query)){

                      echo "<tr style='text-align:center;font-size:1.1em'>";

                      echo "<td>".$row_set["first_name"]."&nbsp;".$row_set["last_name"]."</td>";
                      echo "<td>".$row_set["index_number"]."</td>";
                      echo "<td>".$row_set["programme"]."</td>";
                      echo "<td>".$row_set["level"]."</td>";
                      echo "<td>".$row_set["session"]."</td>";
                      echo "<td>".$row_set["supervisor_name"]."</td>";
                      echo "<td>".$row_set["supervisor_contact"]."</td>";
                      echo "<td>".$row_set["supervisor_email"]."</td>";
                      echo "<td>".$row_set["company_name"]."</td>";
                      echo "<td>".$row_set["company_region"]."</td>";
                      echo "<td>".$row_set["company_address"]."</td>";


                      echo "</tr>";

                    }

                     ?>
                  </tbody>
            </table>
     </div>
   </div>
 </div>
 </div>

</body>
</html>
