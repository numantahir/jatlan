<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">work</i> </div>
          <div class="card-content">
            
            <?php if(trim(DecData($_GET["i"], 1, $objBF)) !=''){
				$objSSSPropertyDetail = new SSSinventory;
					$objSSSComplainCategory = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("ORDERBY", 'complain_id DESC');
					$objSSSinventory->setProperty("complain_id", trim(DecData($_GET["i"], 1, $objBF)));
					$objSSSinventory->lstComplain();
					$ListofComplain = $objSSSinventory->dbFetchArray(1);
						$objSSSComplainCategory->resetProperty();
						$objSSSPropertyDetail->resetProperty();
						$objSSSPropertyDetail->setProperty("isActive", 1);
						$objSSSPropertyDetail->setProperty("property_id", $ListofComplain["property_id"]);
						$objSSSPropertyDetail->lstPropertyBundle();
						$GetPropertyDetail = $objSSSPropertyDetail->dbFetchArray(1);
						//if($ListofComplain["complain_status"] == 3){
						$GetResolvedTime = GetLeadAssignTime($ListofComplain["complain_resolved_date"], $ListofComplain["complain_reg_date"]);	
						//} else {
						$GetAssignTime = GetLeadAssignTime(date('Y-m-d H:i:s'), $ListofComplain["complain_reg_date"]);
						//}
						
					
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("ORDERBY", 'complain_id DESC');
					$objSSSinventory->setProperty("complain_id", trim(DecData($_GET["i"], 1, $objBF)));
					$objSSSinventory->lstComplainAssign();
					$ComplainAssignTo = $objSSSinventory->dbFetchArray(1);
				?>
            <h3 class="card-title CardWidth"><?php echo $ListofComplain["complain_number"];?> Complain [<?php echo ComplainStatus($ListofComplain["complain_status"]);?>]</h3>
            <div class="toolbar add-btn text-right"><a href="<?php echo Route::_('show=complain');?>" class="btn">Back</a> </div>
            <hr>
            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  	<th>Number</th>
                    <th>Property</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Assign To</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $ListofComplain["complain_number"];?></td>
                    <td><?php echo $GetPropertyDetail["block_name"].' / '.$GetPropertyDetail["building_no"].' / '.$GetPropertyDetail["floor_name"].' / '.$GetPropertyDetail["property_number"].' / '.$GetPropertyDetail["property_code"];?></td>
                    <td><?php echo $objSSSComplainCategory->GetComplainCategoryTitle($ListofComplain["category_id"]);?></td>
                    <td><?php echo ComplainStatus($ListofComplain["complain_status"]);?></td>
                    <td><?php echo $objQayaduser->GetUserFullName($ComplainAssignTo["assign_to_id"]);?></td>
                  </tr>
                </tbody>
              </table>
              <hr />
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Reg Date</th>
                    <th>Assign</th>
                    <th>Resolved</th>
                    <th>Resolved Duration</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo dateFormate_9($ListofComplain["complain_reg_date"]);?></td>
                    <td><code><?php echo 'D:'.$GetAssignTime->d.' / H:'.$GetAssignTime->h .' / M:'.$GetAssignTime->i;?></code></td>
                    <td><?php echo dateFormate_9($ListofComplain["complain_resolved_date"]);?></td>
                    <td><code><?php 
					if($ListofComplain["complain_status"] == 3){
					echo 'D:'.$GetResolvedTime->d.' / H:'.$GetResolvedTime->h .' / M:'.$GetResolvedTime->i;
					}?></code></td>
                  </tr>
                </tbody>
              </table>
              <hr />
            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Complain Detail</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $ListofComplain["complain_text"];?></td>
                  </tr>
                </tbody>
              </table>
              <?php if($ListofComplain["complain_status"] != 3){?>
              <hr />
              <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="cci" value="<?php echo $ComplainAssignTo["complain_comment_id"];?>">
            <input type="hidden" name="ci" value="<?php echo $ComplainAssignTo["complain_id"];?>">
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Update Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="complain_status" title="Update Status" tabindex="1">
                    <option value="2">Pending</option>
                    <option value="3" selected>Resolved</option>
                    </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Comment</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'comment_text');?>">
                  <label class="control-label"></label>
                  <textarea class="form-control" rows="8" name="comment_text" required></textarea>
                  <small><?php echo $vResult["comment_text"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
            <label class="col-sm-2 label-on-left">Take Picture</label>
            <div class="col-sm-9">
            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker('');?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="complain_picture"  accept="image/*;capture=camera" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
            
            </div>
            
            </div>
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
            </div>
            </div>
          </form>
          <?php } ?>
              <hr />
              <section class="comment-list">
					<h3>Comments</h3>
					<article class="row">
						<?php
						$objSSSinventory->resetProperty();
						$objSSSinventory->setProperty("ORDERBY", 'comment_date DESC');
						$objSSSinventory->setProperty("complain_id", trim(DecData($_GET["i"], 1, $objBF)));
						$objSSSinventory->lstComplainComment();
						while($ComplainComments = $objSSSinventory->dbFetchArray(1)){
							$objQayaduser->resetProperty();
						?>
						<div class="col-md-1 col-sm-1 hidden-xs">
							<figure class="thumbnail">
								<img class="img-responsive" src="http://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png" />
								<!--<figcaption class="text-center">username</figcaption>-->
							</figure>
						</div>
						<div class="col-md-11 col-sm-11">
							<div class="panel panel-default arrow left">
								<div class="panel-body">
									<header class="text-left">
										<div class="comment-user"><i class="fa fa-user"></i> <?php echo $objQayaduser->GetUserFullName($ComplainComments["employee_id"]);?></div>
										<date class="comment-date" date="16-12-2014"><i class="fa fa-clock-o"></i> <?php echo dateFormate_9($ComplainComments["comment_date"]);?></date>
									</header>
									<div class="comment-post">
										<?php echo $ComplainComments["comment_text"];?>
                                        <?php if($ComplainComments["comment_picture"] != ''){
											
											echo '<br><img src="'.COMPLAIN_PICTURE_URL.$ComplainComments["comment_picture"].'" style="max-width:80%;height: auto;" />';
										}?> 
                                        
									</div>
								</div>
							</div>
						</div>
						<div class="row"></div>
						<?php } ?>
					</article>
				</section>
            <?php } else { ?>
            <h3 class="card-title CardWidth">List of Resolved Complains</h3>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  	<th>Number</th>
                    <th>Property</th>
                    <th>Category</th>
                    <th>Reg Date</th>
                    <th>Resolved</th>
                    <th>Duration</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSPropertyDetail = new SSSinventory;
					$objSSSComplainCategory = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("ORDERBY", 'complain_id DESC');
					$objSSSinventory->setProperty("isActive", 1);
					$objSSSinventory->setProperty("complain_status", 3);
					if($objCheckLogin->user_type == 5){
					$objSSSinventory->setProperty("user_id", trim(DecData($objQayaduser->user_id, 1, $objBF)));
					}
					$objSSSinventory->lstComplain();
					while($ListofComplain = $objSSSinventory->dbFetchArray(1)){
						$objSSSComplainCategory->resetProperty();
						$objSSSPropertyDetail->resetProperty();
						$objSSSPropertyDetail->setProperty("isActive", 1);
						$objSSSPropertyDetail->setProperty("property_id", $ListofComplain["property_id"]);
						$objSSSPropertyDetail->lstPropertyBundle();
						$GetPropertyDetail = $objSSSPropertyDetail->dbFetchArray(1);
						$GetAssignTime = GetLeadAssignTime($ListofComplain["complain_resolved_date"], $ListofComplain["complain_reg_date"]);	
						

				?>
                  <tr>
                    <td><a href="<?php echo Route::_('show=complain&i='.EncData($ListofComplain["complain_id"], 2, $objBF));?>"><?php echo $ListofComplain["complain_number"];?></a></td>
                    <td><small><?php echo $GetPropertyDetail["block_name"].' / '.$GetPropertyDetail["building_no"].' / '.$GetPropertyDetail["floor_name"].' / '.$GetPropertyDetail["property_number"].' / '.$GetPropertyDetail["property_code"];?></small></td>
                    <td><?php echo $objSSSComplainCategory->GetComplainCategoryTitle($ListofComplain["category_id"]);?></td>
                    <td><?php echo dateFormate_9($ListofComplain["complain_reg_date"]);?></td>
                    <td><?php echo dateFormate_9($ListofComplain["complain_resolved_date"]);?></td>
                    <td><code><?php echo 'D:'.$GetAssignTime->d.' / H:'.$GetAssignTime->h .' / M:'.$GetAssignTime->i;?></code></td>
                    <td><?php echo ComplainStatus($ListofComplain["complain_status"]);?></td>
                    
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <?php } ?>
          </div>
          <!-- end content--> 
        </div>
        <!--  end card  --> 
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>