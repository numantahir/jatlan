<style>.shortcode_content{ cursor:pointer;}</style>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="sms_template_id" value="<?php echo EncData($sms_template_id, 1, $objBF);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('SMS Template', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=smstemplate');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            <div class="row">
              <label class="col-sm-2 label-on-left">SMS Template Title</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'sms_title');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="sms_title" required value="<?php echo $sms_title;?>" tabindex="1" />
                  <small><?php echo $vResult["sms_title"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">SMS Template Content</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'sms_content');?>">
                  <label class="control-label"></label>
                  <textarea class="form-control" name="sms_content" id="sms_content" required tabindex="2" rows="5"><?php echo $sms_content;?></textarea>
                  <small><?php echo $vResult["sms_content"];?></small>
                  <label><small>Short Code List: <code class="shortcode_content" id="{customer_name}">{customer_name}</code> <code class="shortcode_content" id="{application_no}">{application_no}</code> <code class="shortcode_content" id="{property_no}">{property_no}</code> <code class="shortcode_content" id="{floor_no}">{floor_no}</code> <code class="shortcode_content" id="{section_no}">{section_no}</code> <code class="shortcode_content" id="{project_name}">{project_name}</code> <code class="shortcode_content" id="{registration_date}">{registration_date}</code> <code class="shortcode_content" id="{project_plan_status}">{project_plan_status}</code> <code class="shortcode_content" id="{received_payment}">{received_payment}</code> <code class="shortcode_content" id="{received_payment_type}">{received_payment_type}</code> <code class="shortcode_content" id="{received_payment_mode}">{received_payment_mode}</code> <code class="shortcode_content" id="{upcoming_installment_date}">{upcoming_installment_date}</code> <code class="shortcode_content" id="{upcoming_installment_amount}">{upcoming_installment_amount}</code> <code class="shortcode_content" id="{total_amount_paid}">{total_amount_paid}</code> <code class="shortcode_content" id="{remaining_amount}">{remaining_amount}</code> <code class="shortcode_content" id="{no_of_joint}">{no_of_joint}</code> <code class="shortcode_content" id="{seller_agent_name}">{seller_agent_name}</code>
                  </small>&nbsp; <a href="#" data-toggle="modal" data-target="#shortcode_help"><i class="material-icons" style="font-size:20px;">help</i></a></label>
                  </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">SMS Template Type/Section</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="sms_type_id" title="Select SMS Template Type/Section" tabindex="3">
                    <option value="1" <?php echo StaticDDSelection(1, $sms_type_id);?> selected>Welcome SMS</option>
                    <option value="2" <?php echo StaticDDSelection(2, $sms_type_id);?>>First Payment SMS</option>
                    <option value="3" <?php echo StaticDDSelection(3, $sms_type_id);?>>Upcoming Installment SMS</option>
                    <option value="4" <?php echo StaticDDSelection(4, $sms_type_id);?>>Late Installment SMS</option>
                    <option value="5" <?php echo StaticDDSelection(5, $sms_type_id);?>>On Payment SMS</option>
                    <option value="6" <?php echo StaticDDSelection(6, $sms_type_id);?>>Token Amount SMS</option>
                    <option value="7" <?php echo StaticDDSelection(7, $sms_type_id);?>>Marketing SMS</option>
                    <option value="8" <?php echo StaticDDSelection(8, $sms_type_id);?>>General Notification SMS</option>
                    <option value="9" <?php echo StaticDDSelection(9, $sms_type_id);?>>Assign Leads Notification SMS</option>
                  </select>
                </div>
              </div>
            </div>
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Template Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Template Status" tabindex="4">
                    <option value="1" <?php echo StaticDDSelection(1, $isActive);?> selected>Active</option>
                    <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>InActive</option>
                  </select>
                </div>
              </div>
            </div>
            
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
          </form>
          <div class="modal fade" id="shortcode_help" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notice">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
        <h5 class="modal-title" id="myModalLabel"><i class="material-icons">lock</i> Short Code Detail</h5>
      </div>
      <div class="modal-body">
        <div class="instruction">
          <div class="row">
            <div class="col-md-12">
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                	<tr>
                    	<th>Short Code</th>
                        <th>Short Code Detail</th>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{customer_name}</td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>{application_no}</td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>{property_no}</td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>{floor_no}</td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>{section_no}</td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>{registration_date}</td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>{project_plan_status}</td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>{received_payment}</td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>{received_payment_type}</td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>{received_payment_mode}</td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>{upcoming_installment_date}</td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>{upcoming_installment_amount}</td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>{total_amount_paid}</td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>{remaining_amount}</td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>{no_of_joint}</td>
                    <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>{seller_agent_name}</td>
                    <td align="left">&nbsp;</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
          
          
          
          
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
