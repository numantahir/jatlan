<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      <h3 class="card-title CardWidth">Property Floor Plan</h3>
            <div class="toolbar add-btn text-right mt-50px"> <a href="<?php echo Route::_('show=floorplanform');?>" class="btn btn-primary">Add New</a> </div>
        <div class="card"> 
          <div class="card-content">
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Project Name</th>
                    <th>Project Type</th>
                    <th>Floor Name</th>
                    <th class="disabled-sorting text-right">Actions</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Project Name</th>
                    <th>Project Type</th>
                    <th>Floor Name</th>
                    <th class="text-right">Actions</th>
                  </tr>
                </tfoot>
                <tbody>
                <?php
					$objQayadProjectName = new Qayadproperty;
					$objQayadProerty->setProperty("project_id", $CurrentPorjectId);
					$objQayadProerty->setProperty("ORDERBY", 'propety_floor_id DESC');
					$objQayadProerty->lstPropertyFloorPlan();
					while($FloorPlanList = $objQayadProerty->dbFetchArray(1)){
				?>
                  <tr>
                    <td><?php echo $objQayadProjectName->ProjectName($FloorPlanList["project_id"]);?></td>
                    <td><?php echo RegisterProject($FloorPlanList["project_type_id"]);?></td>
                    <td><?php echo $FloorPlanList["floor_name"];?></td>
                    <td class="td-actions text-right">
                    <a href="<?php echo Route::_('show=ppproperties&i='.EncData($FloorPlanList["project_id"], 2, $objBF).'&fi='.EncData($FloorPlanList["propety_floor_id"], 2, $objBF));?>" type="button" rel="tooltip" class="btn btn-info btn-simple" title="Floor Payment Plan Detail"> <i class="material-icons">payment</i> </a>
                    <a href="<?php echo Route::_('show=floorplanform&i='.EncData($FloorPlanList["propety_floor_id"], 2, $objBF));?>" type="button" rel="tooltip" class="btn btn-success btn-simple form-edit"> <i class="material-icons">edit</i> </a></td>
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