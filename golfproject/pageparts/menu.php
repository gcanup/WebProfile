<a href="index.php" title="Home" class="navActive">Home</a>
<?php
//dynamic menus from tbl_cms
$sql = "select * from tbl_cms where 1=1 and status='Y'";
$objDatabase->query = $sql;
//echo $objDatabase->show_query();
$rest = $objDatabase->execute();

while ($row = $objDatabase->fetch_array()) {
    ?>
    <a href="index.php?p=cms&cms_id=<?php echo $row['cms_id'] ?>" title="<?php echo $row['cms_title'] ?>">
    <?php echo $row['cms_title'] ?></a>
<?php } ?>
<a href="index.php?p=news" title="News">News</a>
<a href="index.php?p=gallery" title="Gallery">Gallery</a>
<a href="index.php?p=contactus" title="Contact">Contact</a>
<div class="clearfloat"></div>
