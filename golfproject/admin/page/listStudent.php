<?php
if (isset($_GET['mode']) == "D") {
    $std_id = $_GET['std_id'];
    $objDatabase->table = 'student';
    $objDatabase->cond = array('std_id' => $std_id);
    if ($objDatabase->delete()) {
        echo '<script language="javascript">
                window.location="index.php?page=listcms";
            </script>';
    } else {
        echo "error while deleting";
    }
}
?>
<script language="javascript">
    $(document).ready(function () {
   $("#searchNameListStudent").keyup(function (){
       var userName=$("#searchNameListStudent").val(); 
        $.ajax({
            type: 'POST',
            url:  "ajax/searchStudentName.php",
            data : {nameValue:userName},
            success: function (data) {
                $("#container").html(data);
            }
          });
        });
        //To set value when we click in list of hint appear below textfield
        $(document).on('click','li',function (){ 
               $('#searchNameListStudent').val($(this).text());
               $("#container").fadeOut();
         });
    });            
</script>
<fieldset>
    <legend>Search Student</legend>
    <form name="searchStudent" action="" method="post">
        <table width="98%" align="center" border="1" cellspacing="0" cellpadding="5">
            <tr>
                <td align="right">
                    Name:
                </td>
                <td>
                    <input type="text" value="<?php echo $_POST['name'] ?>" name="name" id="searchNameListStudent"/>
                    <div id="container" style="background:cyan;border:1px solid green;color:blue;width:140px;text-decoration: none;">
                    </div>
                </td>
                <td align="right">
                    Address:
                </td>
                <td>
                    <input type="text" value="<?php echo $_POST['address'] ?>" name="address"/>
                </td>
            </tr>
            <tr>
                <td align="right">
                    Gender:
                </td>
                <td>
                    <select name="gender" id="gender">
                        <option value="">--Select Gender--</option>
                        <option value="M" <?php
                        if ($_POST['gender'] == 'M') {
                            echo 'selected="selected"';
                        }
                        ?>>Male</option>
                        <option value="F" <?php
                        if ($_POST['gender'] == 'F') {
                            echo 'selected="selected"';
                        }
                        ?>>Female</option>
                    </select>
                </td>
                <td align="right">
                    Date of Birth:
                </td>
                <td>
                    <input type="text" value="<?php echo $_POST['dob'] ?>" name="dob"/>
                </td>
            </tr>
            <tr>
                <td colspan="4" align="center">
                    <input type="submit" name="submit" id="submit" value="Search"/>&nbsp;&nbsp;&nbsp;
                    <input type="reset" name="reset" id="reset" value="Clear" onclick="window.location ='index.php?page=listStudent'"/>
                </td>
            </tr>
        </table>
    </form>
</fieldset>
<br/>
<table width="80%" align="center" border="1" cellspacing="0" cellpadding="5">
    <tr>
        <td colspan="8" align="right">
            <a href="index.php?page=addStudent&mode=I">Add New Student</a> <!-- we gave I in mode for insert -->
        </td>
    </tr>
    <tr>
        <th>S.No.</th>
        <th>Name</th>
        <th>Age</th>
        <th>Address</th>
        <th>DOB</th>
        <th>Status</th>
        <th colspan="2">Action</th>
    </tr>
    <?php
    $sql = "select * from student where 1=1";
    if ($_POST['name'] != "") {
        $name = $_POST['name'];
        $sql.=" and name like '%$name%'";
    }
    if ($_POST['address'] != "") {
        $address = $_POST['address'];
        $sql.=" and address like '%$address%'";
    }
    if ($_POST['gender'] != "") {
        $gender = $_POST['gender'];
        $sql.=" and gender = '$gender'";
    }
    if ($_POST['dob'] != "") {
        $dob = $_POST['dob'];
        $sql.=" and dob = '$dob'";
    }
    //echo $sql;
    $objDatabase->query = $sql;
    $result = $objDatabase->execute();
    while ($row = $objDatabase->fetch_array()) {
        ?>

        <tr>
            <td><?php echo $sno++ ?></td>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['age'] ?></td>
            <td><?php echo $row['address'] ?></td>
            <td><?php echo $row['dob'] ?></td>         
            <td>
    <?php
    $status = $row['status'] == 'Y' ? 'Active' : 'In-Active';
    echo $status;
    ?>
            </td>         
            <td>
                <a href="index.php?page=addStudent&mode=U&std_id=<?php echo $row['std_id'] ?>">Edit</a>
            </td>         
            <td>
                <a onclick="return confirm('Do you really want to delete ??')" href="index.php?page=listStudent&mode=D&std_id=<?php echo $row['std_id'] ?>">Delete</a>
            </td>         
        </tr>
    <?php
}
?>
</table>
