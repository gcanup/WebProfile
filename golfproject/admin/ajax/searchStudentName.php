<?php
error_reporting(E_ALL & ~E_NOTICE);//To show all error except Notic error which distrub us
include_once('../includes/functions.php');
$objDatabase1 = new Functions();
if(isset($_POST['nameValue'])){
    //echo $_POST['nameValue'];
    $searchValue=$_POST['nameValue'];
    $sqlSelect="SELECT * FROM student where name like '%$searchValue%' order by std_id" ;
    $objDatabase1->query=$sqlSelect;
    $objDatabase1->execute();
    $strDisplay='<ul style="list-style-type: none;padding:0;margin:0">'; //Don't show bullet icon we gave style
    while($row=$objDatabase1->fetch_array()){
     $strDisplay.='<li>'.$row["name"].'</li>';
    }
    $strDisplay.='</ul>';
    echo $strDisplay;
    exit;
}

