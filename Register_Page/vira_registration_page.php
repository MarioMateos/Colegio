<?php

include '../database_connection/database_connection.php';

$student_fname = $_COOKIE["student_first_name"];
$student_lname = $_COOKIE["student_last_name"];
$other_name_status = "disabled";
$index_status = "disabled";
$first_name_holder = "";
$last_name_holder = "";
$index_number_holder = "";
$submit_status = "disabled";


  $programmes = array("-","Accountancy","Applied Mathematics","Building Technology","Civil Engineering","Computer Science","Computer Networking",
  "Electrical/Electronic Engineering","Hospitality","Liberal Studies","Marketing","Purchasing & Supply","Secretaryship");

  $faculties = array("-","FAST","FBMS","FOE","FBNE","FHAS");

  $sessions = array("-","Morning","Evening","Weekend");

  $levels = array("-","100","200","300");

  if(isset($_POST["btn-check-receipt"])){
    $entered_receipt_number = $_POST["txtreceipt"];
    $check_receipt = "SELECT * FROM vira_receipts_paid WHERE receipt_number='$entered_receipt_number'";
    $execute_check_receipt = mysqli_query($conn,$check_receipt);
    $get_receipt_details = mysqli_num_rows($execute_check_receipt);
    if($get_receipt_details == 1){
      $other_name_status = "";
      $first_name_holder = $_COOKIE["student_first_name"];
      $last_name_holder = $_COOKIE["student_last_name"];
      $index_number_holder = $_COOKIE["student_index_number"];
      $index_status="";
      $submit_status = "";
    }else{
      $other_name_status="disabled";
      $index_status="disabled";
      $first_name_holder = "";
      $last_name_holder = "";
      $index_number_holder = "";
      $submit_status = "disabled";
    }
  }

  if(isset($_POST["btn_submit"])){
    if($_POST["student_programme"]!="" && $_POST["student_level"]!="" && $_POST["student_session"]!=""){

      $other_name = $_POST["student_other_name"];
      $student_programme_selected = $_POST["student_programme"];
      $student_level_selected = $_POST["student_level"];
      $student_session_selected = $_POST["student_session"];
      $student_index = $_POST["txt_index_number"];
	  $student_faculty = $_POST["student_faculty"];

      $check_user_existence = "SELECT * FROM vira_registration WHERE index_number='$student_index' LIMIT 1";
      $execute_check_existence = mysqli_query($conn,$check_user_existence);
      $check_user = mysqli_num_rows($execute_check_existence);
      if($check_user==1){
       echo "<script>alert('Sorry You Have Registered Already')</script>";
     }else{
       $insert_details_command = "INSERT INTO vira_registration (`id`, `first_name`, `last_name`, `other_name`, `index_number`, `programme`, `level`, `session`,`faculty`,`date`) VALUES (NULL,'$student_fname', '$student_lname', '$other_name','$student_index', '$student_programme_selected', '$student_level_selected', '$student_session_selected','$student_faculty', CURRENT_TIMESTAMP)";
      if($run_query = mysqli_query($conn,$insert_details_command)){
        echo "<script>alert('Details Have Been Submitted Successfully')</script>";
      }else{
        echo "<script>alert('Details Not Submitted ')</script>";
      }
    }
  }
  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>http://tusolutionweb.blogspot.pe/</title>

  <link rel="stylesheet" href="../css/bootstrap-theme.min.css"/>
  <link rel="stylesheet" href="../css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../css/bootstrap-select.css"/>
  <link rel="stylesheet" href="../css/main_page_style.css"/>
  <link rel="stylesheet" href="vira_and_industrial_registration.css"/>

  <script type="text/javascript" src="../js/jquery-3.1.1.min.js"/></script>
  <script type="text/javascript" src="../js/bootstrap.min.js"/></script>

</head>
<body>

<div id="top-navigation">
  <div id="header_logo"><img src="../img/header_log.png" class="img-responsive" alt="logo" style="float:left;width:150px; height:50px;position:relative;left:20px"/></div>
<div id="student_name"><span style="color:rgb(255, 198, 0);font-size:1.1em"><em>bienvenidos visita http://tusolutionweb.blogspot.pe/,</em>&nbsp; </span><span style="font-family:serif"><?php echo $student_fname." ".$student_lname;?></span></div>
</div>

<div id="left_side_bar">
<ul id="menu_list">
  <a class="menu_items_link" href="../instructions_page/instructions_page.php"><li class="menu_items_list">Instrucciones</li></a>
  <a class="menu_items_link" href="../Register_page/Register_page.php"><li class="menu_items_list"style="background-color:orange;padding-left:16px">Register</li></a>
  <a class="menu_items_link" href="../student_assumption/student_assumption.php"><li class="menu_items_list">Presentar Asunción
</li></a>
  <a class="menu_items_link" href="../e-logbook/elogbook.php"><li class="menu_items_list">Cuaderno</li></a>
  <a class="menu_items_link" href="../company_supervisor/company_supervisor_login.php"><li class="menu_items_list">Supervisor de la compañía</li></a>
  <a class="menu_items_link" href="../visiting_supervisor/visiting_supervisor_login.php"><li class="menu_items_list">Supervisor visitante</li></a>
  <a class="menu_items_link" href="../submit_report/submit_report.php"><li class="menu_items_list">Enviar reporte
</li></a>
  <a class="menu_items_link" href="../index.php"><li class="menu_items_list">Cerrar sesión</li></a>
</ul>
</div>

<div id="main_content">
  <div class="container-fluid">
    <div class = "panel">
       <div class = "panel-heading vira_phead">
          <h2 class = "panel-title vira_ptitle"> Registro de Vira</h2>
       </div>
            <div class = "panel-body vira_pbody">
              <div class="row">
                <div id="vira_receipt_holder">
              <form class="form-inline" method="post" action="">
                <div class="form-group">
                  <label class="sr-only">Número de recibo</label>
                  <p class="form-control-static"><strong>Recibo no.</strong></p>
                </div>
                <div class="form-group">
                  <label for="txtreceipt" class="sr-only">Número de recibo</label>
                  <input type="text" class="form-control form-control-adjusted" id="txtreceipt" placeholder="Receipt number" name="txtreceipt">
                </div>
                <input type="submit" class="btn btn-primary btn-sm" value="Validate" name="btn-check-receipt"/>
              </form>
            </div>
         </div>
         <br>
         <br>
         <div class="panel">
           <div class="panel-body">
         <form method="post" action="">
           <div class="form-group">
            <label for="txtfname">Nombre </label>
            <input type="text" class="form-control form-control-adjusted" id="txtfname" placeholder="Enter first name" disabled <?php echo "value='$first_name_holder'"?>>
          </div>

          <div class="form-group">
           <label for="txtlname">Apellido </label>
           <input type="text" class="form-control form-control-adjusted" id="txtlname" placeholder="Enter last name" disabled value=<?php echo $last_name_holder;?>>
         </div>

         <div class="form-group">
          <label for="txtothername">Otros nombres </label>
          <input type="text" class="form-control form-control-adjusted" id="txtothername" placeholder="Enter other name(s)" <?php echo $other_name_status; ?> name="student_other_name">
        </div>

        <div class="form-group">
         <label for="txtindexnumber">Número de índice </label>
         <input type="text" class="form-control form-control-adjusted" id="txtindexnumber" placeholder="Enter index number"  name="txt_index_number" <?php echo $index_status; ?> value=<?php echo $index_number_holder;?>>
       </div>

        <div class="form-group">
        <label for="selected_programme">Seleccionar programa:</label>
        <select class="form-control form-control-adjusted" id="selected_programme" name="student_programme">
          <?php
            foreach($programmes as $val) { echo "<option>".$val."</option>";};
           ?>
        </select>
      </div>

      <div class="form-group">
      <label for="selected_level">Selecciona el nivel:</label>
      <select class="form-control form-control-adjusted" id="selected_level" name="student_level">
        <?php
      foreach($levels as $val) { echo "<option>".$val."</option>";};
         ?>
      </select>
    </div>

      <div class="form-group">
      <label for="selected_session">Seleccionar sesión:</label>
      <select class="form-control form-control-adjusted" id="selected_session" name="student_session">
        <?php
      foreach($sessions as $val) { echo "<option>".$val."</option>";};
         ?>
      </select>
    </div>
      
     <div class="form-group">
      <label for="selected_session">Seleccionar Facultad :</label>
      <select class="form-control form-control-adjusted" id="selected_faculty" name="student_faculty">
        <?php
      foreach($faculties as $val) { echo "<option>".$val."</option>";};
         ?>
      </select>
    </div>

      <div id="btn_submit_holder">
      <input type="submit" class="btn btn-primary" value="Submit" <?php echo $submit_status; ?> name="btn_submit"/>
    </div>
       </form>
     </div>
     </panel>

       </div>
     </div>
   </div>
 </div>

</body>
</html>
