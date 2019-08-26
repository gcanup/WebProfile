<?php
$objDatabase->table='tbl_news';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $news_title = $_POST['news_title'];
    $news_reporter = $_POST['news_reporter'];
    $news_description = $_POST['news_description'];
    $news_date = $_POST['news_date'];
    $status = $_POST['status'];
    $remarks = $_POST['remarks'];
    $news_id = $_POST['news_id'];
    $mode = $_POST['mode'];
    $isFormValid = true;
    $success=false;
    $msg = "";
    if ($news_title == "") {
        $isFormValid = false;
        $msg.="News Title is Empty !!<br/>";
    }
    if ($news_reporter == "") {
        $isFormValid = false;
        $msg.="New Reporter is Empty !!<br/>";
    }
    if ($news_date == "") {
        $isFormValid = false;
        $msg.="News Date is Empty !!<br/>";
    }
    if ($isFormValid == true) {
        $objDatabase->data=array("news_title"=>$news_title,
                                 "news_reporter"=>$news_reporter,
                                 "news_description"=>$news_description,
                                 "news_date"=>$news_date,
                                 "status"=>$status,
                                 "remarks"=>$remarks,
                                );
        if ($mode == 'I') {            
           $success=$objDatabase->insert(); 
        } else {
           $objDatabase->cond=array('news_id'=>$news_id); 
           $success=$objDatabase->update();
        }
        if($success==true){
          echo '<script language="javascript">
                window.location="index.php?page=listNews";
            </script>';
        }else{
            $msg = "Error While Inserting";
        }
        
    }
}
$mode = $_GET['mode'];
$news_id=isset($_GET['news_id'])? $_GET['news_id'] : '';
if ($mode == 'U') {
    $sql = "select * from tbl_news where news_id='$news_id'";
    $objDatabase->query = $sql;
    $result = $objDatabase->execute();
    $row = mysqli_fetch_assoc($result);
}
?>
<form name="std_reg" id="std_reg" action="" method="post" onsubmit="return validateForm(this)">
    <input type="hidden" name="news_id" value="<?php echo $row['news_id'] ?>"/>
    <input type="hidden" name="mode" value="<?php echo $mode ?>"/>
    <table width="80%" border="0">
        <tr>
            <td colspan="2" align="right">
                <a href="index.php?page=listNews">Back</a>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="err_msg">
                    <?php
                    echo $msg;
                    ?> 
                </div>
            </td>  
        </tr>
        <tr>
            <td>New Title</td>
            <td><input type="text" value="<?php echo $row['news_title'] ?>" name="news_title" id="news_title" size="40" /></td>
        </tr>
        <tr>
            <td>New Reporter</td>
            <td><input type="text" value="<?php echo $row['news_reporter'] ?>" name="news_reporter" id="news_reporter" size="40"/></td>
        </tr>
        <tr>
            <td>News Date</td>
            <td><input type="text" value="<?php echo $row['news_date'] ?>" name="news_date" id="news_date" size="40" maxlength="200"/></td>
        </tr>
         <tr>
            <td>New Description</td>
            <td>
                <textarea rows="5" cols="50" name="news_description" id="news_description"><?php echo $row['news_description'] ?></textarea>
            </td>
        </tr>
        <tr>
            <td>Status</td>
            <td>
                <input type="radio" name="status" id="status" value="Y" <?php if ($row['status'] == 'Y') {
                        echo 'checked="checked"';
                    } ?>/>Active
                <input type="radio" name="status" id="status1" value="N" <?php if ($row['status'] == 'N') {
                        echo 'checked="checked"';
                    } ?>/>In-Active
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" name="submit" id="submit" value="Save"/>&nbsp;&nbsp;&nbsp;
                <input type="reset" name="reset" id="reset" value="Clear"/>
            </td>
        </tr>
    </table>
</form>
