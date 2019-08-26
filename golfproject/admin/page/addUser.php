<?php
$con = mysqli_connect("localhost", "root",'', "my_db");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
$msg = "";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $con_password = $_POST['con_password'];
    $status = $_POST['status'];
    $user_id = $_POST['user_id'];
    $mode = $_POST['mode'];
    $isFormValid = true;
    
    if ($username == "") {
        $isFormValid = false;
        $msg.="User Name is Empty !!<br/>";
    }
    if ($fullname == "") {
        $isFormValid = false;
        $msg.="Full Name is Empty !!<br/>";
    }
    if ($password == "") {
        $isFormValid = false;
        $msg.="Password is Empty !!<br/>";
    }
    if ($con_password == "") {
        $isFormValid = false;
        $msg.="Confirm Password is Empty !!<br/>";
    }
    if ($password!=$con_password) {
        $isFormValid = false;
        $msg.="Password and Confirm Password Doesnot Match !!<br/>";
    }
    $password=md5($password);
    if ($isFormValid == true) {
        if ($mode == 'I') {
            $sql = "insert into admin_user(username,
                        fullname,
                        password,
                        email,
                        status) 
                    values('$username',
                        '$fullname',
                        '$password',
                        '$email',
                        '$status')";
        } else {
            $sql = "update admin_user
                    set
                        username='$username',
                        fullname='$fullname',
                        password='$password',
                        email='$email',
                        status='$status'
               where
                user_id='$user_id'
            ";
        }
        if ($con->query($sql)) {
            ///header('location:index.php');
            echo '<script language="javascript">
                window.location="index.php?page=listUser";
            </script>';
        } else {
            $msg = "Error While Inserting";
        }
    }
}
$mode = $_GET['mode'];
$user_id=isset($_GET['user_id'])? $_GET['user_id'] : '';
if ($mode == 'U') {
    $sql = "select * from admin_user where user_id='$user_id'";
    $result = $con->query($sql); 
    $row = mysqli_fetch_assoc($result);
}
//$en=base64_encode('Ram');
//echo "<br/>";
//echo md5('Ram');
//echo "<br/>";
//echo base64_decode($en);
?>
<fieldset>
    <legend><strong>User Registration</strong></legend>
    <form name="std_reg" id="std_reg" action="" method="post">
        <input type="hidden" name="user_id" value="<?php echo $row['user_id'] ?>"/>
        <input type="hidden" name="mode" value="<?php echo $mode ?>"/>
        <table width="60%" border="0">
            <tr>
                <td colspan="2" align="right">
                    <a href="index.php?page=listUser">Back</a>
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
                <td colspan="2" align="right">
                    <span class="red">*</span> Fields Indicate Mandatory Field
                </td>  
            </tr>
            <tr>
                <td>User Name</td>
                <td><input type="text" value="<?php echo isset($row['username'])?$row['username']:''?>" name="username" id="username" size="30" maxlength="100"/><span class="red">*</span></td>
            </tr>
            <tr>
                <td>Full Name</td>
                <td><input type="text" value="<?php echo isset($row['fullname'])?$row['fullname']:'' ?>" name="fullname" id="fullname" size="30" maxlength="100"/><span class="red">*</span></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" id="password" size="30" maxlength="100"/><span class="red">*</span></td>
            </tr>
            <tr>
                <td>Confirm Password</td>
                <td><input type="password" name="con_password" id="con_password" size="30" maxlength="100"/><span class="red">*</span></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" value="<?php echo isset($row['email'])?$row['email']:''?>" name="email" id="email" size="30" maxlength="200"/></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <input type="radio" name="status" id="status" value="Y" <?php echo isset($row['status'])?$row['status']=='Y'?'checked="checked"':$row['status']='N':$row['status']=''?>/>Active
                                <input type="radio" name="status" id="status" value="N" <?php echo isset($row['status'])?$row['status']=='N'?'checked="checked"':$row['status']='Y':$row['status']=''?>/>In-Active
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
</fieldset>