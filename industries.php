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
                          <h6 class="panel-title">Industries</h6>
                      </div>
                      <div class="panel-body">
                  <div class="table-responsive">

                          <table id="example-table" class="table table-striped">
                              <thead>
                              <tr>
                                  <th><input type="checkbox" > </th>

                                  <th>Industry Name</th>

                                  <th>Actions</th>
                              </tr>
                              </thead>

                              <?php
                              $industry_query  = "select * from sp_industry ORDER BY id ASC";
                              $industry_res    = mysqli_query($connection,$industry_query);
                              $industry_count  =   mysqli_num_rows($industry_res);

                              ?>
                              <?php
                              if (mysqli_num_rows($industry_res) > 0) {

                                  while($industry_row=mysqli_fetch_array($industry_res)) {

                                      $industry_names = $industry_row['industry_name'];

                                      $industry_id = $industry_row['id'];?>
                                      <tr>
                                          <td><input type="checkbox" > </td>
                                          <td><?php echo $industry_names; ?></td>

                                          <td ><div class="btn-group"><a href='edit-industry?id=<?php echo $industry_id?>' data-toggle="tooltip" title="Edit" data-placement="top" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> </a>
                                                  &nbsp;<a href='delete?id=<?php echo $industry_id ?>&type=contact' data-toggle="tooltip" title="Delete" data-placement="top" onclick="return confirm('Are you sure you wish to move this record to trash?');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> </a>
                                                     </div>
                                          </td>
                                      </tr>


                                  <?php }
                              }  else {
                                  echo 'No Records';
                              }

                              ?>


                              </tbody>
                          </table>


                  </div>

                      </div>
                  </div>
              </div>
              <div class="col-md-6 well">
                  <?php
                  if (isset($_POST['save'])) {
                  // get the form data

                  $industry_name = $_POST['industry_name'];
                  $sql= "INSERT INTO `sp_industry`(`id`, `industry_name`,`date_created`) VALUES (NULL,'$industry_name',NOW())";
                  if(mysqli_query($connection, $sql) === TRUE) {
                  echo '<div class="alert alert-success alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                      echo $industry_name ;
                      echo' &nbsp; &nbsp;created successfully
                  </div>';


                  } else {
                  echo '<div class="alert alert-danger alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      Error while Adding  &nbsp; &nbsp;';
                      echo $industry_name ;
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
                              <input class="form-control" name="industry_name" type="text" placeholder="Industry Name" id="industry_name" required>
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
    <script>
        function Send_req() {
            var industry_name= $("#industry_name").value;

            $.ajax({
                type: "POST",
                url: 'insert.php',
                data: {des:des},
            success: function(html)
            {
                if (html=='1')
                {
                    alert ("Congratulations, Request Sent Successfuly! ");
                }

                else
                {
                    alert ("Sorry, Error in sending request!");
                }
            }
        });
        }
    </script>
    </body>
</html>

