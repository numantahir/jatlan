<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">notes</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Employee Report</h4>
            <div class="toolbar"> </div>
            <hr>
            <div class="material-datatables">
              <h5>Company Base</h5>
              <hr>
              <?php
                    $objQayaduser->resetProperty();
                    $objQayaduser->setProperty("isActive", 1);
                    $objQayaduser->setProperty("ORDERBY", "company_name");
                    $objQayaduser->lstCompanies();
                    while($CompanyList = $objQayaduser->dbFetchArray(1)){
                ?>
              <div class="col-xs-4">
                <div class="card"> <a href="<?php echo Route::_('show=repemplistgen&gen='.EncData("Company", 2, $objBF).'&i='.EncData($CompanyList["company_id"], 2, $objBF));?>">
                  <div class="card-content text-center"> <code><?php echo $CompanyList["company_name"];?></code> </div>
                  </a> </div>
              </div>
              <?php } ?>
              <hr>
              <h5>Department Base</h5>
              <hr>
              <?php
                    $objQayaduser->resetProperty();
                    $objQayaduser->setProperty("isActive", 1);
                    $objQayaduser->setProperty("ORDERBY", "company_name");
                    $objQayaduser->lstDepartments();
                    while($DepartmentList = $objQayaduser->dbFetchArray(1)){
                ?>
              <div class="col-xs-4">
                <div class="card"> <a href="<?php echo Route::_('show=repemplistgen&gen='.EncData("Department", 2, $objBF).'&i='.EncData($DepartmentList["department_id"], 2, $objBF));?>">
                  <div class="card-content text-center"> <code><?php echo $DepartmentList["department_name"].' ('.$DepartmentList["company_name"].')';?></code> </div>
                  </a> </div>
              </div>
              <?php } ?>
              <hr>
              <h5>All Employees</h5>
              <hr>
              <div class="col-xs-4">
                <div class="card"> <a href="<?php echo Route::_('show=repemplistgen&gen='.EncData("AllEmployee", 2, $objBF));?>">
                  <div class="card-content text-center"> <code>All Employees</code> </div>
                  </a> </div>
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
