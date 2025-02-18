<?php
if (extension_loaded('zlib') && !ini_get('zlib.output_compression')){
    header('Content-Encoding: gzip');
	ob_start('ob_gzhandler');

echo join('',file('Qayad.js'));
ob_end_flush();
}
?>