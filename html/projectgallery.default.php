<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      <?php
		$objQayadProerty->setProperty("project_id", trim(DecData($_GET["i"], 1, $objBF)));
		$objQayadProerty->lstProjects();
		$ProjectDetail = $objQayadProerty->dbFetchArray(1);
	  ?>
      <h3 class="card-title CardWidth">Project Management :: <span class="text-primary"><?php echo $ProjectDetail["project_name"];?></span></h3>

        <div class="card">
          <div class="card-content">
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=projects');?>" class="btn btn-primary">Back</a> </div>
            <div class="card">
            <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="project_id" value="<?php echo trim(DecData($_GET["i"], 1, $objBF));?>">
            
            
            <div class="row">
            <label class="col-sm-12 label-on-right"></label>
            
                <div class="fileinput fileinput-new text-center" data-provides="fileinput" style="min-height:auto !important;">
                    <div class="col-sm-9">
                    <div class="fileinput-new thumbnail">
                    <img src="<?php echo SITE_URL;?>assets/img/image_placeholder.jpg">
                        
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                    </div>
                    
                    <div class="col-sm-3">
                    <div>
                        <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Select image</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="project_image" required="required" />
                        </span>
                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                    </div>
                </div>
            </div>
           </div>
           
           
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill" tabindex="5">Submit</button>
            </div>
          </form>
            </div>
            
          </div>
          <!-- end content--> 
        </div>
        <!--  end card  --> 
        
        
        
        <div class="card">
          <div class="card-content">
            <div class="material-datatables">            
			<?php
            $objQayadProerty->resetProperty();
			$objQayadProerty->setProperty("isActive", 1);
            $objQayadProerty->setProperty("ORDERBY", 'project_gallery_id');
			$objQayadProerty->setProperty("project_id", trim(DecData($_GET["i"], 1, $objBF)));
            $objQayadProerty->lstProjectGallery();
            while($ListOfProjectGallery = $objQayadProerty->dbFetchArray(1)){
            ?>
			<div class="col-sm-3" style="text-align:center;"><img src="<?php echo COMPANY_PROJ_THUMB_URL.$ListOfProjectGallery["file_name"];?>" /> <a href="<?php echo Route::_('show=projectgallery&ac='.EncData('DEL', 2, $objBF).'&i='.EncData($ListOfProjectGallery["project_id"], 2, $objBF).'&gi='.EncData($ListOfProjectGallery["project_gallery_id"], 2, $objBF));?>" type="button" rel="tooltip" class="btn btn-success btn-simple form-edit" title="Delete this project image."> <i class="material-icons">delete</i> </a></div>
            
            <?php } ?>  
            </div>
            
          </div>
          <!-- end content--> 
        </div>
        
        
        
        
        
        
        
        
        
        
        
        
        
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>


