<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
  <div class="card">
    <div class="card-header card-header-text" data-background-color="rose">
      <h4 class="card-title">Transaction Mode</h4>
    </div>
    <div class="card-content">
      <div class="col-md-12 Bord-Rt no-border-right">
        <?php if($LoginUserInfo["user_type_id"] == 1 or $LoginUserInfo["user_type_id"] == 3) {?>
        <div class="row" style="margin: 0">
          <div class="col-lg-3 Border-Rt">
            <div class="card transactio"> <a href="#" data-toggle="modal" data-target="#Receivablespaymentpopup">
              <div class="card-content text-center payment-mothed"> <i class="material-icons">attach_money</i>
                <h4>Receivables</h4>
                <code>Receive Payment of Customers</code> </div>
              </a> </div>
          </div>
          
          <div class="modal fade transaction" id="Receivablespaymentpopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog transaction">
                                    <div class="modal-content transaction">
                                        <div class="modal-header transaction">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                <i class="material-icons">clear</i>
                                            </button>
											<div class="pop-heading">
                                            	<h4 class="modal-title">Receivables Payment Mode</h4>
											</div>
                                        </div>
                                        <div class="modal-body transaction">
                                        
                                        <br />
                                        
                                        
               <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <tbody>
                  <tr>
                    <td align="center"><a href="<?php echo Route::_('show=transrecpay&apm='.EncData('1', 2, $objBF));?>">Payment Received</a></td>
                  </tr>
                   <tr>
                    <td align="center"><a href="<?php echo Route::_('show=transrecpay&apm='.EncData('17', 2, $objBF));?>">Contra Transaction</a></td>
                  </tr> 
                  <tr>
                    <td align="center"><a href="<?php echo Route::_('show=transrecpay&apm='.EncData('19', 2, $objBF));?>">Drawing Accounts</a></td>
                  </tr>
                  <tr>
                    <td align="center"><a href="<?php echo Route::_('show=transrecpay&apm='.EncData('26', 2, $objBF));?>">Profit Transfer</a></td>
                  </tr>
                  <tr>
                    <td align="center"><a href="<?php echo Route::_('show=transrecpay&apm='.EncData('27', 2, $objBF));?>">Customer to Drawing</a></td>
                  </tr>
                </tbody>
              </table>
              
            
                                            <div class="modal-footer"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
          
          
          <div class="col-lg-3 Border-Rt">
            <div class="card transactio"> <a href="#" data-toggle="modal" data-target="#receivedpaymentpopup">
              <div class="card-content text-center payment-mothed"> <i class="material-icons">money_off</i>
                <h4>Payables</h4>
                <code>Pay to Supplier, Unloader, Customer, etc</code> </div>
              </a> </div>
          </div>
          
          
          <div class="modal fade transaction" id="receivedpaymentpopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog transaction">
                                    <div class="modal-content transaction">
                                        <div class="modal-header transaction">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                <i class="material-icons">clear</i>
                                            </button>
											<div class="pop-heading">
                                            	<h4 class="modal-title">Payables Payment Mode</h4>
											</div>
                                        </div>
                                        <div class="modal-body transaction">
                                        
                                        <br />
                                        
                                        
               <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <tbody>
                  <tr>
                    <td align="center"><a href="<?php echo Route::_('show=transrecpay&apm='.EncData('2', 2, $objBF));?>">Supplier</a></td>
                  </tr>
                   <tr>
                    <td align="center"><a href="<?php echo Route::_('show=transrecpay&apm='.EncData('9', 2, $objBF));?>">Unloader</a></td>
                  </tr>
                  
                   <tr>
                    <td align="center"><a href="<?php echo Route::_('show=transrecpay&apm='.EncData('14', 2, $objBF));?>">Diesel Supplier</a></td>
                  </tr>
                   <tr>
                    <td align="center"><a href="<?php echo Route::_('show=transrecpay&apm='.EncData('15', 2, $objBF));?>">Mobil Oil Supplier</a></td>
                  </tr>
                   <tr>
                    <td align="center"><a href="<?php echo Route::_('show=transrecpay&apm='.EncData('16', 2, $objBF));?>">Tyre Supplier</a></td>
                  </tr>
                  
                  
                   <tr>
                    <td align="center"><a href="<?php echo Route::_('show=transrecpay&apm='.EncData('10', 2, $objBF));?>">Customer Cashback</a></td>
                  </tr>
                  
                   <tr>
                    <td align="center"><a href="<?php echo Route::_('show=transrecpay&apm='.EncData('18', 2, $objBF));?>">Drawing Accounts</a></td>
                  </tr>

                  <tr>
                    <td align="center"><a href="<?php echo Route::_('show=transrecpay&apm='.EncData('25', 2, $objBF));?>">Drawing to Supplier</a></td>
                  </tr>
                  
                </tbody>
              </table>
              
            
                                            <div class="modal-footer"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
          
          
          <div class="col-lg-3  Border-Rt">
            <div class="card transactio"> <a href="#" data-toggle="modal" data-target="#expensepaymentmode">
              <?php /* <a href="<?php echo Route::_('show=transrecpay&apm='.EncData('3', 2, $objBF));?>" data-toggle="modal" data-target="#expensespopup"> */ ?>
              <div class="card-content text-center payment-mothed"> <i class="material-icons">money_off</i>
                <h4>Expenses</h4>
                <code>Rent,Utilities,<br>
                Miscellaneous,etc</code> </div>
              </a> </div>
          </div>
          
          
          
          <div class="modal fade transaction" id="expensepaymentmode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog transaction">
                                    <div class="modal-content transaction">
                                        <div class="modal-header transaction">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                <i class="material-icons">clear</i>
                                            </button>
											<div class="pop-heading">
                                            	<h4 class="modal-title">Expense Payment Mode</h4>
											</div>
                                        </div>
                                        <div class="modal-body transaction">
                                        
                                        <br />
                                        
                                        
               <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <tbody>
                  <tr>
                    <td align="center"><a href="<?php echo Route::_('show=transrecpay&apm='.EncData('3', 2, $objBF));?>">General Expenses</a></td>
                  </tr>
                   <tr>
                    <td align="center"><a href="<?php echo Route::_('show=transrecpay&apm='.EncData('13', 2, $objBF));?>">Vehicle Expenses</a></td>
                  </tr>
                </tbody>
              </table>
              
            
                                            <div class="modal-footer"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          <div class="col-lg-3 Border-Rt">
            <div class="card transactio"> <a href="#<?php //echo Route::_('show=transrecpay');?>" data-toggle="modal" data-target="#employeesalarypopup">
              <div class="card-content text-center  payment-mothed"> <i class="material-icons">people</i>
                <h4>Employee Payments</h4>
                <code>Advance, Salaries</code> </div>
              </a> </div>
          </div>
          <div class="modal fade transaction" id="employeesalarypopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog transaction">
              <div class="modal-content transaction">
                <div class="modal-header transaction">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> <i class="material-icons">clear</i> </button>
                  <div class="pop-heading">
                    <h4 class="modal-title">Employee Payment Mode</h4>
                  </div>
                </div>
                <div class="modal-body transaction"> <br />
                  <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <tbody>
                      <tr>
                        <td align="center"><a href="<?php echo Route::_('show=transrecpay&apm='.EncData('11', 2, $objBF));?>">Monthly Salaries</a></td>
                      </tr>
                      <tr>
                        <td align="center"><a href="<?php echo Route::_('show=transrecpay&apm='.EncData('12', 2, $objBF));?>">Advance Salary</a></td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="modal-footer"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row last-row" style="margin: 0">
            <hr />
            
            
            <div class="col-lg-3 Border-Rt Last">
            <div class="card transactio"> <a href="#" data-toggle="modal" data-target="#customeroffer">
              <div class="card-content text-center  payment-mothed"> <i class="material-icons">transform</i>
                <h4>Customer & Supplier</h4>
                <code>Discount, Other Chagrs</code> </div>
              </a> </div>
          </div>
          
          
          <div class="modal fade transaction" id="customeroffer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog transaction">
                                    <div class="modal-content transaction">
                                        <div class="modal-header transaction">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                <i class="material-icons">clear</i>
                                            </button>
											<div class="pop-heading">
                                            	<h4 class="modal-title">Customer & Supplier Offer Types</h4>
											</div>
                                        </div>
                                        <div class="modal-body transaction">
                                        
                                        <br />
                                        
                                        
               <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <tbody>
                 <tr>
                    <th align="center" style="text-align:center !important;">Customer Section</ts>
                  </tr>
                  <tr>
                    <td align="center"><a href="<?php echo Route::_('show=transrecpay&apm='.EncData('21', 2, $objBF));?>">Customer Discount</a></td>
                  </tr>
                   <tr>
                    <td align="center"><a href="<?php echo Route::_('show=transrecpay&apm='.EncData('22', 2, $objBF));?>">Customer Other Charges</a></td>
                  </tr>
                   <tr>
                    <th align="center" style="text-align:center !important;">Supplier Section</ts>
                  </tr>
                  <tr>
                    <td align="center"><a href="<?php echo Route::_('show=transrecpay&apm='.EncData('23', 2, $objBF));?>">Supplier Discount</a></td>
                  </tr>
                   <!--<tr>
                    <td align="center"><a href="<?php //echo Route::_('show=transrecpay&apm='.EncData('24', 2, $objBF));?>">Supplier Other Charges</a></td>
                  </tr>-->
                </tbody>
              </table>
              
            
                                            <div class="modal-footer"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
            <div class="col-lg-3 Border-Rt Last">
              <div class="card transactio"> <a href="<?php echo Route::_('show=transrecpay&apm='.EncData('6', 2, $objBF));?>">
                <div class="card-content text-center payment-mothed"> <i class="material-icons">transform</i>
                  <h4>Transfer Amount</h4>
                  <code>Bank To Bank</code> </div>
                </a> </div>
            </div>
            <div class="col-lg-3 Border-Rt Last">
              <div class="card transactio"> <a href="<?php echo Route::_('show=transrecpay&apm='.EncData('8', 2, $objBF));?>">
                <div class="card-content text-center payment-mothed"> <i class="material-icons">transform</i>
                  <h4>Transfer Amount</h4>
                  <code>Bank To Cash</code> </div>
                </a> </div>
            </div>
            <div class="col-lg-3 Border-Rt Last">
              <div class="card transactio"> <a href="<?php echo Route::_('show=transrecpay&apm='.EncData('7', 2, $objBF));?>">
                <div class="card-content text-center payment-mothed"> <i class="material-icons">transform</i>
                  <h4>Transfer Amount</h4>
                  <code>Cash To Bank</code> </div>
                </a> </div>
            </div>
          </div>
          <?php }  ?>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
