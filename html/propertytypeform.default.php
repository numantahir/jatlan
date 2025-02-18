<style>.card img{ width:150px !important;}</style>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="property_type_id" value="<?php echo $objBF->encrypt($property_type_id, ENCRYPTION_KEY);?>">
            <input type="hidden" name="project_id" value="<?php echo $CurrentPorjectId;?>" />
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Property Type', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=propertytype');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">  
           
           <div id="floorinnersection"> 
                      
            <div class="row">
              <label class="col-sm-2 label-on-left">Floor & Type</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="propety_floor_id" id="propety_floor_id" title="Select Floor with type" required tabindex="2">
                    <?php
					
					$ReturnFloorOptionList = '';
					$objQayadProerty->setProperty("project_id", $CurrentPorjectId);
					$objQayadProerty->setProperty("ORDERBY", 'floor_name');
					$objQayadProerty->lstPropertyFloorPlan();
					while($FloorPlanList = $objQayadProerty->dbFetchArray(1)){
					if($propety_floor_id == $FloorPlanList["propety_floor_id"]){
					echo '<option value="'.$FloorPlanList["propety_floor_id"].'" selected="selected"> '.RegisterProject($FloorPlanList["project_type_id"]).' -> '.$FloorPlanList["floor_name"].'</option>';
					} else {
					echo '<option value="'.$FloorPlanList["propety_floor_id"].'"> '.RegisterProject($FloorPlanList["project_type_id"]).' -> '.$FloorPlanList["floor_name"].'</option>';	
					}
					}
					?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Property Title</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'property_section');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="property_section" required value="<?php echo $property_section;?>" tabindex="3" />
                  <small>(Office, Shop,Standard Room,Deluxe Room,Executive Room,Executive Suites,Presidential Suite,Food Court,Kiosk,Theme Park)</small> <small><?php echo $vResult["property_section"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Property Area</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'property_area');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="property_area" required value="<?php echo $property_area;?>" tabindex="4" />
                  <small>Note: Please type only area without SQ,FT (Type only number...)</small>
                  <small><?php echo $vResult["property_area"];?></small> </div>
              </div>
            </div>
            <div class="row" style="display:none;">
              <label class="col-sm-2 label-on-left">Property Rate Sq/Ft</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'property_rent_sqft');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="property_rent_sqft" required value="<?php echo $property_rent_sqft;?>" tabindex="5" />
                  <small><?php echo $vResult["property_rent_sqft"];?></small> </div>
              </div>
            </div>
            <div class="row">
            <label class="col-sm-2 label-on-left">Property Image</label>
            <div class="col-sm-9">
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div class="fileinput-new thumbnail">
                    <?php if($property_image !=''){?>
                    <img src="<?php echo COMPANY_PROP_THUMB_URL.$property_image;?>">
                    <?php }else{ ?>
                    <img src="<?php echo SITE_URL;?>assets/img/image_placeholder.jpg">
                    <?php } ?>
                        
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                    <div>
                        <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Select image</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="property_image" />
                        </span>
                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                    </div>
                </div>
            </div>
           </div>
           
           
           
           <div class="row">
            <label class="col-sm-2 label-on-left">Property Banner</label>
            <div class="col-sm-9">
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div class="fileinput-new thumbnail">
                    <?php if($property_banner !=''){?>
                    <img src="<?php echo COMPANY_PROP_URL.$property_banner;?>">
                    <?php }else{ ?>
                    <img src="<?php echo SITE_URL;?>assets/img/image_placeholder.jpg">
                    <?php } ?>
                        
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                    <div>
                        <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Select image</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="property_banner" />
                        </span>
                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                    </div>
                </div>
            </div>
           </div>
           
           
           
           
           
           </div>
           
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill" tabindex="5">Submit</button>
              <button type="reset" class="btn btn-fill" tabindex="6">Reset</button>
            </div>
          </form>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
