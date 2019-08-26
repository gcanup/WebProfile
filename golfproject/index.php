<?php

//error_reporting(E_ALL & ~E_NOTICE);
include_once('includes/config.php');
$page=$_GET['p']?$_GET['p']:'home';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Golf Community</title>
<link href="control/style.css" rel="stylesheet" type="text/css" />
<script src="js/lightbox/prototype.js" type="text/javascript"></script>
<script src="js/lightbox/scriptaculous.js" type="text/javascript"></script>
<script src="js/lightbox/lightbox.js" type="text/javascript"></script>
<link href="control/lightbox.css" rel="stylesheet" type="text/css"/>
<!--[if lt IE 7]>
<script defer type="text/javascript" src="js/pngfix.js"></script>
<![endif]-->
</head>

<body>
<!-- wrapper starts -->
<div id="wrapper">

	<!-- main starts -->
    <div id="main">
    
    	<!-- header starts -->
        <div id="header">
            <?php include_once('pageparts/header.php') ?>
        </div>
    	<!-- header ends -->
        
        <!-- nav starts -->
        <div id="nav">
        
            <?php include_once('pageparts/menu.php') ?>
        </div>
        <!-- nav ends -->
        
        <!-- container starts -->
        <div id="container">
        	
            <!-- containerL starts -->
            <div id="containerL">
            
            	<div class="clBanner"><img src="images/banner.jpg" alt="Welcome to Golf Community" /></div><!-- end of class clBanner -->
                
                <div class="clContent">
                
                	<?php
                        include_once("page/$page.php");
                        ?>
                    
                    
                </div><!-- end of class clContent -->
            
            </div>
            <!-- containerL ends -->
            
            <!-- containerR starts -->
            <div id="containerR">
            
            	<?php include_once('pageparts/right_col.php') ?>
            
            </div>
            <!-- containerR ends -->
            
            <div class="clearfloat"></div>
        
        </div>
        <!-- container ends -->
        
        <!-- footer starts -->
        <div id="footer">
        	<? include_once('pageparts/footer.php') ?>
        </div>
        <!-- footer ends -->
    
    </div>
	<!-- main ends -->

</div>
<!-- wrapper ends -->
</body>
</html>
