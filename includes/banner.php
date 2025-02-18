				<?php if(!isset($_GET['show']) || empty($_GET['show'])):?>
				<div class="flbanner">
					  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="704" height="148" title="Product Banner">
	                    <param name="movie" value="<?php echo SITE_URL;?>flash/intro.swf" />
	                    <param name="quality" value="high" />
	                    <param name="wmode" value="transparent" />
	                    <param name="menu" value="flase" />
	                    <embed src="<?php echo SITE_URL;?>flash/intro.swf" width="704" height="148" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="transparent" menu="flase"></embed>
          	    	</object>
				</div>
				<?php endif;?>