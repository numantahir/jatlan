<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <?php if($_GET["vm"]!='on' && $_GET["dfi"]==''){?>
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="mode" value="UP">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Leads', $mode);?></h4>
            </div>
           <!-- <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=leadform');?>" class="btn">Back</a> </div>-->
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Leads Resource</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="lead_from_id" title="Select Leads from" tabindex="1">
                    <option value="1" <?php echo StaticDDSelection(1, $isActive);?>>Zameen</option>
                    <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>OLX</option>
                    <option value="3" <?php echo StaticDDSelection(3, $isActive);?>>OWN Social Media</option>
                    <option value="4" <?php echo StaticDDSelection(4, $isActive);?>>Other</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
            <label class="col-sm-2 label-on-left">Select EXCEL File</label>
                <div class="col-md-2 text-center">
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                            <span class="btn btn-rose btn-round btn-file upload">
                                <span class="fileinput-new">Select File</span>
                                <span class="fileinput-exists">Change</span>
                                <input type="file" name="document_file" />
                            </span>
                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
          </form>
          <?php } else { ?>
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="mode" value="IL">
          <input type="hidden" name="dfi" value="<?php echo trim($objBF->decrypt($_GET["dfi"], 1, ENCRYPTION_KEY));?>">
          <input type="hidden" name="lfi" value="<?php echo trim($objBF->decrypt($_GET["lfi"], 1, ENCRYPTION_KEY));?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Leads', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=leadform');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            <table id="datatables1" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Client Name</th>
                    <th>Phone Number</th>
                    <th>Client Email</th>
                    <th>Date</th>
                    <th>Message</th>
                  </tr>
                </thead>
                <tbody>
					<?php
					$GetUploadedFileName =  trim($objBF->decrypt($_GET["dfi"], 1, ENCRYPTION_KEY));
					if ( $xlsx = SimpleXLSX::parse(COMPANY_LEAD_PATH.$GetUploadedFileName) ) {
							$ReadExcelFile = $xlsx->rows();
							for($e=1;$e<=count($ReadExcelFile);$e++){
								if($ReadExcelFile[$e][3] !=''){
									$objQayaduser->resetProperty();
									$objQayaduser->setProperty("client_phone_number", $ReadExcelFile[$e][3]);
									$objQayaduser->CheckLeadPhone();
									$CheckPhoneNumber = $objQayaduser->totalRecords();
									if($CheckPhoneNumber == 0){
					?>
                    		<tr>
                                <td><?php echo $ReadExcelFile[$e][2];?></td>
                                <td><?php echo $ReadExcelFile[$e][3];?></td>
                                <td><?php echo $ReadExcelFile[$e][4];?></td>
                                <td><?php echo dateFormate_4($ReadExcelFile[$e][1]);?></td>
                                <td><?php echo $ReadExcelFile[$e][5];?></td>
                              </tr>
                              <?php } else { ?>
                              <tr style="background-color:#FFC4C5">
                                <td><?php echo $ReadExcelFile[$e][2];?></td>
                                <td><?php echo $ReadExcelFile[$e][3];?></td>
                                <td><?php echo $ReadExcelFile[$e][4];?></td>
                                <td><?php echo dateFormate_4($ReadExcelFile[$e][1]);?></td>
                                <td><?php echo $ReadExcelFile[$e][5];?></td>
                              </tr>
                              <?php } ?>
                    <?php
								}
							}
					} else {
						echo '<tr><td colspan="5">';
						echo SimpleXLSX::parseError();
						echo '</td></tr>';
					}
                    ?>
                  
                </tbody>
              </table>
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
          </form>
          <?php } ?>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
