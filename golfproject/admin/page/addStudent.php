<?php
$objDatabase->table='student';
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $std_name = $_POST['std_name'];
    $std_age = $_POST['std_age'];
    $std_address = $_POST['std_address'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $status = $_POST['status'];
    $remarks = $_POST['remarks'];
    $std_id = $_POST['std_id'];
    $mode = $_POST['mode'];
    $isFormValid = true;
    $success=false;
    if ($std_name == "") {
        $isFormValid = false;
        $msg.="Name is Empty !!<br/>";
    }
    if ($std_age == "") {
        $isFormValid = false;
        $msg.="Age is Empty !!<br/>";
    }
    if ($gender == "") {
        $isFormValid = false;
        $msg.="Gender is Empty !!<br/>";
    }
    if ($isFormValid == true) {
        $objDatabase->data=array("name"=>$std_name,
                                 "age"=>$std_age,
                                 "address"=>$std_address,
                                 "gender"=>$gender,
                                 "dob"=>$dob,
                                 "status"=>$status,
                                 "remarks"=>$remarks,
                                );
        if ($mode == 'I') {            
           $success=$objDatabase->insert(); 
        } else {
           $objDatabase->cond=array('std_id'=>$std_id); 
           $success=$objDatabase->update();
        }
        if($success==true){
            echo '<script language="javascript">
                window.location="index.php?page=listStudent";
            </script>';
           
        }else{
            $msg = "Error While Inserting";
        }
        
    }
}
// TO load data to the form.
$mode=$_GET['mode'];
$std_id=isset($_GET['std_id'])? $_GET['std_id'] : '';
if($mode=='U'){
   $sql = "select * from student where std_id='$std_id'";
   $objDatabase->query = $sql;
   $result = $objDatabase->execute();
   $row = mysqli_fetch_assoc($result);
}
?>

                    <form name="std_reg" id="std_reg" action="" method="post" onsubmit="return validateForm(this)">
                   <input type="hidden" name="std_id" value="<?php echo $row['std_id']?>"/>
                   <input type="hidden" name="mode" value="<?php echo $mode?>"/> <!--to send mode by hidden to show it we use fire bug.-->
                    <table width="80%" border="0">
                        <tr>
                            <td colspan="2" align="right">
                                <a href="index.php?page=liststudent">Back</a>
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
                            <td>Name</td>
                            <td><input type="text" value="<?php echo isset($row['name'])?$row['name'] : '' ?>" name="std_name" id="std_name" size="40" maxlength="100"/></td>
                        </tr>
                        <tr>
                            <td>Age</td>
                            <td><input type="text" value="<?php echo isset($row['age'])? $row['age'] : ''?>" name="std_age" id="std_age" size="10" maxlength="2"/></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><input type="text" value="<?php echo isset($row['address'])? $row['address'] : '' ?>" name="std_address" id="std_address" size="60" maxlength="200"/></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>
                                 
                                <select name="gender" id="gender">
                                    <option value="">--Select Gender--</option>
                                    <option value="M" <?php echo isset($row['gender'])?$row['gender']=='M'?'selected="selected"':$row['gender']='F':$row['gender']=''?>>Male</option>
                                    <option value="F" <?php echo isset($row['gender'])?$row['gender']=='F'?'selected="selected"':$row['gender']='M':$row['gender']=''?>>Female</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Date of Birth</td>
                            <td><input type="text" value="<?php echo isset($row['dob'])? $row['dob'] : '' ?>" name="dob" id="dob" size="30" maxlength="15"/></td>
                        </tr>
                        <!--<tr>
                            <td>Hobbies</td>
                            <td>
                                <input type="checkbox" name="dance" id="dance" value="dance"/>Dance<br/>
                                <input type="checkbox" name="music" id="music" value="music"/>Music<br/>
                                <input type="checkbox" name="swimming" id="swimming" value="swimming"/>Swimming<br/>
                                <input type="checkbox" name="painting" id="painting" value="painting"/>Painting<br/>
                            </td>
                        </tr>-->
                        <tr>
                            <td>Status</td>
                            <td>
                                <input type="radio" name="status" id="status" value="Y" <?php echo isset($row['status'])?$row['status']=='Y'?'checked="checked"':$row['status']='N':$row['status']=''?>/>Active
                                <input type="radio" name="status" id="status" value="N" <?php echo isset($row['status'])?$row['status']=='N'?'checked="checked"':$row['status']='Y':$row['status']=''?>/>In-Active
                            </td>
                        </tr>
                        <tr>
                            <td>Remarks</td>
                            <td>
                                <textarea rows="5" cols="50" name="remarks" id="remarks"><?php echo isset($row['remarks'])? $row['remarks'] : ''  ?></textarea>
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
            
            