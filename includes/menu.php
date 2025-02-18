<?php if($CallAssetsFolfer == 1){?>
<?php } elseif($CallAssetsFolfer == 2){?>

<div class="sidebar" data-active-color="rose" data-background-color="black">
<div class="logo"> <a href="<?php echo SITE_URL; ?>" class="simple-text logo-mini"> <span style="display:none;" id="minilogo"><img src="<?php echo SITE_URL;?>assets<?php echo $CallMenuBarAndHeader;?>/img/ig-icon.png" width="30"></span> </a> <a href="<?php echo SITE_URL; ?>" class="simple-text logo-normal"> <img src="<?php echo SITE_URL;?>assets<?php echo $CallMenuBarAndHeader;?>/img/app-logo.png" width="150"> </a> </div>
<?php } else {?>
<div class="sidebar" data-active-color="rose" data-background-color="black">
  <div class="logo"> <a href="<?php echo SITE_URL; ?>" class="simple-text logo-mini"> <span style="display:none;" id="minilogo"><img src="<?php echo SITE_URL;?>assets<?php echo $CallMenuBarAndHeader;?>/img/ig-icon.png" width="30"></span> </a> <a href="<?php echo SITE_URL; ?>" class="simple-text logo-normal"> <img src="<?php echo SITE_URL;?>assets<?php echo $CallMenuBarAndHeader;?>/img/app-logo.png" width="150"> </a> </div>
  <?php } ?>
  <div class="sidebar-wrapper">
    <div class="user">
      <div class="photo"> <img src="<?php echo USER_PROFILE_THUMB_URL.ProfileImgChecker($objQayaduser->profile_img);?>" /> </div>
      <div class="info"> <a href="<?php echo SITE_URL;?>" class="collapsed"> <span> <?php echo $objQayaduser->fullname;?> </span> </a> </div>
    </div>
    <ul class="nav">
      <li> <a href="<?php echo SITE_URL;?>"> <i class="material-icons">dashboard</i>
        <p> Dashboard </p>
        </a> </li>
      <?php 
		// Main Super Admin Login Menu
		if($objCheckLogin->user_type == 1){?> 
		
        <hr />
        <li> <a href="<?php echo Route::_('show=orderrequest');?>"> <i class="material-icons">list_alt</i>
        <p> Customer Order</p>
        </a> </li>
        
        <li> <a href="<?php echo Route::_('show=vendororder');?>"> <i class="material-icons">list_alt</i>
        <p> Supplier Order</p>
        </a> </li>
        
        <li> <a href="<?php echo Route::_('show=customercontra');?>"> <i class="material-icons">list_alt</i>
        <p> Customer Contra Order</p>
        </a> </li>
        
        <li> <a href="<?php echo Route::_('show=outsideorder');?>"> <i class="material-icons">list_alt</i>
        <p> Outside Order</p>
        </a> </li>
        <hr />
         <li> <a href="<?php echo Route::_('show=completevendororder');?>"> <i class="material-icons">list_alt</i>
        <p> Complete Supplier Order</p>
        </a> </li>

        <li> <a href="<?php echo Route::_('show=completeoutsideorder');?>"> <i class="material-icons">list_alt</i>
        <p> Complete Outside Order</p>
        </a> </li>


        <hr>
        <li> <a href="<?php echo Route::_('show=modifypriceso');?>"> <i class="material-icons">list_alt</i>
        <p> Modify Price (SO)</p>
        </a> </li>
        
        
        
        <!--<li> <a data-toggle="collapse" href="#menu_order_request_mgmt"> <i class="material-icons">domain</i>
        <p> Order Request Mgmt <b class="caret"></b> </p>
        </a>
        <div class="collapse" id="menu_order_request_mgmt">
          <ul class="nav">
            <li> <a href="<?php echo Route::_('show=orderreqprocess&opt='.EncData('1', 2, $objBF));?>"> <span class="sidebar-mini"> UP </span> <span class="sidebar-normal"> Under Process </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=orderreqprocess&opt='.EncData('2', 2, $objBF));?>"> <span class="sidebar-mini"> CO </span> <span class="sidebar-normal"> Complete Orders </span> </a> </li>
          </ul>
        </div>
      </li>
        
        <li> <a href="<?php echo Route::_('show=orderprocess');?>"> <i class="material-icons">home</i>
        <p> Customer Order</p>
        </a> </li>
        
        <li> <a data-toggle="collapse" href="#manu_process_order"> <i class="material-icons">domain</i>
        <p> Order Management <b class="caret"></b> </p>
        </a>
        <div class="collapse" id="manu_process_order">
          <ul class="nav">
            <li> <a href="<?php echo Route::_('show=uporders');?>"> <span class="sidebar-mini"> UPO </span> <span class="sidebar-normal"> Under Process Orders </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=dorders');?>"> <span class="sidebar-mini"> CO </span> <span class="sidebar-normal"> Complete Orders </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=cancelorders');?>"> <span class="sidebar-mini"> CNO </span> <span class="sidebar-normal"> Cancel Orders </span> </a> </li>
          </ul>
        </div>
      </li>-->
      
      <hr />
      
		<li> <a href="<?php echo Route::_('show=location');?>"> <i class="material-icons">home</i>
        <p> List of Locations </p>
        </a> </li>
        
        <li> <a href="<?php echo Route::_('show=customers');?>"> <i class="material-icons">home</i>
        <p> List of Customers </p>
        </a> </li>
        
        
        <li> <a href="<?php echo Route::_('show=suppliers');?>"> <i class="material-icons">home</i>
        <p> List of Supplier </p>
        </a> </li>
        
        <li> <a href="<?php echo Route::_('show=unloader');?>"> <i class="material-icons">home</i>
        <p> Unloader Detail </p>
        </a> </li>
        
        <li> <a href="<?php echo Route::_('show=vehicle');?>"> <i class="material-icons">home</i>
        <p> List of Vehicles</p>
        </a> </li>
        
        <li> <a href="<?php echo Route::_('show=lstdiesel');?>"> <i class="material-icons">home</i>
        <p> Diesel Suppliers</p>
        </a> </li>
        
        <li> <a href="<?php echo Route::_('show=lstmobiloil');?>"> <i class="material-icons">home</i>
        <p> Mobil Oil Suppliers</p>
        </a> </li>
        
        <li> <a href="<?php echo Route::_('show=lsttyre');?>"> <i class="material-icons">home</i>
        <p> Tyre Suppliers</p>
        </a> </li>
        
        <li> <a href="<?php echo Route::_('show=products');?>"> <i class="material-icons">home</i>
        <p> List of Products </p>
        </a> </li>
        
        <li> <a data-toggle="collapse" href="#manu_basic_type"> <i class="material-icons">domain</i>
        <p> Basic Type Section <b class="caret"></b> </p>
        </a>
        <div class="collapse" id="manu_basic_type">
          <ul class="nav">
            <li> <a href="<?php echo Route::_('show=customertype');?>"> <span class="sidebar-mini"> CT </span> <span class="sidebar-normal"> Customer Type </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=vehicletype');?>"> <span class="sidebar-mini"> VT </span> <span class="sidebar-normal"> Vehicle Type </span> </a> </li>
          </ul>
        </div>
      </li>
        
        
        <hr />
        <li> <a data-toggle="collapse" href="#report_menu_section"> <i class="material-icons">domain</i>
        <p> Report Section <b class="caret"></b> </p>
        </a>
        <div class="collapse" id="report_menu_section">
          <ul class="nav">
            <li> <a href="<?php echo Route::_('show=report&sec='.EncData('A', 2, $objBF));?>"> <span class="sidebar-mini"> PR </span> <span class="sidebar-normal"> Purchasing Report </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=report&sec='.EncData('B', 2, $objBF));?>"> <span class="sidebar-mini"> SR </span> <span class="sidebar-normal"> Selling Report </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=report&sec='.EncData('C', 2, $objBF));?>"> <span class="sidebar-mini"> PL </span> <span class="sidebar-normal"> Profit & loss Report </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=report&sec='.EncData('D', 2, $objBF));?>"> <span class="sidebar-mini"> IR </span> <span class="sidebar-normal"> Inventory Report </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=report&sec='.EncData('E', 2, $objBF));?>"> <span class="sidebar-mini"> CR </span> <span class="sidebar-normal"> Customer Balance Report </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=report&sec='.EncData('F', 2, $objBF));?>"> <span class="sidebar-mini"> DC </span> <span class="sidebar-normal"> Customer Disc & Other Charges </span> </a> </li>
			  <li> <a href="<?php echo Route::_('show=report&sec='.EncData('H', 2, $objBF));?>"> <span class="sidebar-mini"> DC </span> <span class="sidebar-normal"> Supplier Discount </span> </a> </li>
          </ul>
        </div>
      </li>
        <hr />
        
        <li> <a href="<?php echo Route::_('show=transactionmode');?>"> <i class="material-icons">attach_money</i>
        <p> New Transaction's </p>
        </a> </li>
      <!--<li> <a href="<?php echo Route::_('show=fwdpayreqproc');?>"> <i class="material-icons">attach_money</i> <?php echo $ShowFWDPaymentCounter;?>
        <p> Request Received </p>
        </a> </li>-->
      <li> <a href="<?php echo Route::_('show=transaction');?>"> <i class="material-icons">attach_money</i>
        <p> Daybook </p>
        </a> </li>
      <li> <a data-toggle="collapse" href="#account_opt"> <i class="material-icons">library_books</i>
        <p> Account Ledger's <b class="caret"></b> </p>
        </a>
        <div class="collapse" id="account_opt">
          <ul class="nav" style="background-color:#F5F5F5">
            <li> <a href="<?php echo Route::_('show=ledgerhead&t='.EncData('2', 2, $objBF));?>"> <span class="sidebar-mini"> CH </span> <span class="sidebar-normal"> Cash Head Ledger </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=ledgerhead&t='.EncData('3', 2, $objBF));?>"> <span class="sidebar-mini"> BA </span> <span class="sidebar-normal"> Bank Account Ledger </span> </a> </li>
            <hr />
            <li> <a href="<?php echo Route::_('show=ledgerhead&t='.EncData('6', 2, $objBF));?>"> <span class="sidebar-mini"> SH </span> <span class="sidebar-normal"> Supplier Ledger</span> </a> </li>
            <li> <a href="<?php echo Route::_('show=ledgerhead&t='.EncData('4', 2, $objBF));?>"> <span class="sidebar-mini"> CH </span> <span class="sidebar-normal"> Customer Ledger</span> </a> </li>
            <li> <a href="<?php echo Route::_('show=ledgerhead&t='.EncData('7', 2, $objBF));?>"> <span class="sidebar-mini"> VH </span> <span class="sidebar-normal"> Vehicle Head Ledger</span> </a> </li>
            <li> <a href="<?php echo Route::_('show=ledgerhead&t='.EncData('8', 2, $objBF));?>"> <span class="sidebar-mini"> UH </span> <span class="sidebar-normal"> Unloader Head Ledger</span> </a> </li>
            
            
            <li> <a href="<?php echo Route::_('show=ledgerhead&t='.EncData('10', 2, $objBF));?>"> <span class="sidebar-mini"> DH </span> <span class="sidebar-normal"> Diesel Head Ledger</span> </a> </li>
            <li> <a href="<?php echo Route::_('show=ledgerhead&t='.EncData('11', 2, $objBF));?>"> <span class="sidebar-mini"> MH </span> <span class="sidebar-normal"> Mobil Oil Head Ledger</span> </a> </li>
            <li> <a href="<?php echo Route::_('show=ledgerhead&t='.EncData('12', 2, $objBF));?>"> <span class="sidebar-mini"> TH </span> <span class="sidebar-normal"> Tyre Head Ledger</span> </a> </li>
            
            
            
            <hr />
            <li> <a href="<?php echo Route::_('show=ledgerhead&t='.EncData('1', 2, $objBF));?>"> <span class="sidebar-mini"> GH </span> <span class="sidebar-normal"> General Head Ledger</span> </a> </li>
            <li> <a href="<?php echo Route::_('show=ledgerhead&t='.EncData('13', 2, $objBF));?>"> <span class="sidebar-mini"> DA </span> <span class="sidebar-normal"> Drawing Accounts Ledger</span> </a> </li>
            <li> <a href="<?php echo Route::_('show=ledgerhead&t='.EncData('5', 2, $objBF));?>"> <span class="sidebar-mini"> EH </span> <span class="sidebar-normal"> Employee Head Ledger</span> </a> </li>
            <hr />
            <li> <a href="<?php echo Route::_('show=ledgerhead&t='.EncData('CD', 2, $objBF));?>"> <span class="sidebar-mini"> CD </span> <span class="sidebar-normal"> Customer Discount Ledger</span> </a> </li>
            <li> <a href="<?php echo Route::_('show=ledgerhead&t='.EncData('SD', 2, $objBF));?>"> <span class="sidebar-mini"> CD </span> <span class="sidebar-normal"> Supplier Discount Ledger</span> </a> </li>
            
          </ul>
        </div>
      </li>
      <li> <a data-toggle="collapse" href="#menu_propertysection"> <i class="material-icons">domain</i>
        <p> Head Section <b class="caret"></b> </p>
        </a>
        <div class="collapse" id="menu_propertysection">
          <ul class="nav">
            <li> <a href="<?php echo Route::_('show=headgroup');?>"> <span class="sidebar-mini"> HG </span> <span class="sidebar-normal"> Head Group's </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=achead');?>"> <span class="sidebar-mini"> AH </span> <span class="sidebar-normal"> Account Head's </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=headitem');?>"> <span class="sidebar-mini"> HI </span> <span class="sidebar-normal"> Head Item's </span> </a> </li>
          </ul>
        </div>
      </li>
 <hr />
 	
    
    <li> <a data-toggle="collapse" href="#wrong_transaction_section"> <i class="material-icons">money_off</i>
        <p> Wrong Transactions<b class="caret"></b> </p>
        </a>
        <div class="collapse" id="wrong_transaction_section">
          <ul class="nav">
            <li> <a href="<?php echo Route::_('show=openingbalance');?>"> <span class="sidebar-mini"> OB </span> <span class="sidebar-normal"> Opening Balance </span> </a> </li>
            
            <li> <a href="<?php echo Route::_('show=wrongtransaction');?>"> <span class="sidebar-mini"> RT </span> <span class="sidebar-normal"> Remove Transactions </span> </a> </li>
            <hr>
            <li> <a href="<?php echo Route::_('show=wtcustomerorder');?>"> <span class="sidebar-normal">Amount MOD Customer Order </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=wtsellerorder');?>">  <span class="sidebar-normal">Amount MOD Supplier Order </span> </a> </li>
            <!--<li> <a href="<?php echo Route::_('show=wtcustomercontraorder');?>"> <span class="sidebar-normal"> Customer Contra Order </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=wtoutsideorder');?>">  <span class="sidebar-normal"> Outside Order</span> </a> </li>-->
            <hr>            
          </ul>
        </div>
      </li>
      
    
        
        <hr />
        
        
        
        
        <li> <a href="<?php echo Route::_('show=employees');?>"> <i class="material-icons">person</i>
        <p> Employees Management </p>
        </a> </li>
     
      <li> <a href="<?php echo Route::_('show=monthlysalaryhr');?>"> <i class="material-icons">attach_money</i>
        <p> Monthly Salary Calculation </p>
        </a> </li>
      <li> <a href="<?php echo Route::_('show=generatedsalary');?>"> <i class="material-icons">attach_money</i>
        <p> Generated Salary </p>
        </a> </li>
      
      
      <li> <a data-toggle="collapse" href="#raw_data"> <i class="material-icons">notes</i>
        <p> Raw Data <b class="caret"></b> </p>
        </a>
        <div class="collapse" id="raw_data">
          <ul class="nav">
            <li> <a href="<?php echo Route::_('show=inactiveemployee');?>"> <span class="sidebar-mini"> IAE </span> <span class="sidebar-normal"> InActive Employee</span> </a> </li>
          </ul>
        </div>
      </li>
      <li> <a data-toggle="collapse" href="#menu_reports"> <i class="material-icons">notes</i>
        <p> Reports <b class="caret"></b> </p>
        </a>
        <div class="collapse" id="menu_reports">
          <ul class="nav">
            <li> <a href="<?php echo Route::_('show=rpempsalary');?>"> <span class="sidebar-mini"> SR </span> <span class="sidebar-normal"> Employee Salary List </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=repemplist');?>"> <span class="sidebar-mini"> AEL </span> <span class="sidebar-normal">Active Employee List </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=manualatt');?>"> <span class="sidebar-mini"> MA </span> <span class="sidebar-normal"> Manual Attendance </span> </a> </li>
          </ul>
        </div>
      </li>
      <hr />
		<?php } elseif($objCheckLogin->user_type == 2){ ?>
        
        
        <li> <a href="<?php echo Route::_('show=location');?>"> <i class="material-icons">home</i>
        <p> List of Locations </p>
        </a> </li>
        
        <li> <a href="<?php echo Route::_('show=customertype');?>"> <i class="material-icons">home</i>
        <p> List of Customer Type </p>
        </a> </li>
        
        <li> <a href="<?php echo Route::_('show=customers');?>"> <i class="material-icons">home</i>
        <p> List of Customers </p>
        </a> </li>
        
        
        <li> <a href="<?php echo Route::_('show=suppliers');?>"> <i class="material-icons">home</i>
        <p> List of Supplier </p>
        </a> </li>
        
        <li> <a href="<?php echo Route::_('show=products');?>"> <i class="material-icons">home</i>
        <p> List of Products </p>
        </a> </li>
        
        <li> <a href="<?php echo Route::_('show=vehicletype');?>"> <i class="material-icons">home</i>
        <p> List of Vehicle Type</p>
        </a> </li>
        
        <li> <a href="<?php echo Route::_('show=vehicle');?>"> <i class="material-icons">home</i>
        <p> List of Vehicles</p>
        </a> </li>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
      <?php 
	  // Collection Team Menu
	  } elseif($objCheckLogin->user_type == 4){ ?>
      
      
      <?php 
	  // Finance Team Menu
	  } elseif($objCheckLogin->user_type == 3){ /* Finance Section Menu*/?>
      <li> <a href="<?php echo Route::_('show=transactionmode');?>"> <i class="material-icons">attach_money</i>
        <p> New Transaction's </p>
        </a> </li>
      
      <li> <a href="<?php echo Route::_('show=transaction');?>"> <i class="material-icons">attach_money</i>
        <p> Daybook </p>
        </a> </li>
      <li> <a data-toggle="collapse" href="#account_opt"> <i class="material-icons">library_books</i>
        <p> Account Ledger's <b class="caret"></b> </p>
        </a>
        <div class="collapse" id="account_opt">
          <ul class="nav">
            <li> <a href="<?php echo Route::_('show=ledgerhead&t='.EncData('2', 2, $objBF));?>"> <span class="sidebar-mini"> CH </span> <span class="sidebar-normal"> List of Cash Head's </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=ledgerhead&t='.EncData('3', 2, $objBF));?>"> <span class="sidebar-mini"> BA </span> <span class="sidebar-normal"> List of Bank Account's </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=ledgerhead&t='.EncData('1', 2, $objBF));?>"> <span class="sidebar-mini"> GH </span> <span class="sidebar-normal"> List of General Head's</span> </a> </li>
            <li> <a href="<?php echo Route::_('show=ledgerhead&t='.EncData('5', 2, $objBF));?>"> <span class="sidebar-mini"> EH </span> <span class="sidebar-normal"> List of Employee Head's</span> </a> </li>
          </ul>
        </div>
      </li>
      <li> <a data-toggle="collapse" href="#menu_propertysection"> <i class="material-icons">domain</i>
        <p> Head Section <b class="caret"></b> </p>
        </a>
        <div class="collapse" id="menu_propertysection">
          <ul class="nav">
            <li> <a href="<?php echo Route::_('show=headgroup');?>"> <span class="sidebar-mini"> HG </span> <span class="sidebar-normal"> Head Group's </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=achead');?>"> <span class="sidebar-mini"> AH </span> <span class="sidebar-normal"> Account Head's </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=headitem');?>"> <span class="sidebar-mini"> HI </span> <span class="sidebar-normal"> Head Item's </span> </a> </li>
          </ul>
        </div>
      </li>
      

      <?php 
	  // HR Team Menu
	  } elseif($objCheckLogin->user_type == 9 or $objCheckLogin->user_type == 16){ ?>
      <li> <a href="<?php echo Route::_('show=employees');?>"> <i class="material-icons">person</i>
        <p> Employees Management </p>
        </a> </li>
      <li> <a href="<?php echo Route::_('show=attendance');?>"> <i class="material-icons">markunread_mailbox</i>
        <p> Attendance Management </p>
        </a> </li>
      <li> <a href="<?php echo Route::_('show=outtimemissing');?>"> <i class="material-icons">person</i>
        <p> Out Time Missing List </p>
        </a> </li>
      <li> <a href="<?php echo Route::_('show=employeeleave');?>"> <i class="material-icons">person</i>
        <p> Leave Request </p>
        </a> </li>
      <li> <a href="<?php echo Route::_('show=modifyemployeeleave');?>"> <i class="material-icons">person</i>
        <p> Modify Leave Request </p>
        </a> </li>
      <?php if($objCheckLogin->user_type == 9){?>
      <li> <a href="<?php echo Route::_('show=monthlysalaryhr');?>"> <i class="material-icons">attach_money</i>
        <p> Monthly Salary Calculation </p>
        </a> </li>
      <li> <a href="<?php echo Route::_('show=generatedsalary');?>"> <i class="material-icons">attach_money</i>
        <p> Generated Salary </p>
        </a> </li>
      <?php } ?>
      <li> <a data-toggle="collapse" href="#request_flow"> <i class="material-icons">notes</i>
        <p> Request Flow Struc... <b class="caret"></b> </p>
        </a>
        <div class="collapse" id="request_flow">
          <ul class="nav">
            <li> <a href="<?php echo Route::_('show=deprequestflow');?>"> <span class="sidebar-mini"> DBF </span> <span class="sidebar-normal"> Department Base Flow </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=emprequestflow');?>"> <span class="sidebar-mini"> EF </span> <span class="sidebar-normal"> Employee Flow </span> </a> </li>
          </ul>
        </div>
      </li>
      <li> <a data-toggle="collapse" href="#menu_logsection"> <i class="material-icons">notes</i>
        <p> Basic Management <b class="caret"></b> </p>
        </a>
        <div class="collapse" id="menu_logsection">
          <ul class="nav">
            <li> <a href="<?php echo Route::_('show=department');?>"> <span class="sidebar-mini"> DM </span> <span class="sidebar-normal"> Department Management </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=shift');?>"> <span class="sidebar-mini"> LM </span> <span class="sidebar-normal"> Shift Management </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=yearlyleave');?>"> <span class="sidebar-mini"> LM </span> <span class="sidebar-normal"> Yearly Leaves </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=leavetype');?>"> <span class="sidebar-mini"> LM </span> <span class="sidebar-normal"> Type of Leaves </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=holidays');?>"> <span class="sidebar-mini"> HM </span> <span class="sidebar-normal"> Holidays Management </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=jobtitle');?>"> <span class="sidebar-mini"> JT </span> <span class="sidebar-normal"> Job Title Management</span> </a> </li>
          </ul>
        </div>
      </li>
      <li> <a data-toggle="collapse" href="#raw_data"> <i class="material-icons">notes</i>
        <p> Raw Data <b class="caret"></b> </p>
        </a>
        <div class="collapse" id="raw_data">
          <ul class="nav">
            <li> <a href="<?php echo Route::_('show=inactiveemployee');?>"> <span class="sidebar-mini"> IAE </span> <span class="sidebar-normal"> InActive Employee</span> </a> </li>
          </ul>
        </div>
      </li>
      <li> <a data-toggle="collapse" href="#menu_reports"> <i class="material-icons">notes</i>
        <p> Reports <b class="caret"></b> </p>
        </a>
        <div class="collapse" id="menu_reports">
          <ul class="nav">
            <?php if($objCheckLogin->user_type == 9){?>
            <li> <a href="<?php echo Route::_('show=rpempsalary');?>"> <span class="sidebar-mini"> SR </span> <span class="sidebar-normal"> Employee Salary List </span> </a> </li>
            <?php } ?>
            <li> <a href="<?php echo Route::_('show=repemplist');?>"> <span class="sidebar-mini"> AEL </span> <span class="sidebar-normal">Active Employee List </span> </a> </li>
            <li> <a href="<?php echo Route::_('show=manualatt');?>"> <span class="sidebar-mini"> MA </span> <span class="sidebar-normal"> Manual Attendance </span> </a> </li>
          </ul>
        </div>
      </li>
      <?php 
	  // Complain Team Menu
	  } elseif($objCheckLogin->user_type == 5){ ?>
      <hr />
       <li> <a href="<?php echo Route::_('show=complain');?>"> <i class="material-icons">settings_accessibility</i>
        <p> List of Complains</p>
        </a> </li>
         <li> <a href="<?php echo Route::_('show=rescomplain');?>"> <i class="material-icons">done_all</i>
        <p> List of Resolved</p>
        </a> </li>
      <?php 
	  // Front-Desk Team Menu
	  } elseif($objCheckLogin->user_type == 6){ ?>
      <hr />
      <li> <a href="<?php echo Route::_('show=complainform');?>"> <i class="material-icons">app_registration</i>
        <p> Register Complain</p>
        </a> </li>
        <li> <a href="<?php echo Route::_('show=complncat');?>"> <i class="material-icons">category</i>
        <p> List of Categories</p>
        </a> </li>
        <li> <a href="<?php echo Route::_('show=complain');?>"> <i class="material-icons">settings_accessibility</i>
        <p> List of Complains</p>
        </a> </li>
        <li> <a href="<?php echo Route::_('show=rescomplain');?>"> <i class="material-icons">done_all</i>
        <p> List of Resolved</p>
        </a> </li>
      
      
      <?php } ?>
       <?php if($objCheckLogin->user_type != 1){ echo $EmployeeMenu; } ?>
      <li> <a href="<?php echo Route::_('show=changepass');?>"> <i class="material-icons">build</i>
        <p> Change Password </p>
        </a> </li>
      <?php if($SalarySecurityCode != ""){ ?>
      <li> <a href="<?php echo Route::_('show=changesecuritycode'); ?>"> <i class="material-icons">build</i>
        <p> Change Security Code </p>
        </a></li>
      <?php } ?>
      <li> <a href="<?php echo Route::_('show=logout');?>"> <i class="material-icons">keyboard_tab</i>
        <p> Logout </p>
        </a> </li>
    </ul>
  </div>
</div>
