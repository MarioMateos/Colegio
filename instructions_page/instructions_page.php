<?php

include '../database_connection/database_connection.php';

$student_fname = $_COOKIE["student_first_name"];
$student_lname = $_COOKIE["student_last_name"];
$student_index_number = $_COOKIE["student_index_number"];


$mysql_check_supervisor_assigned = "SELECT * FROM vira_registration WHERE index_number='$student_index_number' LIMIT 1";

$execute_check_supervisor_assigned = mysqli_query($conn,$mysql_check_supervisor_assigned);

$check_presence = mysqli_num_rows($execute_check_supervisor_assigned);

if($check_presence == 1){

$get_entire_results = mysqli_fetch_array($execute_check_supervisor_assigned);

$student_faculty = $get_entire_results["faculty"];
$student_company_region = $get_entire_results["attachment_region"];
$student_visiting_supervisor_name = $get_entire_results["visiting_supervisor_name"];

if($student_company_region!="unassigned" && $student_visiting_supervisor_name!="unassigned"){

	$contains_data = "true";

	$get_supervisors_contact_query = "SELECT * FROM visiting_lecturers WHERE lecturer_faculty='$student_faculty' AND lecturer_name='$student_visiting_supervisor_name' LIMIT 1";

	$execute_get_supervisor_contact = mysqli_query($conn,$get_supervisors_contact_query);

	$get_supervisors_contact = mysqli_fetch_array($execute_get_supervisor_contact);

	$lecturers_contact = $get_supervisors_contact["lecturer_phone_number"];

	$assign_contact_to_student = "UPDATE `vira_registration` SET `visiting_supervisor_contact` = '$lecturers_contact' WHERE `index_number` = '$student_index_number'";

	$execute_assign_contact = mysqli_query($conn,$assign_contact_to_student);

}else{
	$contains_data = "false";
}

}else{

	$mysql_check_supervisor_assigned = "SELECT * FROM industrial_registration WHERE index_number='$student_index_number' LIMIT 1";

	$execute_check_supervisor_assigned = mysqli_query($conn,$mysql_check_supervisor_assigned);

	$get_entire_results = mysqli_fetch_array($execute_check_supervisor_assigned);

	$student_faculty = $get_entire_results["faculty"];
	$student_company_region = $get_entire_results["attachment_region"];
	$student_visiting_supervisor_name = $get_entire_results["visiting_supervisor_name"];

	if($student_company_region!="unassigned" && $student_visiting_supervisor_name!="unassigned"){

	$contains_data = "true";

	$get_supervisors_contact_query = "SELECT * FROM visiting_lecturers WHERE lecturer_faculty='$student_faculty' AND lecturer_name='$student_visiting_supervisor_name' LIMIT 1";

	$execute_get_supervisor_contact = mysqli_query($conn,$get_supervisors_contact_query);

	$get_supervisors_contact = mysqli_fetch_array($execute_get_supervisor_contact);

	$lecturers_contact = $get_supervisors_contact["lecturer_phone_number"];

	$assign_contact_to_student = "UPDATE `industrial_registration` SET `visiting_supervisor_contact` = '$lecturers_contact' WHERE `index_number` = '$student_index_number'";

	$execute_assign_contact = mysqli_query($conn,$assign_contact_to_student);

}else{
		$contains_data = "false";
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

  <link rel="stylesheet" href="../css/bootstrap-theme.min.css"/>
  <link rel="stylesheet" href="../css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../css/main_page_style.css"/>
  <link rel="stylesheet" href="instructions_page.css"/>

  <script type="text/javascript" src="../js/jquery-3.1.1.min.js"/></script>
  <script type="text/javascript" src="../js/bootstrap.min.js"/></script>

</head>
<body>

<div id="top-navigation">
<div id="header_logo"><img src="../img/header_log.png" class="img-responsive" alt="logo" style="float:left;width:150px; height:50px;position:relative;left:20px"/></div>

<div id="student_name_adjusted"><span style="color:rgb(255, 198, 0);font-size:1.1em"><em>Bienvinido visite http://tusolutionweb.blogspot.pe/,</em>&nbsp; </span><span style="font-family:serif"><?php echo $student_fname." ".$student_lname;?></span></div>
</div>

<div id="left_side_bar">
<ul id="menu_list">
  <a class="menu_items_link" href="instructions_page.php"><li class="menu_items_list" style="background-color:orange;padding-left:16px">Instructions</li></a>
  <a class="menu_items_link" href="../Register_Page/register_page.php"><li class="menu_items_list">Registrar</li></a>
  <a class="menu_items_link" href="../student_assumption/student_assumption.php"><li class="menu_items_list">Presentar Asunción
</li></a>
  <a class="menu_items_link" href="../e-logbook/elogbook.php"><li class="menu_items_list">Cuaderno</li></a>
  <a class="menu_items_link" href="../company_supervisor/company_supervisor_login.php"><li class="menu_items_list">Supervisor de la compañía</li></a>
  <a class="menu_items_link" href="../visiting_supervisor/visiting_supervisor_login.php"><li class="menu_items_list">Supervisor visitante</li></a>
  <a class="menu_items_link" href="../submit_report/submit_report.php"><li class="menu_items_list">Enviar reporte</li></a>
  <a class="menu_items_link" href="../index.php"><li class="menu_items_list">Cerrar sesión</li></a>
</ul>
</div>


<!-- Main Body Content -->

<div id="main_content">
<div class="container-fluid">
<div class="row">
<div class="col-lg-3 col-md-4 col-sm-6">
  <div class = "panel">
     <div class = "panel-heading ">
        <h4 class = "panel-title ptitle">Paso 1</h4>
     </div>

     <div class = "panel-body pbody">
        <span> Una vez que haya podido iniciar sesión en el sistema, haga clic en <span style="font-weight:bold;color:#2B3775">"Register"</span> si no lo has hecho

       registrado aún para el accesorio industrial </span>
        <br><br>
     </div>
  </div>
</div>

<div class="col-lg-3 col-md-4 col-sm-6">
  <div class = "panel">
     <div class = "panel-heading pheading">
        <h4 class = "panel-title ptitle">Paso 2</h4>
     </div>

     <div class = "panel-body pbody">
        <span>Hay dos (2) opciones, elija<span style="font-weight:bold;color:#2B3775">VIRA</span>
       si realiza una pasantía en la escuela o <span style="font-weight:bold;color:#2B3775">INDUSTRIAL</span>
     si está haciendo una pasantía en una empresa de su elección.</span>
      <br><br>
     </div>
  </div>
</div>


<div class="col-lg-3 col-md-4 col-sm-6">
  <div class = "panel">
     <div class = "panel-heading">
        <h4 class = "panel-title ptitle"> Paso 3</h4>
     </div>

     <div class = "panel-body pbody">
        <span>En caso de que seleccione <span style="font-weight:bold;color:#2B3775">VIRA</span> al paso 2,
      se le pedirá que ingrese su número de recibo y haga clic en <span style="font-weight:bold;color:#2B3775">VALIDAR</span>
   antes de que puedas completar el formulario. </span>
    <br><br>
     </div>
  </div>
</div>


<div class="col-lg-3 col-md-4 col-sm-6">
  <div class = "panel">
     <div class = "panel-heading">
        <h4 class = "panel-title ptitle">Paso 4 </h4>
     </div>

     <div class = "panel-body pbody">
       <span>In case you select <span style="font-weight:bold;color:#2B3775">INDUSTRIAL</span> al paso 2,
     se le proporcionará un formulario para llenar después del cual debe hacer clic en <span style="font-weight:bold;color:#2B3775">ENVIAR</span>
    enviar el formulario a la Oficina de Enlace</span>
     </div>
  </div>
</div>
</div>

<br>

<div class="row">
<div class="col-lg-3 col-md-4 col-sm-6">
  <div class = "panel">
     <div class = "panel-heading pheading">
        <h4 class = "panel-title ptitle">Paso 5</h4>
     </div>

     <div class = "panel-body pbody">
        <span>Después de haber enviado con éxito sus datos de registro,
      haga clic en<span style="font-weight:bold;color:#2B3775">Presentar Asunción</span> si aún no ha enviado su formulario de suposición. </span>
        <br><br><br><br>
     </div>
  </div>
</div>

<div class="col-lg-3 col-md-4 col-sm-6">
  <div class = "panel">
     <div class = "panel-heading pheading">
        <h4 class = "panel-title ptitle">Paso 6</h4>
     </div>

     <div class = "panel-body pbody">
        <span>Una vez que haya hecho clic en<span style="font-weight:bold;color:#2B3775">Presentar Asunción</span> al paso 5</span>,
        se le dará un formulario de llenado luego del cual deberá hacer clic en <span style="font-weight:bold;color:#2B3775">ENVIAR</span>
        enviarlo a la Oficina de Enlace.
        <br><br><br>
     </div>
  </div>
</div>


<div class="col-lg-3 col-md-4 col-sm-6">
  <div class = "panel">
     <div class = "panel-heading">
        <h4 class = "panel-title ptitle"> Paso 7</h4>
     </div>

     <div class = "panel-body pbody">
        <span>You can also click <span style="font-weight:bold;color:#2B3775">Cuaderno</span> para registrar todas las actividades que ha realizado a lo largo del día. Debe asegurarse de hacer clic en <span style="font-weight:bold;color:#2B3775">Guardar</span> después de que haya terminado para evitar perder sus datos</span>
    <br><br><br>
     </div>
  </div>
</div>


<div class="col-lg-3 col-md-4 col-sm-6">
  <div class = "panel">
     <div class = "panel-heading">
        <h4 class = "panel-title ptitle">Paso 8 </h4>
     </div>

     <div class = "panel-body pbody">
       <span>Clicking on <span style="font-weight:bold;color:#2B3775">Supervisor de la compañía</span> abrirá una página donde los funcionarios que supervisan pasantes
      puede calificar al estudiante. Los estudiantes no pueden acceder a esta página a menos que <span style="font-weight:bold;color:#2B3775">Supervisor visitante</span>
   le da la contraseña al supervisor que accede a usted </span>
     </div>
  </div>
</div>
</div>

<br>

<div class="row">
<div class="col-lg-3 col-md-4 col-sm-6">
  <div class = "panel">
     <div class = "panel-heading pheading">
        <h4 class = "panel-title ptitle">Paso 9</h4>
     </div>

     <div class = "panel-body pbody">
        <span> Al hacer clic en <span>VSupervisores visitantes</span> permitiría calificar por el Supervisor que la escuela ha elegido para supervisar al alumno. Esta página no sería accesible para el estudiante, solo <thead>
        el supervisor visitante puede iniciar sesión con una contraseña.
      </thead> </span>
        <br><br>
     </div>
  </div>
</div>

<div class="col-lg-3 col-md-4 col-sm-6">
  <div class = "panel">
     <div class = "panel-heading pheading">
        <h4 class = "panel-title ptitle">Paso 10</h4>
     </div>

     <div class = "panel-body pbody">
        <span>Al hacer clic en el informe de envío, le permitiría al estudiante enviar
         su archivo adjunto industrial a la Oficina de Enlace Industrial directamente
       sin tener que imprimirlo y llevarlo a la escuela, ahora puede hacerlo en línea.</span>
      <br><br><br>
     </div>
  </div>
</div>


<div class="col-lg-3 col-md-4 col-sm-6">
  <div class = "panel">
     <div class = "panel-heading">
        <h4 class = "panel-title ptitle"> Paso 11</h4>
     </div>

     <div class = "panel-body pbody">
        <span>Su contraseña es una de las pocas cosas que pone una barrera entre su cuenta y el mundo exterior,
         En caso de que quiera cambiar la contraseña de su cuenta, simplemente haga clic en <span>Cambia la contraseña
</span> y complete sus detalles
</span>
        <br><br>
     </div>
  </div>
</div>


<div class="col-lg-3 col-md-4 col-sm-6">
  <div class = "panel">
     <div class = "panel-heading">
        <h4 class = "panel-title ptitle">Paso 12 </h4>
     </div>

     <div class = "panel-body pbody">
       <span>Una vez que haya terminado con todo lo que desea hacer en el sistema de administración en línea, es aconsejable
        para que cierre la sesión de su cuenta. Esto evitará que otros usuarios usen su cuenta para realizar
      otras operaciones que ni siquiera conoces</span>
     </div>
  </div>
</div>
</div>

<br>
<br>



</div>
</div>

<?php



 ?>

</body>
</html>
