<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      	<h3 class="card-title CardWidth">Property Type Detail</h3>
			<div class="toolbar add-btn text-right mt-50px"><a href="<?php echo Route::_('show=propertytypeform');?>" class="btn btn-primary">Add New</a> </div>
        <div class="card">
          <div class="card-content">
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Project</th>
                    <th>Project Type</th>
                    <th>Floor</th>
                    <th>Property Name</th>
                    <th>Area (Sqft)</th>
                    <th class="disabled-sorting text-right">Actions</th>
                  </tr>
                </thead>
                
                <tbody>
                <?php
					$objQayadProerty->resetProperty();
					$objQayadProertyFloor = new Qayadproperty;
					$objQayadProjectName = new Qayadproperty;
					$objQayadProerty->setProperty("project_id", $CurrentPorjectId);
					$objQayadProerty->setProperty("ORDERBY", 'property_type_id DESC');
					$objQayadProerty->lstPropertyType();
					while($PropTypeList = $objQayadProerty->dbFetchArray(1)){
						$objQayadProertyFloor->setProperty("propety_floor_id", $PropTypeList["propety_floor_id"]);
						$objQayadProertyFloor->lstPropertyFloorPlan();
						$FloorPlanList = $objQayadProertyFloor->dbFetchArray(1);
				?>
                  <tr>
                    <td><?php echo $objQayadProjectName->ProjectName($PropTypeList["project_id"]);?></td>
                    <td><?php echo RegisterProject($PropTypeList["project_type_id"]);?></td>
                    <td><?php echo $FloorPlanList["floor_name"];?></td>
                    <td><?php echo $PropTypeList["property_section"];?></td>
                    <td><?php echo $PropTypeList["property_area"];?></td>
                    <!--<td><?php //echo Numberformt($PropTypeList["property_rent_sqft"]);?></td>-->
                    <!--<td><?php
					//echo AreaShareCalculation($PropTypeList["project_type_id"], $PropTypeList["property_area"], 1);
					?></td>-->
                    <td class="td-actions text-right">
                    <!--<a href="<?php //echo Route::_('show=spppropertyform&i='.$PropTypeList["property_type_id"]);?>" type="button" rel="tooltip" class="btn btn-info btn-simple" title="Property Payment Plan Detail"> <i class="material-icons">payment</i> </a>-->
                    <a href="<?php echo Route::_('show=propertytypeform&i='.EncData($PropTypeList["property_type_id"], 2, $objBF).'&ip='.EncData($PropTypeList["propety_floor_id"], 2, $objBF));?>" type="button" rel="tooltip" class="btn btn-success btn-simple form-edit"><i class="material-icons">edit</i></a></td>
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