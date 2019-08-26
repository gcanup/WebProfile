
<!-- crLogin starts -->
<div id="crLogin">

    <h2>Member Login</h2>

    <form action="" method="get">
        <div class="crlRow">
            <div class="crlRowL">Member ID:</div>
            <div class="crlRowR"><input name="" type="text" class="crlTxtBox" /></div>
            <div class="clearfloat"></div>
        </div><!-- end of class crlRow -->

        <div class="crlRow">
            <div class="crlRowL">Password:</div>
            <div class="crlRowR"><input name="" type="password" class="crlTxtBox" /></div>
            <div class="clearfloat"></div>
        </div><!-- end of class crlRow -->

        <div class="crlRow">
            <div class="crlRowL">&nbsp;</div>
            <div class="crlRowR">
                <select name="select" id="select" class="crlSelect">
                    <option>Registered Member</option>
                    <option>Non Registered Member</option>
                </select>
            </div>
            <div class="clearfloat"></div>
        </div><!-- end of class crlRow -->

        <div class="crlRow">
            <div class="crlRowL">&nbsp;</div>
            <div class="crlRowR"><input name="" type="image" src="images/but-login.gif" /></div>
            <div class="clearfloat"></div>
        </div><!-- end of class crlRow -->

        <div class="crlRow">
            <div class="crlRowL">&nbsp;</div>
            <div class="crlRowR"><a href="index.php?p=signup" title="New Member - Sign up">New Member - Sign up</a></div>
            <div class="clearfloat"></div>
        </div><!-- end of class crlRow -->

    </form>
</div>
<!-- crLogin ends -->

<!-- crNews starts -->
<div id="crNews">
    <h2>News and events</h2>
    <ul>
            <?php
            $sno = 1;
            $sql = "select * from tbl_news where 1=1 order by news_date desc";
            $objDatabase->query = $sql;
            $result = $objDatabase->execute();
            while ($row = $objDatabase->fetch_array()) {
                if($sno==3)
                {
                    break;
                }
                $sno++;
                ?>
                <li>
                    <span class="eDate"><?php echo $row['news_date'] ?></span><br />
                    <span class="crnTitle"><?php echo $row['news_title'] ?></span><br />
                    <?php echo substr($row['news_description'], 0, 200) ?> ..<br />
                    <a href="index.php?p=newsdetail&news_id=<?php echo $row['news_id'] ?>" title="Read More....">Read More....</a>
                </li>
            <?php } ?>
            <li><a href="index.php?p=news" title="More News and Events....">More News and Events....</a></li>
        </ul>
</div>
<!-- crNews ends -->

<div class="crAdBox"><a href="<?php echo SITE_FRONT_URL?>images/lightbox/ad-001.jpg" title="Course Guide" rel="lightbox"> <img src="<?php echo SITE_FRONT_URL?>images/lightbox/ad-001.jpg" alt="Course Guide" /></a></div><!-- end of class crAdBox -->
<div class="crAdBox"><a href="images/lightbox/ad-002.jpg" title="Code of Conduct" rel="lightbox"><img src="images/lightbox/ad-002.jpg" alt="Code of Conduct" /></a></div><!-- end of class crAdBox -->