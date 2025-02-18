<footer class="footer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <p class="copyright pull-left"> &copy; <?php echo _COPYRIGHTS;?> </p>
        <p class="copyright pull-right"> <?php echo _POWERED_BY;?> </p>
      </div>
    </div>
  </div>
</footer>
</div>
</div>



<?php /*if($objQayadProjectReg->reg_pro == ""){
	
	if($objQayaduser->user_type == 9){
		echo '';
	} elseif($objQayaduser->user_type == 10){
		echo '';
	} else {
	?>

<div class="modal fade" id="ProjectSelector" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-notice">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="myModalLabel"><i class="material-icons">lock</i> Select Project</h5>
                </div>
                <div class="modal-body">
                  <div class="instruction">
                    <div class="row">
                      <div class="col-md-12">
                        
                              <?php
					$objQayadProjectTopList = new Qayadproperty;
					$objQayadProjectTopList->setProperty("isActive", 1);
					$objQayadProjectTopList->setProperty("ORDERBY", 'project_name');
					$objQayadProjectTopList->lstProjects();
					while($TopMenuProjectList = $objQayadProjectTopList->dbFetchArray(1)){
					?>
                  <a class="dropdownmenulink" href="<?php 
				  if($_GET["show"] == ''){ $PassCurrentPageName = 'NUL'; } else { $PassCurrentPageName = $_GET["show"]; }
				  echo SITE_URL.'?reg='.EncData('project', 2, $objBF).'&pi='.EncData($TopMenuProjectList["project_id"], 2, $objBF).'&rt='.EncData($PassCurrentPageName, 2, $objBF);?>"><i class="material-icons">domain</i> <?php echo $TopMenuProjectList["project_name"];?></a>
                  <?php } ?>
                  
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
<?php }  } */ ?>
</body><!--   Core JS Files   -->
<script src="<?php echo SITE_URL;?>assets_js/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/material.min.js" type="text/javascript"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/jquery.validate.min.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/moment.min.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/chartist.min.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/jquery.bootstrap-wizard.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/bootstrap-notify.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/jquery.sharrre.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/bootstrap-datetimepicker.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/jquery-jvectormap.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/nouislider.min.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/jquery.select-bootstrap.js"></script>
<!--<script src="<?php echo SITE_URL;?>assets_js/js/jquery.datatables.js"></script>-->
<script src="<?php echo SITE_URL;?>assets_js/libs/datatables/jquery.dataTables.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/libs/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/libs/datatables/dataTables.responsive.min.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/libs/datatables/responsive.bootstrap4.min.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/libs/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/libs/datatables/buttons.bootstrap4.min.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/libs/datatables/buttons.html5.min.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/libs/datatables/buttons.flash.min.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/libs/datatables/buttons.print.min.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/libs/datatables/dataTables.keyTable.min.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/libs/datatables/dataTables.select.min.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/sweetalert2.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/jasny-bootstrap.min.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/fullcalendar.min.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/jquery.tagsinput.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/material-dashboard23cd.js?v=1.2.1"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>assets_js/js/webcam.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>assets_js/js/articulate.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/SSS.js"></script>
<?php include_once(INC_PATH . 'footerscript.php'); ?>
</html>