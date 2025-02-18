<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="user_skills_id" value="<?php echo $objBF->encrypt($user_skills_id, ENCRYPTION_KEY);?>">
            <input type="hidden" name="employee_id" value="<?php echo EncData(trim($objBF->decrypt($_GET["i"], 1, ENCRYPTION_KEY)), 1, $objBF);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Skills', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=employeedu&i='.$_GET["i"]);?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Skill's</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'skills');?>">
                  <label class="control-label"></label>
                  <textarea class="form-control" name="skills" rows="10"><?php echo $skills;?></textarea>
                  <small><?php echo $vResult["skills"];?></small> </div>
              </div>
            </div>
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
          </form>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
