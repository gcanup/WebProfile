<?php
if ($_GET['mode'] == "D") {
    $cms_id = $_GET['cms_id'];
    $objDatabase->table='tbl_cms';
    $objDatabase->cond=array('cms_id'=>$cms_id);
    if($objDatabase->delete()){
       echo '<script language="javascript">
                window.location="index.php?page=listcms";
            </script>';
    }else{
      echo "error while deleting";  
    }
}
?>
<table width="98%" align="center" border="1" cellspacing="0" cellpadding="5">
    <tr>
        <td colspan="8" align="right">
            <a href="index.php?page=addCms&mode=I">Add New Content</a>
        </td>
    </tr>
    <tr>
        <th>S.No.</th>
        <th>Content Title</th>
        <th>Content Description</th>
        <th>Content Date</th>
        <th>Content Order</th>
        <th>Status</th>
        <th colspan="2">Action</th>
    </tr>
    <?php
    $sno = 1;
    $sql = "select * from tbl_cms where 1=1";
    $objDatabase->query=$sql;
    $result = $objDatabase->execute();
    while ($row = $objDatabase->fetch_array()) {
        ?>
        <tr>
            <td><?php echo $sno++ ?></td>
            <td><?php echo $row['cms_title'] ?></td>
            <td><?php echo substr($row['cms_description'],0,200) ?> .....</td>
            <td><?php echo $row['cms_date'] ?></td>         
            <td><?php echo $row['cms_order'] ?></td>
            <td>
                <?php
                $status = $row['status'] == 'Y' ? 'Active' : 'In-Active';
                echo $status;
                ?>
            </td>         
            <td>
                <a href="index.php?page=addCms&mode=U&cms_id=<?php echo $row['cms_id'] ?>">Edit</a>
            </td>         
            <td>
                <a onclick="return confirm('Do you really want to delete ??')" href="index.php?page=listCms&mode=D&cms_id=<?php echo $row['cms_id'] ?>">Delete</a>
            </td>         
        </tr>
        <?php
    }
    ?>
</table>