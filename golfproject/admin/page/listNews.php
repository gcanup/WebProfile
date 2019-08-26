<?php
if (isset($_GET['mode']) == "D") {
    $news_id = $_GET['news_id'];
    $objDatabase->table='tbl_news';
    $objDatabase->cond=array('news_id'=>$news_id);
    if($objDatabase->delete()){
        echo '<script language="javascript">
                window.location="index.php?page=listNews";
            </script>';
    }else{
      echo "error while deleting";  
    }
}
?>
<table width="98%" align="center" border="1" cellspacing="0" cellpadding="5">
    <tr>
        <td colspan="8" align="right">
            <a href="index.php?page=addNews&mode=I">Add New News</a>
        </td>
    </tr>
    <tr>
        <th>S.No.</th>
        <th>News Title</th>
        <th>News Reporter</th>
        <th>News Description</th>
        <th>News Date</th>
        <th>Status</th>
        <th colspan="2">Action</th>
    </tr>
    <?php
    $sno = 1;
    $sql = "select * from tbl_news where 1=1";
    $objDatabase->query=$sql;
    $result = $objDatabase->execute();
    while ($row = $objDatabase->fetch_array()) {
        ?>
        <tr>
            <td><?php echo $sno++ ?></td>
            <td><?php echo $row['news_title'] ?></td>
            <td><?php echo $row['news_reporter'] ?></td>
            <td><?php echo $row['news_description'] ?></td>
            <td><?php echo $row['news_date'] ?></td>         
            <td>
                <?php
                $status = $row['status'] == 'Y' ? 'Active' : 'In-Active';
                echo $status;
                ?>
            </td>         
            <td>
                <a href="index.php?page=addNews&mode=U&news_id=<?php echo $row['news_id'] ?>">Edit</a>
            </td>         
            <td>
                <a onclick="return confirm('Do you really want to delete ?')" href="index.php?page=listNews&mode=D&news_id=<?php echo $row['news_id'] ?>">Delete</a>
            </td>         
        </tr>
        <?php
    }
    ?>
</table>
