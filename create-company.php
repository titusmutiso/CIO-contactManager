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
$mainpage = 'company';
$page = 'create-company';


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

              $co_name = htmlentities($_POST['co_name'], ENT_QUOTES);
              $industry= htmlentities($_POST['co_industry'], ENT_QUOTES);
              $country_id = htmlentities($_POST['co_country'], ENT_QUOTES);
              //contacts
              $co_email = htmlentities($_POST['co_email'], ENT_QUOTES);

              $co_phone = htmlentities($_POST['co_phone'], ENT_QUOTES);
              $co_landline = htmlentities($_POST['co_landline'], ENT_QUOTES);
              $co_website = htmlentities($_POST['co_website'], ENT_QUOTES);
              $co_address = htmlentities($_POST['co_address'], ENT_QUOTES);
              $co_postal_code = htmlentities($_POST['co-postalcode'], ENT_QUOTES);
              $co_city = htmlentities($_POST['co_city'], ENT_QUOTES);
              $co_location = htmlentities($_POST['co_location'], ENT_QUOTES);

              //generated automatic


              //$user_logo = $_POST['user_avatar'];
              //Images
              //new code to upload image 1
              if($_FILES["co_logo"]["name"]!=''){
                  //image extensions
                  $allowed_extension = array("jpg","png");
                  $ext =end(explode('.',$_FILES["co_logo"]["name"]));
                  if(in_array($ext,$allowed_extension)){

                      //check image size 10mb
                      if($_FILES["co_logo"]["size"]<10000000){
                          $name = substr($co_name, 0, 5).'-1'.'.'.$ext; //rename image
                          $co_logo= "uploads/company/".$name; //image path
                          move_uploaded_file($_FILES["co_logo"]["tmp_name"],$co_logo);
                          //after upload
                          // header("Location:index.php?file-name=".$name."");





                      }else{
                          echo '<script>alert("Image Too Large")</script>';
                      }

                  }else{
                      echo '<script>alert("Invalid Image Extension")</script>';

                  }



              }else{
                  echo '<script>alert("Please Select Image 1")</script>';
              }

              //posting to DB
              $sql = "INSERT INTO `sp_company`(`id`, `company_name`, `industry_id`, `country_id`, `email_address`, `phone_number`, `landline`, `website_url`, `address`, `postal_code`, `city`, `location`, `logo`, `date_created`)"
              ." VALUES (NULL,'$co_name','$industry','$country_id','$co_email','$co_phone','$co_landline','$co_website','$co_address','$co_postal_code','$co_city','$co_location','$co_logo',NOW())";


              if(mysqli_query($connection, $sql) === TRUE) {
                  echo '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                  echo $co_name;
                  echo'  &nbsp; &nbsp; created successfully
                                        </div>';


              } else {
                  echo '<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Error while Adding &nbsp;'; echo $co_name;
              }
          }

          ?>


          <form role="form" method="post" action="" enctype="multipart/form-data">

              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">Company Name</label>
                      <input type="text" name="co_name" class="form-control"  placeholder="Company Name">
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">First Name</label>
                      <select  name="co_industry" class="form-control" required>
                          <option selected disabled>Select Industry</option>
                          <?php
                          //list categories
                          $industry_query  = "select * from sp_industry ORDER BY id ASC";
                          $industry_res    = mysqli_query($connection,$industry_query);
                          $industry_count  =   mysqli_num_rows($industry_res);
                          if (mysqli_num_rows($industry_res) > 0) {

                              while($industry_row=mysqli_fetch_array($industry_res)) {


                                  $industry_name = $industry_row['industry_name'];
                                  $industry_id = $industry_row['id'];

                                  ?>
                                  <option value="<?php echo $industry_id ?>"><?php echo $industry_name ?></option>
                                  <?php
                              }
                          }  else {
                              echo '<option value=""><a href="create-industry.php">Add Industry</a> </option>';
                          }
                          ?>
                      </select>
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">Country</label>
                      <select  name="co_country" class="form-control" required>
                          <option selected disabled>Select Country</option>
                          <?php
                          //list categories
                          $country_query  = "select * from sp_countries ORDER BY id ASC";
                          $country_res    = mysqli_query($connection,$country_query);
                          $country_count  =   mysqli_num_rows($country_res);
                          if (mysqli_num_rows($country_res) > 0) {

                              while($country_row=mysqli_fetch_array($country_res)) {


                                  $country_name = $country_row['country_name'];
                                  $country_id = $country_row['id'];

                                  ?>
                                  <option value="<?php echo $country_id ?>"><?php echo $country_name ?></option>
                                  <?php
                              }
                          }  else {
                              echo '<option>No Countries</option>';
                          }
                          ?>
                      </select>
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">Email Address</label>
                      <input type="text" name="co_email" class="form-control" id="exampleInputEmail1" placeholder="info@domain.name">
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">Mobile Phone Number</label>
                      <input type="text" name="co_phone" class="form-control" id="exampleInputEmail1" placeholder="+254 710 000 000">
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">Landline Number</label>
                      <input type="text" name="co_landline" class="form-control" id="exampleInputEmail1" placeholder="+254(0) 2000000">
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">Address</label>
                      <textarea name="co_address" class="form-control"></textarea>
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">Postal Code</label>
                      <input type="text" name="co_postalcode" class="form-control" id="exampleInputEmail1" placeholder="Postal Code">
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">City</label>
                      <input type="text" name="co_city" class="form-control" id="exampleInputEmail1" placeholder="City">
                  </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">Business Location</label>
                      <input type="text" name="co_location" class="form-control" id="exampleInputEmail1" placeholder="E-Development House, Muthaiga">
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">Website</label>
                      <input type="url" name="co_website" class="form-control" id="exampleInputEmail1" placeholder="http://www.domain.name">
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">Logo</label>
                      <input type="file" name="co_logo" class="form-control" >
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

