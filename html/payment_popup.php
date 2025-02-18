<div class="modal fade" id="ppm-<?php echo $PropertyDetail["property_id"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notice">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
        <h5 class="modal-title" id="myModalLabel"><i class="material-icons">payment</i> <?php echo $PropertyDetail["property_number"];?> Payment Plan Detail</h5>
      </div>
      <div class="modal-body">
        <div class="instruction">
          <div class="row">
            <div class="col-md-12">
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <tbody>
                  <tr>
                    <th>Down Payment</th>
                    <td><?php echo Numberformt($PropertyPaymentPlan["down_payment"]);?></td>
                  </tr>
                  <tr>
                    <th>18 Installments</th>
                    <td><?php echo Numberformt($PropertyPaymentPlan["instalment_per_month"]);?>/Month</td>
                  </tr>
                  <tr>
                    <th>24 Installments</th>
                    <td><?php echo Numberformt($PropertyPaymentPlan["instalment_per_month_24"]);?>/Month</td>
                  </tr>
                  <tr>
                    <th>36 Installments</th>
                    <td><?php echo Numberformt($PropertyPaymentPlan["instalment_per_month_36"]);?>/Month</td>
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