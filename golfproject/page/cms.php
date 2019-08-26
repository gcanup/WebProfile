 <?php
   $cms_id=$_GET['cms_id'];
    $sno = 1;
    $sql = "select * from tbl_cms where 1=1 and cms_id='$cms_id'";
    $objDatabase->query=$sql;
    $result = $objDatabase->execute();
    $dataCms=$objDatabase->fetch_array();
    ?>
<h1><?php echo $dataCms['cms_title'] ?></h1>
<?php echo $dataCms['cms_description'] ?>

