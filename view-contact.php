<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//session
session_start();
if(!isset($_SESSION['login_user']))
{
    header("Location: index");
}
$login_session=$_SESSION['login_user'];
$user_id = $_SESSION['id'];
//contact id
$contact_id = $_GET['id'];
//db config
require 'includes/config.php';
require 'user_profile.php';


//functions
   require 'includes/functions.php';
//page name
$mainpage ='customers';
$page = 'customers';


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        //header
         require 'includes/header.php';
        //css
        require 'includes/css.php';
        
        ?>
    </head>
    <body class="sidebar-wide">
        <!--navigation-->
        <?php
        //top navigation
        require 'includes/top-menu.php';
        
        ?>
        <!-- Page container -->
        <div class="page-container">
            <!-- side bar-->
            <?php require 'includes/side-menu.php'; ?>
            <!--ennd of side bar-->
            <!-- Page content -->
  <div class="page-content">
    <!-- Page header -->
    <?php require 'includes/breadcrumb.php'; ?>
            <!-- end Page header-->
      <?php
      $contacts_query ="SELECT * FROM `sp_contacts` WHERE id='$contact_id'";
      $contacts_res    = mysqli_query($connection,$contacts_query);
      $contacts_row=mysqli_fetch_array($contacts_res);
      $contacts_image = $contacts_row['profile_image'];
      $contacts_names = $contacts_row['first_name']." ".$contacts_row['last_name'];
      $contacts_phone= $contacts_row['phone_no'];
      $contacts_email= $contacts_row['email_address'];
      $contacts_company= $contacts_row['company'];
      $contacts_designation= $contacts_row['designation'];
      $contacts_industry= $contacts_row['industry'];
      $contacts_profile= $contacts_row['designation'];


      ?>
             <!-- Default panel -->
    <div class="panel panel-default">
      <div class="panel-heading">
        <h6 class="panel-title">Default panel</h6>
      </div>
      <div class="panel-body"><code>div class="panel panel-default"</code></div>
    </div>
    <!-- /default panel -->
            
      <!--footer-->
<?php require 'includes/footer.php'; ?>      
  </div>      
  </div>
        
        <!-- end Page container -->
        <!--JS-->
        <?php require 'includes/js.php';?>
    </body>
</html>

