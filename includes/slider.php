<section class="main-slider">
			
				<div class="paging">
					<a href="#" class="previous"></a>
					<a href="#" class="next"></a>
				</div>
				
				<nav>
					<span id="pager">
                    <?php
					$objSliderCounter = new Slider;
					$objSliderCounter->setProperty("is_active", "1");					
					$objSliderCounter->lstSlider();
					$SliderCounter = 0;
					while($HomeSliderCC = $objSliderCounter->dbFetchArray(1)){
						$SliderCounter++;
					?>
					<a href="#"><?php echo $SliderCounter;?></a>
                    <?php } ?>
					</span>
				</nav>
				
				<div id="hompage-slider_content">
					<?php
					$objSlider = new Slider;
					$objSlider->setProperty("is_active", "1");					
					$objSlider->lstSlider();
					while($HomeSlider = $objSlider->dbFetchArray(1)){
					if($HomeSlider["slider_title"]!=''){
						$SliderTitle = '<p class="clearfix"><a href="http://'.$HomeSlider["slider_link"].'" target="_blank" class="headline">'.$HomeSlider["slider_title"].'</a></p>';
					} else {
						$SliderTitle = $HomeSlider["slider_title"];
					}
					if($HomeSlider["slider_detail"]!=''){
						$SliderDetail = '<p class="clearfix"><a href="http://'.$HomeSlider["slider_link"].'" target="_blank" class="intro">'.$HomeSlider["slider_detail"].'</a></p>';
					} else {
						$SliderDetail = '';
					}
					?>
					<!-- BEGIN .item -->
					<div class="item" style="background-image: url(<?php echo SLIDER_URL.$HomeSlider["slider_image"];?>);">
						<div class="title-wrapper clearfix">
							<div class="title">
								<?php echo $SliderTitle;?>
                                <?php echo $SliderDetail;?>
							</div>
						</div>
						<img src="images/blank.png" alt="" />
					<!-- END .item -->
					</div>
                    <?php } ?>
					
				</div>
				
			<!-- END .main-slider -->
			</section>