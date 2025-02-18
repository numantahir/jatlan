<?php
$objQayadapplication->resetProperty();
$objQayadapplication->setProperty("aplic_id", trim(DecData($_GET["i"], 1, $objBF)));
$objQayadapplication->lstApplication();
$ListofAplic = $objQayadapplication->dbFetchArray(1);
/**///////////////////////////////////////////////////////////////////////////////
/**/$objQayadProerty->resetProperty();
/**/$objQayadProerty->setProperty("property_id", $ListofAplic["property_id"]);
/**/$objQayadProerty->lstProperties();
/**/$PropertyDetail = $objQayadProerty->dbFetchArray(1);
/**///////////////////////////////////////////////////////////////////////////////
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Document List of (<?php echo $ListofAplic["reg_number"].'/'.$PropertyDetail["property_number"].' ['.RegisterProject($PropertyDetail["property_registered_id"]).']';?>)</h4>
            <div class="toolbar text-right"> </div>
            <hr>
            <div class="col-sm-6 col-lg-3">
              <div class="card">
                <div class="card-content text-center"> <i class="material-icons">folder</i>
                  <h3>Application Form</h3>
                  <a href="#" onClick="openRequestedPopup('<?php //echo SITE_URL.'doc.php?i='.EncData($ListofAplic["aplic_id"], 2, $objBF).'&t='.EncData('baf', 2, $objBF);?>');" target="new" title="View Locked Person Detail"> <i class="material-icons">print</i> Print Document</a> </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card">
                <div class="card-content text-center"> <i class="material-icons">folder</i>
                  <h3>Declaration Form</h3>
                  <a href="#" onClick="openRequestedPopup('<?php //echo SITE_URL.'doc.php?i='.EncData($ListofAplic["aplic_id"], 2, $objBF).'&t='.EncData('df', 2, $objBF);?>');" title="View Locked Person Detail"> <i class="material-icons">print</i> Print Document</a> </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card">
                <div class="card-content text-center"> <i class="material-icons">folder</i>
                  <h3>Payment Receipt</h3>
                  <a href="#" onClick="openRequestedPopup('<?php //echo SITE_URL.'doc.php?i='.EncData($ListofAplic["aplic_id"], 2, $objBF).'&t='.EncData('pr', 2, $objBF);?>');" title="View Locked Person Detail"> <i class="material-icons">print</i> Print Document</a> </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card">
                <div class="card-content text-center"> <i class="material-icons">folder</i>
                  <h3>Contract Document</h3>
                  <a href="#" onClick="openRequestedPopup('<?php //echo SITE_URL.'doc.php?i='.EncData($ListofAplic["aplic_id"], 2, $objBF).'&t='.EncData('cd', 2, $objBF);?>');" title="View Locked Person Detail"> <i class="material-icons">print</i> Print Document</a> </div>
              </div>
            </div>
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