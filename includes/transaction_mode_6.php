<input type="hidden" name="trans_type" id="trans_type" value="6">
            <input type="hidden" name="aplic_mode" value="6">
            <input type="hidden" name="headitem_id" id="headitem_id" value="">
            <div class="row">
              <label class="col-sm-2 label-on-left">Select Head:</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="head_id" id="general_head_id" title="List of Main Head's" required tabindex="1">
                    <?php
					$objQayadaccount->resetProperty();
					$objQayadaccount->setProperty("isActive", 1);
					$objQayadaccount->setProperty("head_type_id", 3);
                    $objQayadaccount->setProperty("ORDERBY", 'head_title');
                    $objQayadaccount->lstHead();
                    while($AccountHeadList = $objQayadaccount->dbFetchArray(1)){
                    ?>
                    <option value="<?php echo EncData($AccountHeadList["head_id"], 1, $objBF);?>"> <?php echo $AccountHeadList["head_code"] . ' - ' . $AccountHeadList["head_title"] . ' ';?> </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div id="Generalhaeditemdiv" style="display:none;"></div>
            <div id="Third_section_" style="display:none;">
              <hr>
              <div class="row">
                <label class="col-sm-2 label-on-left">Amount:</label>
                <div class="col-sm-9">
                  <div class="form-group label-floating<?php echo is_form_error($vResult,'trans_amount');?>">
                    <label class="control-label"></label>
                    <input class="form-control" type="text" name="trans_amount" onkeyup="word.innerHTML=convertNumberToWords(this.value)" id="trans_amount" required value="<?php echo $trans_amount;?>" tabindex="2" /><label><small id="word"></small></label>
                  </div>
                </div>
              </div>
              
              
              
          
              
              
              
              
              <div class="row">
                <label class="col-sm-2 label-on-left">Payment Mode:</label>
                <div class="col-sm-9">
                  <div class="form-group label-floating<?php echo is_form_error($vResult,'pay_mode');?>">
                    <select class="selectpicker" data-style="select-with-transition" name="pay_mode" id="pay_mode" title="List of Payment Mode" required tabindex="2">
                      <option value="2">Cheque</option>
                      <option value="3">Pay Order</option>
                      <option value="4">Bank Transfer</option>
                      <option value="5">Demand Draft</option>
                      <option value="6">Online</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row" id="mode_no" style="display:none;">
                <label class="col-sm-2 label-on-left">Mode No:</label>
                <div class="col-sm-9">
                  <div class="form-group label-floating<?php echo is_form_error($vResult,'pay_mode');?>">
                    <label class="control-label"></label>
                    <input class="form-control" type="text" name="payment_mode_no" id="pay_mode_field" value="<?php echo $pay_mode;?>" tabindex="2" />
                    <code>Note: Mode No for 'Cheque, Pay Order, Bank Transfer, etc' transaction number.</code> </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 label-on-left"><?php echo $HeadTransfer;?>:</label>
                <div class="col-sm-9">
                  <div class="form-group label-floating<?php echo is_form_error($vResult,'pay_mode');?>">
                    <select class="selectpicker" data-style="select-with-transition" name="transfer_head_id" id="transfer_head_id" title="List of Transfer Head's" required tabindex="2">
                      <?php
					$objQayadaccount->resetProperty();
					$objQayadaccount->setProperty("isActive", 1);
					$objQayadaccount->setProperty("head_type_id", 3);
                    $objQayadaccount->setProperty("ORDERBY", 'head_title');
                    $objQayadaccount->lstHead();
                    while($AccountHeadList = $objQayadaccount->dbFetchArray(1)){
                    ?>
                      <option value="<?php echo EncData($AccountHeadList["head_id"], 1, $objBF);?>"> <?php echo $AccountHeadList["head_code"] . ' - ' . $AccountHeadList["head_title"] . ' ';?> </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div id="haeditemdiv" style="display:none;"></div>
              <div class="row">
                <label class="col-sm-2 label-on-left">Transaction Date:</label>
                <div class="col-sm-9">
                  <div class="form-group label-floating<?php echo is_form_error($vResult,'trans_date');?>">
                    <label class="control-label"></label>
                    <input class="form-control datepicker" type="text" name="trans_date" required value="<?php echo $trans_date;?>" tabindex="1" />
                    <small><?php echo $vResult["trans_date"];?></small> </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 label-on-left">Title:</label>
                <div class="col-sm-9">
                  <div class="form-group label-floating<?php echo is_form_error($vResult,'trans_title');?>">
                    <label class="control-label"></label>
                    <input class="form-control" type="text" name="trans_title" required value="<?php echo $trans_title;?>" tabindex="2" />
                    <small><?php echo $vResult["trans_title"];?></small> </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 label-on-left">Note / Description:</label>
                <div class="col-sm-9">
                  <div class="form-group label-floating<?php echo is_form_error($vResult,'trans_note');?>">
                    <label class="control-label"></label>
                    <input class="form-control" type="text" name="trans_note" value="<?php echo $trans_note;?>" tabindex="2" />
                    <small><?php echo $vResult["trans_note"];?></small> </div>
                </div>
              </div>
              <div class="card-footer text-center col-md-12">
                <button type="submit" class="btn btn-rose btn-fill" id="SubmitBtn">Submit</button>
                <button type="reset" class="btn btn-fill">Reset</button>
              </div>
            </div>