<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" id="PropertyList" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="property_id" value="<?php echo $objBF->encrypt($property_id, ENCRYPTION_KEY);?>">
            <input type="hidden" name="property_status" value="1" />
            <input type="hidden" name="project_id" value="<?php echo $CurrentPorjectId;?>" />
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Property', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=properties');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Project Type</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="property_registered_id" id="property_registered_id" title="Choose Project" required tabindex="1">
                    <option value="" disabled>Select Project Type</option>
                    <?php echo ProjectTypeOptionList($property_registered_id);?>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row row_property_floor">
              <label class="col-sm-2 label-on-left">Floor Selection</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
					<?php
                    $objQayadProerty->setProperty("ORDERBY", 'propety_floor_id');
					$objQayadProerty->setProperty("project_id", $CurrentPorjectId);
                    $objQayadProerty->lstPropertyFloorPlan();
                    while($FloorListTitle = $objQayadProerty->dbFetchArray(1)){
                    ?>
                  <div class="radio col-sm-3 propertyfloor floor-num-<?php echo $FloorListTitle["project_type_id"];?>">
                    <label>
                      <input type="radio" class="login_required psro GetPropertySection" name="floor_number"<?php echo StaticRadioChecked($FloorListTitle["propety_floor_id"],$propety_floor_id); ?> required value="<?php echo $FloorListTitle["propety_floor_id"];?>" id="<?php echo $FloorListTitle["propety_floor_id"] . '-' . $FloorListTitle["project_id"];?>">
                      <?php echo $FloorListTitle["floor_name"];?> </label>
                  </div>
                  <?php } ?>
                </div>
              </div>
            </div>
            
            <div class="row row_property_section">
              <label class="col-sm-2 label-on-left">Property Section</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
					<?php
					$objQayadProerty->resetProperty();
                    $objQayadProerty->setProperty("ORDERBY", 'property_type_id');
					$objQayadProerty->setProperty("project_id", $CurrentPorjectId);
                    $objQayadProerty->lstPropertyType();
                    while($SectionListTitle = $objQayadProerty->dbFetchArray(1)){
                    ?>
                  <div class="radio col-sm-3 propertysection sectionradio-<?php echo $SectionListTitle["propety_floor_id"].'-'.$SectionListTitle["project_id"];?>">
                    <label>
                      <input type="radio" class="login_required psro" name="property_type_id"<?php echo StaticRadioChecked($SectionListTitle["property_type_id"],$property_type_id); ?> required value="<?php echo $SectionListTitle["property_type_id"];?>" onclick="PropertyAreaPass('<?php echo $SectionListTitle["property_area"];?>');">
                      <?php echo $SectionListTitle["property_section"].' <small>'.$SectionListTitle["property_area"].'/sq/ft</small>';?> </label>
                  </div>
                  <?php } ?>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Property Number</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'property_number');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="property_number" required value="<?php echo $property_number;?>" tabindex="4" />
                  <small><?php echo $vResult["property_number"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Property/Share Locked Duration</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'book_duration');?>">
                  <select class="selectpicker" data-style="select-with-transition" name="book_duration" title="Choose User Type" required tabindex="5">
                    <option value="1" <?php echo StaticDDSelection(1, $book_duration);?>>1 Day</option>
                    <option value="2" <?php echo StaticDDSelection(2, $book_duration);?>>2 Days</option>
                    <option value="3" <?php echo StaticDDSelection(3, $book_duration);?>>3 Days</option>
                    <option value="4" <?php echo StaticDDSelection(4, $book_duration);?>>4 Days</option>
                    <option value="5" <?php echo StaticDDSelection(5, $book_duration);?>>5 Days</option>
                    <option value="6" <?php echo StaticDDSelection(6, $book_duration);?>>6 Days</option>
                    <option value="7" <?php echo StaticDDSelection(7, $book_duration);?>>7 Days</option>
                  </select>
                  <small><?php echo $vResult["book_duration"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Property Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Property Status" tabindex="6">
                    <option value="1" <?php echo StaticDDSelection(1, $isActive);?> selected>Active</option>
                    <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>InActive</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Property Description</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <textarea class="form-control" name="property_desc" id="editor" cols="60" rows="15" tabindex="7" style="border:solid 1px #CCCCCC;" /><?php echo htmlentities(stripslashes($property_desc));?></textarea>
                </div>
              </div>
            </div>
            <div class="row">
            <label class="col-sm-2 label-on-left">Property Image</label>
            <div class="col-sm-9">
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div class="fileinput-new thumbnail">
                    <?php if($property_img_cord !=''){?>
                    <img src="<?php echo COMPANY_PROP_THUMB_URL.$property_img_cord;?>">
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
           
           
           
           
            <?php if($mode == 'I'){?>
            <hr />
            <input type="hidden" id="PropertyAreaVal" />
            <div class="row">
              <label class="col-sm-2 label-on-left">No. of 20-Sq/Ft Units</label>
              <div class="col-sm-5">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'share_20');?>">
                  <label class="control-label"></label>
                  <input class="form-control" min="0" type="number" name="share_20" id="share_20" required value="<?php echo $share_20;?>" tabindex="8" />
                  <input type="hidden" value="0" id="tnoofshares_20" />
                  <small><?php echo $vResult["share_20"];?></small> </div>
              </div>
              
              <div class="col-sm-4">
              <label class="label-on-left"><strong id="20_no_shares">0</strong> <small> Sq/Ft </small></label>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">No. of 10-Sq/Ft Units</label>
              <div class="col-sm-5">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'share_10');?>">
                  <label class="control-label"></label>
                  <input class="form-control" min="0" type="number" name="share_10" id="share_10" required value="<?php echo $share_10;?>" tabindex="9" />
                  <input type="hidden" value="0" id="tnoofshares_10" />
                  <small><?php echo $vResult["share_10"];?></small> </div>
              </div>
              <div class="col-sm-4">
              <label class="label-on-left"><strong id="10_no_shares">0</strong> <small> Sq/Ft </small></label>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">No. of 5-Sq/Ft Units</label>
              <div class="col-sm-5">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'share_5');?>">
                  <label class="control-label"></label>
                  <input class="form-control" min="0" type="number" name="share_5" id="share_5" required value="<?php echo $share_5;?>" tabindex="10" />
                  <input type="hidden" value="0" id="tnoofshares_5" />
                  <small><?php echo $vResult["share_5"];?></small> </div>
              </div>
              <div class="col-sm-4">
              <label class="label-on-left"><strong id="5_no_shares">0</strong> <small> Sq/Ft </small></label>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Total No. of Area Size</label>
              <div class="col-sm-5">
                <div class="form-group label-floating">
                	<input type="hidden" value="" id="TNoAreaSize" />
                  <label class="label-on-left" style="padding-top:17px;"><strong id="tno_AreaSize">0</strong> <small> Sq/Ft </small></label>
                  </div>
              </div>
            </div>
            
			<?php } ?>
            
            
            
            <div class="card-footer text-center col-md-12">
             <button type="submit" disabled style="display: none" aria-hidden="true"></button>
              <button type="submit" id="finalSubmitBtn" class="btn btn-rose btn-fill" tabindex="11">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
          </form>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
