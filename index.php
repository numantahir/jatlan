<?php
require_once("config/config.php");

// require the language file
require_once('lang/' . strtolower(SITE_LANG) . '/rs_lang.website.php');

require_once("config/rewrite.php");

include_once(HTML_PATH . 'default.php');

/*
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
*/
?>