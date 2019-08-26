<?php 
session_start();
if($_SESSION['user_id']==""){
  header('location:login.php'); //when session is empty goto login page. 
}
error_reporting(E_ALL & ~E_NOTICE);//To show all error except Notic error which distrub us
include_once('includes/config.php');
$page=isset($_GET['page'])?$_GET['page']:'home';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Student Management System</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <!--For Calendar open-->
         <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL?>calender/JSCal2/css/jscal2.css" />
         <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL?>calender/JSCal2/css/border-radius.css" />
         <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL?>calender/JSCal2/css/steel/steel.css" />
        <script type="text/javascript" src="<?php echo SITE_URL?>calender/JSCal2/js/jscal2.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL?>calender/JSCal2/js/lang/en.js"></script>
        <!--For Calendar close-->

        <!-- For CK-Editor open -->
        <script type="text/javascript" src="<?php echo SITE_URL?>ckeditor/ckeditor.js"></script>
        <!-- For CK-Editor close -->
        <!-- To show name hint when we search inside studentlist.php page open -->
        <script src="js/jquery.js" type="text/javascript"></script>
        <!-- To show name hint when we search inside studentlist.php page close -->
    </head>
    <body onload="">
        <div id="wrapper">
            <div id="header">
                <?php include_once('pageparts/header.php')?>
            </div>
            <div id="menu">
                <?php include_once('pageparts/menu.php')?>
            </div>
            <div id="content">
               <?php include_once("page/$page.php")?>
            </div>
            <br/>
            <div id="footer">
               <?php include_once('pageparts/footer.php')?>
            </div>
        </div>
    </body>
</html>
