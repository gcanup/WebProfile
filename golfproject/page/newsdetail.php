<h1>News and Events</h1>
<!-- events starts -->
<div id="events">
 <ul>
    <?php
    $new_id=$_GET['news_id'];
    $sno = 1;
    $sql = "select * from tbl_news where 1=1 and news_id='$new_id'";
    $objDatabase->query=$sql;
    $result = $objDatabase->execute();
    while ($row = $objDatabase->fetch_array()) {
        ?>
        <li>
            <span class="eDate"><?php echo $row['news_date'] ?></span><br />
            <span class="eTitle"><?php echo $row['news_title'] ?></span><br />
            <?php echo $row['news_description'] ?><br />           
        </li>
       <?php } ?>
    </ul>
</div>
<!-- events ends -->

