<?php
/**
 * Created by PhpStorm.
 * User: SparkWorld
 * Date: 12/4/2016
 * Time: 3:54 PM
 */
//connect to db
error_reporting(0);
//local db
$connection = mysqli_connect("localhost", "root", "", "cio_contacts");

if(!$connection){
    echo "Cannot connect to the server: (" . mysqli_connect_errno(). ")";
    exit();
}

/*/remote db
$connection = mysqli_connect("localhost", "marksoli_final", "27679054@@", "marksoli_cio");

if(!$connection){
    echo "Cannot connect to the server: (" . mysqli_connect_errno(). ")";
    exit();

}
*/
