<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      <?php if($_GET["i"]==''){?>
	<h3 class="card-title CardWidth">Project Management</h3>
            <div class="toolbar add-btn text-right mt-50px"> <a href="<?php echo Route::_('show=projectform');?>" class="btn btn-primary">Add New</a> </div>      
      <?php } else { 
		$objQayadProerty->setProperty("project_id", trim(DecData($_GET["i"], 1, $objBF)));
		$objQayadProerty->lstProjects();
		$ProjectDetail = $objQayadProerty->dbFetchArray(1);
	  ?>
      <h3 class="card-title CardWidth">Project Management :: <span class="text-primary"><?php echo $ProjectDetail["project_name"];?></span></h3>
      <?php } ?>
        <div class="card">
          <div class="card-content">
            <?php if($_GET["i"]==''){?>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Project Name</th>
                    <th>Location</th>
                    <th>Contact #</th>
                    <th>Type</th>
                    <th class="disabled-sorting text-right">Actions</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Project Name</th>
                    <th>Location</th>
                    <th>Contact #</th>
                    <th>Type</th>
                    <th class="text-right">Actions</th>
                  </tr>
                </tfoot>
                <tbody>
                <?php
					$objQayadProerty->setProperty("isNot", 3);
					$objQayadProerty->setProperty("ORDERBY", 'project_id');
					$objQayadProerty->lstProjects();
					while($ListOfProjects = $objQayadProerty->dbFetchArray(1)){
				?>
                  <tr>
                    <td><a rel="tooltip" title="<?php echo $ListOfProjects["project_name"];?>" href="<?php echo Route::_('show=projects&i='.EncData($ListOfProjects["project_id"], 2, $objBF));?>"><?php echo $ListOfProjects["project_name"];?></a></td>
                   
                    <td><?php echo $ListOfProjects["project_location"];?></td>
                    <td><?php echo $ListOfProjects["project_contact_number"];?></td>
                    <td><?php echo ProjectType($ListOfProjects["project_type"]);?></td>
                    <td class="td-actions text-right">
                    
                    <a href="<?php echo Route::_('show=projectgallery&i='.EncData($ListOfProjects["project_id"], 2, $objBF));?>" type="button" rel="tooltip" class="btn btn-success btn-simple form-edit" title="Add/Edit Project Gallery"> <i class="material-icons">image</i> </a>
                    
                    <a href="<?php echo Route::_('show=projectform&i='.EncData($ListOfProjects["project_id"], 2, $objBF));?>" type="button" rel="tooltip" class="btn btn-success btn-simple form-edit" title="Edit Project Detail info"> <i class="material-icons">edit</i> </a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <?php } else { ?>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=projectform&i='.$_GET["i"]);?>" class="btn btn-primary">Edit</a> </div>
            <div class="table-responsive">
              <table class="table" cellspacing="0" width="100%" style="width:100%">
                <tbody>
                  <tr>
                    <td class="text-primary label-type">Project:</td>
                    <td class="value"><?php echo $ProjectDetail["project_name"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Location:</td>
                    <td class="value"><?php echo $ProjectDetail["project_location"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Contact Number:</td>
                    <td class="value"><?php echo $ProjectDetail["project_contact_number"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Description:</td>
                    <td class="value"><?php echo $ProjectDetail["project_description"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Project Type:</td>
                    <td class="value"><?php echo ProjectType($ProjectDetail["project_type"]);?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <?php } ?>
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