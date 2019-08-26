<?php
include_once('Database.php');
include_once("class.paging.php");

class Functions extends Database {

    public function listings($sql, $path, $plimit=100, $seo=0, $debug=false) {

        if ($debug) {
            die($sql);
        } else {
            $pagelist = $sql;
            $pageid = 1; // Get the pid value 	
            if (isset($_REQUEST['np']))
                $pageid = $_REQUEST['np'];
            $Paging = new paging($seo);
            $Paging->conObj = $this->obj = new Database;
            $records = $Paging->myRecordCount($pagelist); // count records
            $totalpage = $Paging->processPaging($plimit, $pageid);
            $resultlist = $Paging->startPaging($pagelist); // get records in the databse
            $links = $Paging->pageLinks($path . (isset($queryString) ? "?" . $queryString : "")); // 1234 links
            unset($Paging);

            $pagingValue = array($records, $resultlist, $links);
            return $pagingValue;
        }
    }
    function listAdminUser($sql){
       $vals = $this->listings($sql, "index.php?page=listUser", 3, 0, false);
       return $vals; 
    }
    function listStudentPage($sql){
      $vals = $this->listings($sql, "index.php?page=listStudent", 4, 0, false);
      return $vals;  
    }
    function listNewsPage() {
        $sql = "SELECT * FROM tbl_news order by news_id desc";
        $vals = $this->listings($sql, "index.php?page=listNews", 4, 0, false);
        return $vals;
    }

    function listGalleryPage() {
        $sql = "SELECT * FROM tbl_galary order by image_id desc";
        $vals = $this->listings($sql, "index.php?page=listgallery", 4, 0, false);
        return $vals;
    }

    function listContentPage() {
        $sql = "SELECT * FROM tbl_cms order by cms_id desc";
        $vals = $this->listings($sql, "index.php?page=listcms", 4, 0, false);
        return $vals;
    }

    function listBannerPage() {
        $sql = "select
				   tb.banner_id,
							tb.cms_id,
							tb.banner_title,
							tb.banner_image,
							tb.banner_date,
							tb.is_active,
							tc.cms_title
						from 
							tbl_banner tb
						JOIN tbl_cms tc 
						ON (tb.cms_id=tc.cms_id)
				order by tb.banner_id desc";
        $vals = $this->listings($sql, "index.php?page=listBanner", 4, 0, false);
        return $vals;
    }

    function listAllCmsPage() {
        $sql = "SELECT * FROM `tbl_cms` order by cms_id desc";
        $result = $this->exec($sql);
        return $result;
    }

    function adsPageSelected($ads_id) {
        $sql = "select * from `tbl_ads` where ads_id='$ads_id'";
        $result = $this->exec($sql);
        return $this->fetch_array($result);
    }

}

// end class
?>