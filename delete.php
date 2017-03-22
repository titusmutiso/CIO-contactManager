<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//database
require 'includes/config.php';
//login - sessions

//functions
require 'includes/functions.php';

$id=$_REQUEST['id'];
$type=$_REQUEST['type'];
switch($type)
{
    //delete User
        case 'user':
        mysqli_query($connection,"delete from  sp_users where id=$id");
        header("location:users.php");
        break;
        case 'contact':
//delete contact
        mysqli_query($connection,"delete from  sp_contacts where id=$id");
        header("location:contacts.php");
        break;
        case 'company':
//delete company
        mysqli_query($connection,"delete from  sp_company where id=$id");
        header("location:company.php");
        break;
        case 'industry':
//delete industry
        mysqli_query($connection,"delete from  sp_industry where id=$id");
        header("location:industry.php");
        break;
        case 'country':
//delete country
        mysqli_query($connection,"delete from  sp_country where id=$id");
        header("location:country.php");
        break;
}



?>
