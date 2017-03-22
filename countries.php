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

//db config
require 'includes/config.php';
require 'user_profile.php';


//functions
    require 'includes/functions.php';
//page name
$mainpage = 'customers';
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
             <!-- Default panel -->

          <div class="row">
              <div class="col-md-6">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <h6 class="panel-title">Countries</h6>
                      </div>
                      <div class="panel-body">
                  <div class="table-responsive">

                          <br />

                          <div class="form-group">
                              <div class="input-group">
                                  <span class="input-group-addon">Search</span>
                                  <input type="text" name="search_text" id="search_text" placeholder="Search by Customer Details" class="form-control" />
                              </div>
                          </div>
                          <br />
                      <div id="result"></div>





                  </div>

                      </div>
                  </div>
              </div>
              <div class="col-md-6 well">
                  <?php
                  if (isset($_POST['save'])) {
                  // get the form data

                  $country_name = $_POST['country_name'];
                  $sql= "INSERT INTO `sp_countries`(`id`, `country_name`,`date_created`) VALUES (NULL,'$country_name',NOW())";
                  if(mysqli_query($connection, $sql) === TRUE) {
                  echo '<div class="alert alert-success alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                      echo $country_name ;
                      echo' &nbsp; &nbsp;created successfully
                  </div>';


                  } else {
                  echo '<div class="alert alert-danger alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      Error while Adding  &nbsp; &nbsp;';
                      echo $country_name ;
                      echo'
                  </div>';
                  }
                  }
                  ?>
                  <!--add form without refresh-->
                  <form class="" method="POST" action="">

                      <div class="col-lg-12">
                          <div class="form-group">
                              <label for="Slide-title">Country</label>
                              <input class="form-control" name="country_name" type="text" placeholder="Country Name" id="industry_name" required>
                          </div>
                      </div>

                      <div class="col-lg-12">
                          <button type="submit" name="save" id="send" class="btn btn-primary  btn-square pull-right">Submit</button>
                      </div>

                  </form>



              </div>
          </div>



    <!-- /default panel -->
            
      <!--footer-->
<?php require 'includes/footer.php'; ?>      
  </div>      
  </div>
        
        <!-- end Page container -->
        <!--JS-->
        <!-- end Page container -->
        <!--JS-->
        <?php require 'includes/js.php';?>
        <script>
            //DataTables Initialization
            $(document).ready(function() {
                $('#example-table').dataTable();
            });
            $(document).ready(function() {
                $('#ongoing-table').dataTable();
            });
            $(document).ready(function() {
                $('#completed-table').dataTable();
            });

        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script>
            $(document).ready(function(){

                load_data();

                function load_data(query)
                {
                    $.ajax({
                        url:"fetch_countries.php",
                        method:"POST",
                        data:{query:query},
                        success:function(data)
                        {
                            $('#result').html(data);
                        }
                    });
                }
                $('#search_text').keyup(function(){
                    var search = $(this).val();
                    if(search != '')
                    {
                        load_data(search);
                    }
                    else
                    {
                        load_data();
                    }
                });
            });
        </script>

    </body>
</html>

