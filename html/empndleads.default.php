<div class="content">
<div class="container-fluid">
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-text" data-background-color="rose">
        <h4 class="card-title">List of Employee & Leads <?php echo $LoginUserInfo["location_id"];?></h4>
      </div>
      <div class="toolbar btn-back text-right"> </div>
      <div class="card-content">
        <div class="col-md-12 Bord-Rt no-border-right">
          <table class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
            <thead>
              <tr>
                <th>Name</th>
                <th>Mobile #</th>
                <th>Designation</th>
                <th>Office Location</th>
                <th>Overview</th>
              </tr>
            </thead>
            <tbody>
              <?php
			  		$objQayadGetLocation = new Qayaduser;
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("ORDERBY", "user_fname");
					$objQayaduser->setProperty("user_type_id_array", '4,21,22,23,24,25,26');
					$objQayaduser->setProperty("location_id", $LoginUserInfo["location_id"]);
					$objQayaduser->setProperty("user_id_not", $LoginUserInfo["user_id"]);
					$objQayaduser->lstUsers();
					while($ListofEmployee = $objQayaduser->dbFetchArray(1)){
                    ?>
              <tr>
                <td><?php echo $ListofEmployee["fullname"];?></td>
                <td><?php echo $ListofEmployee["user_mobile"];?></td>
                <td><?php echo UserType($ListofEmployee["user_type_id"]);?></td>
                <td><?php echo $objQayadGetLocation->GetLocation($ListofEmployee["location_id"]);?></td>
                <td><a href="<?php echo Route::_('show=empdetail&i='.EncData($ListofEmployee["user_id"], 2, $objBF));?>">Overview</a></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
