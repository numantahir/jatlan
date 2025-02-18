<div class="main-panel">
<nav class="navbar navbar-transparent navbar-absolute">
  <div class="container-fluid">
    <div class="navbar-minimize">
      <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon BoxShadoBorderNone"> <i class="material-icons visible-on-sidebar-regular">menu</i> <i class="material-icons visible-on-sidebar-mini">view_list</i> </button>
    </div>
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <!-- Title Area --> 
      <a class="navbar-brand" href="#"> <?php echo SITE_NAME;?> </a> </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <!--<li> <a class="logout-btn" href="<?php echo Route::_('show=logout');?>">Logout</a> </li>
        <li class="separator hidden-lg hidden-md"></li>-->
      
      
      
      	<?php /*if($objQayaduser->user_type != 9 && $objQayaduser->user_type != 10){?>
      	<li>
           <a href="javascript:void();" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <?php 
		   if($objQayadProjectReg->reg_pro != ""){
		   $objQayadProerty->resetProperty();
		   echo 'Current Project Selected ('.$objQayadProerty->ProjectName(trim(DecData($objQayadProjectReg->reg_pro, 1, $objBF))).')';
		   } else {
			echo 'Select Project';   
		   }
		   ?>
           <b class="caret"></b></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" style="min-width:260px;">
                  
                   <?php
					$objQayadProjectTopList = new Qayadproperty;
					$objQayadProjectTopList->setProperty("isActive", 1);
					$objQayadProjectTopList->setProperty("ORDERBY", 'project_name');
					$objQayadProjectTopList->lstProjects();
					while($TopMenuProjectList = $objQayadProjectTopList->dbFetchArray(1)){
						if(trim(DecData($objQayadProjectReg->reg_pro, 1, $objBF)) != $TopMenuProjectList["project_id"]){
					?>
                  <a class="dropdownmenulink" href="<?php echo SITE_URL.'?reg='.EncData('project', 2, $objBF).'&pi='.EncData($TopMenuProjectList["project_id"], 2, $objBF).'&rt='.EncData($_GET["show"], 2, $objBF);?>"><i class="material-icons">domain</i> <?php echo $TopMenuProjectList["project_name"];?></a>
                  <?php } } ?>
                  
                  
                </div>
              </li>
              <?php } */ ?>
         <li>
                <a href="<?php echo Route::_('show=help');?>">
                  <i class="material-icons">help</i> Help</a>
              </li>       
        <li>
                <a href="<?php echo Route::_('show=logout');?>">
                  <i class="material-icons">keyboard_tab</i> Logout</a>
              </li>
        
      </ul>
      
      
      
      
      
      
      
      
      
      
      
      <form class="navbar-form navbar-right" role="search" style="display:none">
        <div class="form-group form-search is-empty">
          <input type="text" class="form-control" placeholder=" Search ">
          <span class="material-input"></span> </div>
        <button type="submit" class="btn btn-white btn-round btn-just-icon"> <i class="material-icons">search</i>
        <div class="ripple-container"></div>
        </button>
      </form>
    </div>
  </div>
</nav>