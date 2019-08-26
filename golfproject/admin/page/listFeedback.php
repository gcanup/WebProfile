<?php
if ($_GET['mode'] == "D") {
    $enquiry_id = $_GET['enquiry_id'];
    $objDatabase->table = 'tbl_feedback';
    $objDatabase->cond = array('enquiry_id' => $enquiry_id);
    if ($objDatabase->delete()) {
        redirect('index.php?page=listFeedback');
    } else {
        echo "error while deleting";
    }
}
?>
<fieldset>
    <legend>Search Enquiry</legend>
    <form name="searchEnquiry" action="" method="post">
        <table width="98%" align="center" border="1" cellspacing="0" cellpadding="5">
            <tr>
                <td align="right">
                    Name:
                </td>
                <td>
                    <input type="text" value="<?php echo $_POST['name'] ?>" name="name" id="name"/>
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
                    Country:
                </td>
                <td>
                    <?php echo generateCountrySelect($_POST['country']);?>
                </td>
                <td align="right">
                    Date of Enquiry:
                </td>
                <td>
                    From: <input type="text" id="from_enquiry_date" value="<?php echo $_POST['from_enquiry_date'] ?>" name="from_enquiry_date"/>
                    <span>
                    <img src="calender/cal.gif" id="calendar-trigger"/>
                    </span>
                    <script>			
                        Calendar.setup({
                            trigger    : "calendar-trigger",
                            dateFormat: "%Y-%m-%d",
                            inputField : "from_enquiry_date",
                            min: 20060108,
                            max: 20681225,
                            onSelect   : function() { this.hide("slow") }
                        });
                    </script>
                    To: <input type="text" id="to_enquiry_date" value="<?php echo $_POST['to_enquiry_date'] ?>" name="to_enquiry_date"/>
                    <span>
                    <img src="calender/cal.gif" id="calendar-trigger1"/>
                    </span>
                    <script>			
                        Calendar.setup({
                            trigger    : "calendar-trigger1",
                            dateFormat: "%Y-%m-%d",
                            inputField : "to_enquiry_date",
                            min: 20060108,
                            max: 20681225,
                            onSelect   : function() { this.hide("slow") }
                        });
                    </script>
                </td>
            </tr>
            <tr>
                <td colspan="4" align="center">
                    <input type="submit" name="submit" id="submit" value="Search"/>&nbsp;&nbsp;&nbsp;
                    <input type="reset" name="reset" id="reset" value="Clear" onclick="window.location='index.php?page=listFeedback'"/>
                </td>
            </tr>
        </table>
    </form>
</fieldset>
<br/>
<table width="98%" align="center" border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th>S.No.</th>
        <th>Date</th>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Country</th>
        <th>Subject</th>
        <th>Message</th>
        <th colspan="2">Action</th>
    </tr>
    <?php
    $sno = 1;
    $sql = "select * from tbl_feedback where 1=1";
    if ($_POST['name'] != "") {
        $name = $_POST['name'];
        $sql.=" and name like '%$name%'";
    }
    if ($_POST['address'] != "") {
        $address = $_POST['address'];
        $sql.=" and address like '%$address%'";
    }
    if ($_POST['country'] != "") {
        $country = $_POST['country'];
        $sql.=" and country = '$country'";
    }
    if ($_POST['from_enquiry_date'] != "" && $_POST['to_enquiry_date'] != "") {
        $from_enquiry_date = $_POST['from_enquiry_date'];
        $to_enquiry_date = $_POST['to_enquiry_date'];
        $sql.=" and enquiry_date between '$from_enquiry_date' and '$to_enquiry_date'";
    }
    //echo $sql;
    $objDatabase->query = $sql;
    $result = $objDatabase->execute();
    while ($row = $objDatabase->fetch_array()) {
        ?>
        <tr>
            <td><?php echo $sno++ ?></td>
            <td><?php echo $row['enquiry_date'] ?></td>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['address'] ?></td>
            <td><?php echo $row['country'] ?></td>
            <td><?php echo $row['subject'] ?></td>         
            <td><?php echo substr($row['message'], 0, 100) ?>.....</td>         
            <td>
                <a onclick="return confirm('Do you really want to send Response ??')" href="index.php?page=sendMail&enquiry_id=<?php echo $row['enquiry_id'] ?>">Response</a>
            </td>         
            <td>
                <a onclick="return confirm('Do you really want to delete ??')" href="index.php?page=listFeedback&mode=D&enquiry_id=<?php echo $row['enquiry_id'] ?>">Delete</a>
            </td>         
        </tr>
        <?php
    }
    ?>
</table>