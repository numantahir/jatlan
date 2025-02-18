<?php 
if(trim(DecData($_GET["gen"], 1,$objBF)) == "Company" && trim(DecData($_GET["i"], 1,$objBF)) != ""){	
$objQayaduser->setProperty("isActive", 1);
$objQayaduser->setProperty("company_id", trim(DecData($_GET["i"], 1,$objBF)));
$objQayaduser->setProperty("ORDERBY", 'user_fname');
$CreatePrintURL = 'gen='.EncData("Company", 2, $objBF).'&i='.EncData(trim(DecData($_GET["i"], 1,$objBF)), 2, $objBF);

$objGetCompanyName = new Qayaduser;
$objGetCompanyName->setProperty("company_id", trim(DecData($_GET["i"], 1,$objBF)));
$objGetCompanyName->lstCompanies();
$CompanyNamebase = $objGetCompanyName->dbFetchArray(1);
$Heading = '['.$CompanyNamebase["company_name"].'] Company';

} elseif(trim(DecData($_GET["gen"], 1,$objBF)) == "Department" && trim(DecData($_GET["i"], 1,$objBF)) != ""){
$objQayaduser->setProperty("isActive", 1);
$objQayaduser->setProperty("department_id", trim(DecData($_GET["i"], 1,$objBF)));
$objQayaduser->setProperty("ORDERBY", 'user_fname');
$CreatePrintURL = 'gen='.EncData("Department", 2, $objBF).'&i='.EncData(trim(DecData($_GET["i"], 1,$objBF)), 2, $objBF);

$objGetDepartmentName = new Qayaduser;
$objGetDepartmentName->setProperty("department_id", trim(DecData($_GET["i"], 1,$objBF)));
$objGetDepartmentName->lstDepartments();
$DepartmentNamebase = $objGetDepartmentName->dbFetchArray(1);
$Heading = '['.$DepartmentNamebase["department_name"].'->'.$DepartmentNamebase["company_name"].'] Department';

} elseif(trim(DecData($_GET["gen"], 1,$objBF)) == "AllEmployee"){
$objQayaduser->setProperty("isActive", 1);
$objQayaduser->setProperty("ORDERBY", 'user_fname');
$CreatePrintURL = 'gen='.EncData("AllEmployee", 2, $objBF);
$Heading = 'All';
}
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">person</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth"><code><?php echo $Heading;?></code> Employee Report</h4>
            <div class="toolbar add-btn text-right"> <a href="javascript:void(0);" onClick="openRequestedPopup('<?php echo SITE_URL.'print.php?'.$CreatePrintURL;?>', 2);" class="btn btn-primary"><i class="material-icons">print</i>&nbsp;  Print</a> </div>
            <hr>
            <div class="material-datatables">
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <td class="profile_tb_heading">Sr#</td>
                    <td class="profile_tb_heading">Name</td>
                    <td class="profile_tb_heading">Mobile</td>
                    <td class="profile_tb_heading">Position</td>
                    <td class="profile_tb_heading">Company/Location</td>
                  </tr>
                </thead>
                <tbody>
                  <?php
				    $objQayadLocation = new Qayaduser;
					$CountEmp = 0;
					$objQayaduser->VwUserDetail();
					while($ListOfUsers = $objQayaduser->dbFetchArray(1)){
					$CountEmp++;
				?>
                  <tr>
                    <td><?php echo $CountEmp;?></td>
                    <td><?php echo $ListOfUsers["fullname"];?></td>
                    <td><?php echo $ListOfUsers["user_mobile"];?></td>
                    <td><?php echo $ListOfUsers["user_designation"];?></td>
                    <td><?php echo $objQayadLocation->GetComLocInfo($ListOfUsers["location_id"]);?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
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
