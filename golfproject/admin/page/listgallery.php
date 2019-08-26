<?php
if (isset($_GET['mode']) == "D") {
    $image_id = $_GET['image_id'];
    $image_name = $_GET['image_name'];
    $galleryFolderPath = GALLERY_PATH . $image_name;
    @unlink($galleryFolderPath);
    $objDatabase->table='tbl_gallery';
    $objDatabase->cond=array('image_id'=>$image_id);
    if($objDatabase->delete()){
        echo '<script language="javascript">
                window.location="index.php?page=listgallery";
            </script>';
    }else{
      echo "error while deleting";  
    }
}
?>

<table width="98%" align="center" border="1" cellspacing="0" cellpadding="5">
    <tr>
        <td colspan="8" align="right">
            <a href="index.php?page=addgallery&mode=I">Add New Image</a>
        </td>
    </tr>
    <tr>
        <th>S.No.</th>
        <th>Image Title</th>
        <th>Image Description</th>
        <th>Image</th>
        <th>Image Date</th>
        <th>Status</th>
        <th colspan="2">Action</th>
    </tr>
    <?php
    $sno = 1;
    $sql = "select * from tbl_gallery where 1=1";
    $objDatabase->query=$sql;
    $result = $objDatabase->execute();
    while ($row = $objDatabase->fetch_array()) {
        ?>
        <tr>
            <td><?php echo $sno++ ?></td>
            <td><?php echo $row['image_title'] ?></td>
            <td><?php echo $row['image_description'] ?></td>
            <td>
            <img src="<?php echo GALLERY_PATH.$row['image_name']?>" width="100" height="80"/>
            <?php echo $row['image_name'] ?>
            </td>
            <td><?php echo $row['image_date'] ?></td>         
            <td>
                <?php
                $status = $row['status'] == 'Y' ? 'Active' : 'In-Active';
                echo $status;
                ?>
            </td>         
            <td>
                <a href="index.php?page=addgallery&mode=U&image_id=<?php echo $row['image_id'] ?>">Edit</a>
            </td>         
            <td>
                <a onclick="return confirm('Do you really want to delete ??')" href="index.php?page=listgallery&mode=D&image_id=<?php echo $row['image_id'] ?>&image_name=<?php echo $row['image_name'] ?>">Delete</a>
            </td>         
        </tr>
        <?php
    }
    ?>
</table>
