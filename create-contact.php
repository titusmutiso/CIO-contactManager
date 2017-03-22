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
$mainpage = 'contacts';
$page = 'create-contact';


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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h6 class="panel-title">Default panel</h6>
      </div>
      <div class="panel-body">

          <?php
		 
          //script to save
          if (isset($_POST['save'])) {
              // get the form data

              $fname = htmlentities($_POST['f_name'], ENT_QUOTES);
              $lname= htmlentities($_POST['l_name'], ENT_QUOTES);
              $user_number = htmlentities($_POST['phone_number'], ENT_QUOTES);
              $user_email = htmlentities($_POST['email_add'], ENT_QUOTES);
              $company_id = htmlentities($_POST['company'], ENT_QUOTES);
              $rank= htmlentities($_POST['designation'], ENT_QUOTES);
              $linked_in = htmlentities($_POST['linked-in'], ENT_QUOTES);
              $fb = htmlentities($_POST['fb-account'], ENT_QUOTES);
              $twitter = htmlentities($_POST['twitter-acc'], ENT_QUOTES);



//post to DB
              $sql ="INSERT INTO `sp_contacts`(`id`, `first_name`, `last_name`, `email_address`, `phone_no`, `company`, `designation`, `owner`, `linkedin`, `facebook`, `twitter`, `date_created`, `date_updated`)"
                                    ." VALUES (NULL,'$fname','$lname','$user_email','$user_number','$company_id','$rank','$user_id','$linked_in','$fb','$twitter',NOW(),NOW())";
              //posting to DB


              if(mysqli_query($connection, $sql) === TRUE) {
                  echo '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            New customer created successfully
                                        </div>';


              } else {
                  echo '<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Error while Adding New customer
                                        </div>';
              }
          }

          ?>


          <form role="form" method="post" action="" enctype="multipart/form-data">

              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">First Name</label>
                      <input type="text" name="f_name" class="form-control" id="exampleInputEmail1" placeholder="First Name">
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">Lats Name</label>
                      <input type="text" name="l_name" class="form-control" id="exampleInputEmail1" placeholder="Last Name">
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">Designation / Rank</label>
                      <input type="text" name="designation" class="form-control" id="exampleInputEmail1" placeholder="E.g. CEO,CIO">
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">Phone Number</label>
                      <input type="tel" name="phone_number" class="form-control" id="exampleInputEmail1" placeholder="+254700000000">
                  </div>
              </div>
              <div class="col-lg-4">

                  <div class="form-group">
                      <label for="Slide-title">Email Address</label>

                      <input class="form-control" type="email" name="email_add" placeholder="email@domain.com"/>

                  </div>
              </div>
              <div class="col-lg-4">

                  <div class="form-group">
                      <label for="Slide-title">Select Company</label>

                      <select class="form-control" name="company">
                          <option disabled selected>Select Company</option>
                          <?php
                          //select companies from DB
                          $company_query  = "select * from sp_company ORDER BY id ASC";
                          $company_res    = mysqli_query($connection,$company_query);
                          $company_count  =   mysqli_num_rows($company_res);
                          if (mysqli_num_rows($company_res) > 0) {

                          while($company_row=mysqli_fetch_array($company_res)) {


                          $company_names = $company_row['company_name'];
                          $company_id = $company_row['id'];
                          ?>
                          <option value="<?php echo $company_id ?>"><?php echo $company_names ?></option>

                              <?php

                          }
                          }
                          else {
                              echo '<option>No Records</option>';
                          }

                          ?>
                      </select>

                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="Slide-title">LinkedIn Account</label>
                      <input type="text" name="linked-in" class="form-control" id="exampleInputEmail1" placeholder="First & Last Name">
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="Slide-title">Facebook Account</label>
                      <input type="text" name="fb-account" class="form-control" id="exampleInputEmail1" placeholder="First & Last Name">
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="Slide-title">Titter Account</label>
                      <input type="text" name="twitter-acc" class="form-control" id="exampleInputEmail1" placeholder="First & Last Name">
                  </div>
              </div>










              <div class="col-lg-12">
                  <button type="submit" name="save" class="btn btn-primary  btn-square pull-right">Submit</button>
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
        <?php require 'includes/js.php';?>
    </body>
</html>

