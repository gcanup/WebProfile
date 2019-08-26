<?php
error_reporting(E_ALL & ~E_NOTICE);
include_once('includes/Database.php');
$objDatabaseLogin = new Database();
session_start();
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $isFormValid = true;
    if ($username == "") {
        $isFormValid = false;
        $msg.="User Name is Empty !!<br/>";
    }
    if ($password == "") {
        $isFormValid = false;
        $msg.="Password is Empty !!<br/>";
    }
    $password = md5($password);
    if ($isFormValid == true) {
        $sql = "select * from admin_user where username='$username' && password='$password'";
        $objDatabaseLogin->query = $sql;
        $result = $objDatabaseLogin->execute();
        $total_rows = mysqli_num_rows($result);
        $row=mysqli_fetch_assoc($result);
        if ($total_rows > 0) {
          $_SESSION['user_id']=$row['user_id'];  
          $_SESSION['username']=$row['username'];  
          $_SESSION['fullname']=$row['fullname'];  
          $_SESSION['email']=$row['email'];  
          header('location:index.php');  
        }else{
          $msg.="User name or Password is Incorrect !!<br/>";  
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Student Management System:: Admin Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body onload="">
        <div id="wrapper">
            <div id="header">
                <h2>Welcome to Site Administration Panel</h2>
            </div>
            <div id="content">
                <fieldset>
                    <legend><strong>Admin Login</strong></legend>
                    <form name="admin_login" id="admin_login" action="" method="post">
                        <table width="60%" border="0">
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
                                <td>User Name</td>
                                <td><input type="text" value="<?php echo isset($_POST['username']) ?>" name="username" id="username" size="30" maxlength="100"/><span class="red">*</span></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td><input type="password" name="password" id="password" size="30" maxlength="100"/><span class="red">*</span></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <input type="submit" name="submit" id="submit" value="Login"/>&nbsp;&nbsp;&nbsp;
                                    <input type="reset" name="reset" id="reset" value="Clear"/>
                                </td>
                            </tr>
                        </table>
                    </form>
                </fieldset>
            </div>
            <br/>
            <div id="footer">
                <?php include_once('pageparts/footer.php') ?>
            </div>
        </div>
    </body>
</html>
