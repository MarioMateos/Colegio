<?php

include '../../database_connection/database_connection.php';

if(isset($_POST["btn_submit"])){

  $user_current_password = $_POST["txt_current_password"];
  $user_new_password = $_POST["txt_new_password"];
  $user_password_confirm = $_POST["txt_confirm_password"];

  if($user_password_confirm!="" && $user_current_password!="" && $user_new_password!=""){

    $my_query_command = "SELECT * FROM supervisors_login WHERE password='$user_current_password'";
    $mysql_query = mysqli_query($conn,$my_query_command);
    $fetch_rows = mysqli_fetch_assoc($mysql_query);

    if($fetch_rows["password"]=="$user_current_password"){

      if($user_new_password == $user_password_confirm){
      $insert_command = "UPDATE supervisors_login SET password = '$user_new_password' WHERE password='$user_current_password'";
      $execute_insert_query = mysqli_query($conn,$insert_command);
      echo "<script>alert('Password Has Been Updated Successfully')</script>";
    }
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
  <title>Tusolutionweb</title>

  <link rel="stylesheet" href="../../css/bootstrap-theme.min.css"/>
  <link rel="stylesheet" href="../../css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../../css/main_page_style.css"/>
  <link rel="stylesheet" href="change_password.css"/>

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
  <a class="menu_items_link" href="../view_registered_students/view_registered_students.php"><li class="menu_items_list">Estudiantes Registrados
</li></a>
  <a class="menu_items_link" href="../students_assumptions/students_assumptions.php"><li class="menu_items_list" >Supuestos del estudiante
</li></a>
  <a class="menu_items_link" href="../assign_supervisors/assign_supervisors.php"><li class="menu_items_list">Asignar supervisores
</li></a>
  <a class="menu_items_link" href="../visiting_score/visiting_supervisors_score.php"><li class="menu_items_list">Supervisores visitantes de puntuaciones
</li></a>
  <a class="menu_items_link" href="../company_score/company_supervisor_score.php"><li class="menu_items_list">Puntuación del supervisor de la compañía
</li></a>
  <a class="menu_items_link" href="change_password.php"><li style="background-color:orange;padding-left:16px" class="menu_items_list">Cambia la contraseña</li></a>
  <a class="menu_items_link" href="../../index.php"><li class="menu_items_list">Cerrar sesión</li></a>
</ul>
</div>

<div id="main_content">
  <div class="container-fluid">
    <div class = "panel">
       <div class = "panel-heading industrial_phead">
          <h2 class = "panel-title industrial_ptitle"> Cambia la contraseña</h2>
       </div>

            <div class = "panel-body industrial_pbody">

         <div class="panel">
           <div class="panel-body">
             <form method="post" action="">
               <div class="form-group">
                <label for="txt_current_password">contraseña actual</label>
                <input type="password" class="form-control form-control-adjusted" id="txt_current_password" placeholder="Enter current password" name="txt_current_password">
              </div>

              <div class="form-group">
               <label for="txt_new_password">Nueva contraseña</label>
               <input type="password" class="form-control form-control-adjusted" id="txt_new_password" placeholder="Enter new password" name="txt_new_password">
             </div>

             <div class="form-group">
              <label for="txt_confirm_password">Confirmar nueva contraseña </label>
              <input type="password" class="form-control form-control-adjusted" id="txt_confirm_password" placeholder="Confirm new password" name="txt_confirm_password">
            </div>

          <div id="btn_submit_holder">
          <input type="submit" class="btn btn-primary" value="Submit"  name="btn_submit"/>
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
