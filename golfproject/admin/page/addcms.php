<?php
$objDatabase->table='tbl_cms';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $cms_title = $_POST['cms_title'];
    $cms_order = $_POST['cms_order'];
    $cms_description = $_POST['cms_description'];
    $cms_date = $_POST['cms_date'];
    $status = $_POST['status'];
    $cms_id = $_POST['cms_id'];
    $mode = $_POST['mode'];
    $isFormValid = true;
    $success=false;
    $msg = "";
    if ($cms_title == "") {
        $isFormValid = false;
        $msg.="Cms Title is Empty !!<br/>";
    }
    if ($cms_date == "") {
        $isFormValid = false;
        $msg.="Cms Date is Empty !!<br/>";
    }
    if ($isFormValid == true) {
        $objDatabase->data=array("cms_title"=>$cms_title,
                                 "cms_order"=>$cms_order,
                                 "cms_description"=>$cms_description,
                                 "cms_date"=>$cms_date,
                                 "status"=>$status
                                );
        if ($mode == 'I') {            
           $success=$objDatabase->insert(); 
        } else {
           $objDatabase->cond=array('cms_id'=>$cms_id); 
           $success=$objDatabase->update();
        }
        //$objFunction->show_query();
        //exit;
        if($success==true){
            echo '<script language="javascript">
                window.location="index.php?page=listcms";
            </script>';
        }else{
            $msg = "Error While Inserting";
        }
        
    }
}
$mode = $_GET['mode'];
$cms_id =isset($_GET['cms_id'])? $_GET['cms_id'] : '';
if ($mode == 'U') {
    $sql = "select * from tbl_cms where cms_id='$cms_id'";
    $objDatabase->query = $sql;
   $result = $objDatabase->execute();
    $row = mysqli_fetch_assoc($result);
}
?>
<form name="cms_entry" id="cms_entry" action="" method="post">
    <input type="hidden" name="cms_id" value="<?php echo $row['cms_id'] ?>"/>
    <input type="hidden" name="mode" value="<?php echo $mode ?>"/>
    <table width="98%" border="0">
        <tr>
            <td colspan="2" align="right">
                <a href="index.php?page=listCms">Back</a>
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
            <td>Content Title</td>
            <td><input type="text" value="<?php echo $row['cms_title'] ?>" name="cms_title" id="cms_title" size="40" /></td>
        </tr>
        <tr>
            <td>Content Date</td>
            <td>
                <input type="text" value="<?php echo $row['cms_date'] ?>" name="cms_date" id="cms_date" size="40" maxlength="200"/>
                <span>
                    <img src="calender/cal.gif" id="calendar-trigger"/>
                </span>
                <script>			
                    Calendar.setup({
                        trigger    : "calendar-trigger",
                        dateFormat: "%Y-%m-%d",
                        inputField : "cms_date",
                        min: 20060108,
                        max: 20681225,
                        onSelect   : function() { this.hide("slow") }
                    });
                </script>
            </td>
        </tr>
         <tr>
            <td>Content Description</td>
            <td>
                <textarea rows="5" cols="50" name="cms_description" id="cms_description" class="ckeditor"><?php echo $row['cms_description'] ?></textarea>
                
            </td>
        </tr>
        <tr>
            <td>Content Order</td>
            <td><input type="text" value="<?php echo $row['cms_order'] ?>" name="cms_order" id="cms_order" size="40"/></td>
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