<h1>News and Events</h1>
<!-- events starts -->
<div id="events">
    <ul>
    <?php
    $sno = 1;
    $sql = "select * from tbl_news where 1=1";
    $objDatabase->query=$sql;
    $result = $objDatabase->execute();
    while ($row = $objDatabase->fetch_array()) {
        ?>
        <li>
            <span class="eDate"><?php echo $row['news_date'] ?></span><br />
            <span class="eTitle"><?php echo $row['news_title'] ?></span><br />
            <?php echo substr($row['news_description'],0,200) ?> ..<br />
            <a href="index.php?p=newsdetail&news_id=<?php echo $row['news_id'] ?>" title="Read More...">Read More...</a>
        </li>
       <?php } ?>
    </ul>
</div>
<!-- events ends -->