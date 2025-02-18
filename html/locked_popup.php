<?php list($FirstName,$SecondName,$ThirdName,$FourthName)=explode(' ', $GetLockedDuration["customer_fullname"]); ?>
<div class="modal fade" id="lpp-<?php echo $PropertyDetail["property_id"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notice">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
        <h5 class="modal-title" id="myModalLabel"><i class="material-icons">lock</i> Locked Person Detail</h5>
      </div>
      <div class="modal-body">
        <div class="instruction">
          <div class="row">
            <div class="col-md-12">
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <tbody>
                  <tr>
                    <th>Customer First Name</th>
                    <td align="left"><?php echo $FirstName;?></td>
                  </tr>
                  <tr>
                    <th>Customer Last Name</th>
                    <td align="left"><?php echo $SecondName.' '.$ThirdName.' '.$FourthName;?></td>
                  </tr>
                  <tr>
                    <th>Customer Mobile#</th>
                    <td align="left"><?php echo $GetLockedDuration["customer_mobile"];?></td>
                  </tr>
                  <tr>
                    <th>Customer CNIC</th>
                    <td align="left"><?php echo $GetLockedDuration["customer_cnic"];?></td>
                  </tr>
                  <tr>
                    <th>Last lock Date</th>
                    <td align="left"><?php echo dateFormate_4($GetLockedDuration["till_lock_duration"]);?></td>
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
