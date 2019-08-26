<?php
$objDatabase->table='tbl_gallery';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $image_title = $_POST['image_title'];
    echo "<pre>";
    print_r($_FILES['image_name']);exit;
    $image_name = $_FILES['image_name']['name'];
    $tmp_path = $_FILES['image_name']['tmp_name'];
    $image_size = $_FILES['image_name']['size'];
    $image_description = $_POST['image_description'];
    $image_date = $_POST['image_date'];
    $old_image = $_POST['old_image'];
    $status = $_POST['status'];
    $image_id = $_POST['image_id'];
    $mode = $_POST['mode'];
    $isFormValid = true;
    $success=false;
    $msg = "";
    if ($image_title == "") {
        $isFormValid = false;
        $msg.="Image Title is Empty !!<br/>";
    }
    if ($image_name == "") {
        $isFormValid = false;
        $msg.="Image Name is Empty !!<br/>";
    }
    if ($image_date == "") {
        $isFormValid = false;
        $msg.="Image Date is Empty !!<br/>";
    }
    
//   Escaping quotes 
//     $str='This is ram \'s book';
//    $str="This is ram's book";
//    
//    $table="<table width=\"100%\"></table>";
//    $table='<table width="100%"></table>';
    $image_name='img_'.date('Ymd').rand(99999,99999999).$image_name;
    $galleryFolderPath = GALLERY_PATH . $image_name;
    if ($isFormValid == true) {
        if ($image_name!="") {
            if (!move_uploaded_file($tmp_path, $galleryFolderPath)) {
                echo "Failed to upload image";
                exit;
            }
        }
        $objDatabase->data=array("image_title"=>$image_title,
                                 "image_name"=>$image_name,
                                 "image_description"=>$image_description,
                                 "image_date"=>$image_date,
                                 "status"=>$status
                                );
        if ($mode == 'I') {            
           $success=$objDatabase->insert(); 
        } else {
            if ($image_name=="") {
                $galleryFolderPath = GALLERY_PATH . $old_image;
                @unlink($galleryFolderPath);
            } else {
                $image_name = $old_image;
            }
           $objDatabase->cond=array('image_id'=>$image_id); 
           $success=$objDatabase->update();
        }
        if($success==true){
          echo '<script language="javascript">
                window.location="index.php?page=listgallery";
            </script>';
        }else{
            $msg = "Error While Inserting";
        }
        
    }
}
$mode = $_GET['mode'];
$image_id = isset($_GET['image_id'])? $_GET['image_id'] : '';
if ($mode == 'U') {
    $sql = "select * from tbl_gallery where image_id='$image_id'";
    $objDatabase->query = $sql;
    $result = $objDatabase->execute();
    $row = mysqli_fetch_assoc($result);
}
?>
<form name="std_reg" id="std_reg" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="image_id" value="<?php echo $row['image_id'] ?>"/>
    <input type="hidden" name="mode" value="<?php echo $mode ?>"/>
    <table width="80%" border="0">
        <tr>
            <td colspan="2" align="right">
                <a href="index.php?page=listgallery">Back</a>
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
            <td>Image Title</td>
            <td><input type="text" value="<?php echo $row['image_title'] ?>" name="image_title" id="image_title" size="40" /></td>
        </tr>
        <tr>
            <td>Image</td>
            <td><input type="file" name="image_name" id="image_name" value="<?php echo $row['image_name'] ?>" size="40"/></td>
        </tr>
        <tr>
            <td>Image Date</td>
            <td><input type="text" value="<?php echo $row['image_date'] ?>" name="image_date" id="image_date" size="40" maxlength="200"/></td>
        </tr>
         <tr>
            <td>Image Description</td>
            <td>
                <textarea rows="5" cols="50" name="image_description" id="image_description"><?php echo $row['image_description'] ?></textarea>
            </td>
        </tr>
        <?php
        if ($row['image_name'] != "") {
            ?>
            <tr>
                <td width="20%" height="30" >Existing Image : &nbsp;</td>
                <td>&nbsp;<img src="<?php echo GALLERY_PATH . $row['image_name'] ?>" height="150" width="150" />
                    <input type="hidden" name="old_image" value="<?php echo $row['image_name'] ?>" />
                </td>
            </tr>
        <?php } ?>
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
