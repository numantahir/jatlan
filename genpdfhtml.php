<?php
require_once("config/config.php");
$objCommon 				= new Common;
$objSSSinventory		= new SSSinventory;
$objSSSGrouplist		= new SSSinventory;
$objSSSMonthlyRent		= new SSSinventory;
$objSSSMonthlyRentAmount= new SSSinventory;
$objSSSTenantInfo		= new SSSinventory;
$objPropertyBundle		= new SSSinventory;
$objOldPaymentRec		= new SSSinventory;
$objEmployeeGet			= new SSSinventory;
$objSSSInstallmentPlan	= new SSSinventory;
$objSSSInstallmentList	= new SSSinventory;
$objSSSBlocList			= new SSSinventory;
$objSSSMonthlyBUp		= new SSSinventory;
$objSSSExtraCharges		= new SSSinventory;
$objQayaduser 			= new Qayaduser;

$objBF 					= new Crypt_Blowfish('CBC');
$objBF->setKey($cipher_key);

$objSSSinventory->resetProperty();
$objSSSinventory->setProperty("isAcitve", 1);
$objSSSinventory->setProperty("process_status", 2);
$objSSSinventory->lstGenMonthlyBill();
if($objSSSinventory->totalRecords() > 0){
$GetBillRequest = $objSSSinventory->dbFetchArray(1);
$GetFromLastYearThisList = $GetBillRequest["current_year"] - 1;
$currentMonth = date($GetFromLastYearThisList.'-'.$GetBillRequest["current_month"]);;

$TopHeaderGemHTML = '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Monthly Bill</title>
<style>
*{margin:0;padding:1;font-family:Tahoma, Geneva, sans-serif;
	font-size:11px;}
body{
	font-family:Tahoma, Geneva, sans-serif;
	font-size:11px;
	padding:0px;
	margin:0px;
}
.Three_tab_Border{
	border-bottom:solid 1px #999999;
	border-top:solid 1px #999999;
	border-left:solid 1px #999999;
	border-right:solid 1px #999999;
}
.Three_tab_Border td{
	
	padding:5px;
	font-weight:bold;
	color:#666;
}
.Three_tab_Border th{
	border-right:solid 1px #999999;
	text-align:left;
	font-weight:bold;
}
.Copy_text{
	font-size:11px;
	text-align:center;
	border-bottom:solid 1px #999999;
	letter-spacing:5px;
	text-transform:uppercase;
	background-color:#FFF;
	color:#666;
}
.CompanyLogoText{
	font-size:14px;
	font-weight:bold;
	letter-spacing:1px;
}
.CompanyAddress{
	font-size:12px;
	text-align:center;
	letter-spacing:-0.5px;
}
.MonthlyBillText{
	font-size:16px;
	font-weight:bold;
	text-align:center;
	padding-top:5px;
	padding-bottom:5px;
	letter-spacing:3px;
	border-top:solid 1px #999999;
	background-color:#FFF;
	color:#666;
}
.BillMonth{
	font-size:12px;
	font-weight:bold;
	text-align:center;
	padding-top:5px;
	padding-bottom:5px;
	letter-spacing:1px;
	border-top:solid 1px #999999;
	background-color:#FFF;
	color:#000;
}
.TopMargin10{
	margin-top:0px;
}
.FullBorderTable{
	border-top:solid 1px #999999;
	border-left:solid 1px #999999;
}
.FullBorderTable th{
	border-right:solid 1px #999999;
	border-bottom:solid 1px #999999;
	background-color:#FFF;
	color:#666;
}
.FullBorderTable td{
	border-right:solid 1px #999999;
	border-bottom:solid 1px #999999;
}
.info_tabl_linhigh{
	line-height:18.6px;
}
.page_break { page-break-before: always; }
.pagebrea{page-break-after: always;}
</style>
</head>

<body>';


$objSSSBlocList->resetProperty();
$objSSSBlocList->setProperty("isNot", 3);
$objSSSBlocList->setProperty("ORDERBY", 'block_id');
//$objSSSBlocList->setProperty("block_id", 1);
$objSSSBlocList->lstBlocks();
while($ListOfBlocks = $objSSSBlocList->dbFetchArray(1)){
//echo 'BN:'.$ListOfBlocks["block_name"].'<br>';	
$GenHTML = $TopHeaderGemHTML;	
$objSSSGrouplist->resetProperty();
$objSSSGrouplist->setProperty("block_id", $ListOfBlocks['block_id']);
$objSSSGrouplist->setProperty("generate_bill_id", $GetBillRequest["generate_bill_id"]);
$objSSSGrouplist->setProperty("GROUPBY", 'monthly_rent_id');
$objSSSGrouplist->setProperty("ORDERBY", 'monthly_rent_id');
$objSSSGrouplist->lstAssignGroupTenantList();
while($ListOfAssignGroups = $objSSSGrouplist->dbFetchArray(1)){
//$ListOfAssignGroups = $objSSSGrouplist->dbFetchArray(1);

$objSSSMonthlyRent->resetProperty();
$objSSSMonthlyRent->setProperty("generate_bill_id", $GetBillRequest["generate_bill_id"]);
$objSSSMonthlyRent->setProperty("monthly_rent_id", $ListOfAssignGroups["monthly_rent_id"]);
$objSSSMonthlyRent->lstMonthlyRent();
$MonthlyRentDetail = $objSSSMonthlyRent->dbFetchArray(1);
//echo 'BAN:'.$ListOfAssignGroups["block_id"].'-'.$ListOfAssignGroups["monthly_rent_id"].'-'.$MonthlyRentDetail["monthly_rent_id"].'<br>';
$objSSSMonthlyRentAmount->resetProperty();
$objSSSMonthlyRentAmount->setProperty("monthly_rent_id", $MonthlyRentDetail["monthly_rent_id"]);
$objSSSMonthlyRentAmount->lstMonthlyRentAmount();
$UnitCounter = $objSSSMonthlyRentAmount->totalRecords();
//$MonthlyRentDetail = $objSSSMonthlyRentAmount->dbFetchArray(1);
$UnitListDetail = '';
$RA=0;
while($MonthlyRentAmount = $objSSSMonthlyRentAmount->dbFetchArray(1)){
	$RA++;				
$objPropertyBundle->resetProperty();
$objPropertyBundle->setProperty("property_id", $MonthlyRentAmount["property_id"]);
$objPropertyBundle->lstPropertyBundle();
$GetPropertyDetail = $objPropertyBundle->dbFetchArray(1);
					
if($UnitCounter <= 10){
$UnitListDetail .= '<tr>
			  <td align="center">'.$GetPropertyDetail["block_name"].'/'.$GetPropertyDetail["building_no"].'/'.$GetPropertyDetail["floor_name"].'/'.sprintf("%03d", $GetPropertyDetail["property_number"]).'</td>
			  <td align="center">'.$GetPropertyDetail["property_code"].'</td>
			</tr>';
} elseif($UnitCounter > 10 && $RA <= 10){
/*$UnitListDetail .= '<tr>
			  <td align="center">'.$GetPropertyDetail["block_name"].'/'.$GetPropertyDetail["building_no"].'/'.$GetPropertyDetail["floor_name"].'/'.sprintf("%03d", $GetPropertyDetail["property_number"]).'</td>
			  <td align="center">'.$GetPropertyDetail["property_code"].'</td>
			  <td align="center">Rs.'.$MonthlyRentAmount["total_amount"].'</td>
			  <td align="center">Rs.'.ArrearsAmount($MonthlyRentAmount["arrears_amount"]).'</td>
			</tr>';*/
$UnitListDetail .= '<tr>
			  <td align="center">'.$GetPropertyDetail["block_name"].'/'.$GetPropertyDetail["building_no"].'/'.$GetPropertyDetail["floor_name"].'/'.sprintf("%03d", $GetPropertyDetail["property_number"]).'</td>
			  <td align="center">'.$GetPropertyDetail["property_code"].'</td>
			</tr>';
} else {
$UnitListDetail .= '';	
}
}
if($UnitCounter > 10){
$UnitListDetail .= '<tr>
                      <td colspan="2" align="center"><small style="color:#ff0000;">For more detail or list pleast contact us.</small></td>
                    </tr>';
}else {
$UnitListDetail .= '';	
}


$objSSSTenantInfo->resetProperty();
$objSSSTenantInfo->setProperty("tenant_id", $MonthlyRentDetail["tenant_id"]);
$objSSSTenantInfo->lstTenantInformation();
$TenantInfoDetail = $objSSSTenantInfo->dbFetchArray(1);

$objEmployeeGet->resetProperty();
$objEmployeeGet->setProperty("block_id", $ListOfBlocks["block_id"]);
$objEmployeeGet->lstAssignToEmployeeProperty();
$AssignEmployeeName = $objEmployeeGet->dbFetchArray(1);

if($MonthlyRentDetail["extra_amount_id"] != ''){
$objSSSExtraCharges->resetProperty();
$objSSSExtraCharges->setProperty("isActive", 1);
$objSSSExtraCharges->setProperty("extra_charges_id", $MonthlyRentDetail["extra_amount_id"]);
$objSSSExtraCharges->lstTenantExtraCharges();
if($objSSSExtraCharges->totalRecords() > 0){
$GetExtraChargesRq = $objSSSExtraCharges->dbFetchArray(1);
$ThisTenantExtraCharges = $GetExtraChargesRq["extra_charges"];
$ExtraChargesTHSection = '<th align="center" valign="top">'.$GetExtraChargesRq["extra_title"].'</th>';
$ExtraChargesTDSection = '<td align="center" valign="top">Rs.'.$GetExtraChargesRq["extra_charges"].'</td>';
$ExtraChargesAmountOnly = $GetExtraChargesRq["extra_charges"];
} else {
$ExtraChargesTHSection = '';
$ExtraChargesTDSection = '';
$ExtraChargesAmountOnly = 0;
}
} else {
$ExtraChargesTHSection = '';
$ExtraChargesTDSection = '';
$ExtraChargesAmountOnly = 0;
}

/**/
if($MonthlyRentDetail["installment_status"] == 1){
	$objSSSInstallmentPlan->resetProperty();
	$objSSSInstallmentPlan->setProperty("tenant_id", $MonthlyRentDetail['tenant_id']);
	$objSSSInstallmentPlan->setProperty("tenant_installment_id", $MonthlyRentDetail['installment_id']);
	$objSSSInstallmentPlan->lstInstallmentPlan();
	$InstallmentPlanDetail = $objSSSInstallmentPlan->dbFetchArray(1);

	$InstallmentStatus = 'Yes';	
	$WriteInInstallmentTableVal = '';
	$DiscountApply = YesNo($InstallmentPlanDetail["discount_apply"]);
	$TotalNoOfInstallement = $InstallmentPlanDetail["no_of_installment"];
	$TotalRemainingAmount = $InstallmentPlanDetail["pending_amount"];
} else {
	$InstallmentStatus = 'No';	
	$WriteInInstallmentTableVal = 'NULL';
	$TotalRemainingAmount = 0;
	$DiscountApply = 'NULL';
	$TotalNoOfInstallement = 'NULL';
}
/**/
$objQayaduser->resetProperty();
$GetEmployeeName = $objQayaduser->GetUserFullName($AssignEmployeeName["employee_id"]);

if($MonthlyRentDetail["rent_of_month"] == 12 && $MonthlyRentDetail["rent_year"] == 2022){
	$PrintBillHeaderMonth = 'December';	
	//$PrintBillHeaderMonth = date('F', mktime(0, 0, 0, $MonthlyRentDetail["rent_of_month"], 10));
} else {
	$PrintBillHeaderMonth = date('F', mktime(0, 0, 0, $MonthlyRentDetail["rent_of_month"], 10));
}

$CurrentBillAmountOnly = $MonthlyRentDetail["total_rent_amount"] - $MonthlyRentDetail["arrears_rent"] - $ExtraChargesAmountOnly - $TotalRemainingAmount;

$GenHTML .= '<table width="100%" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td valign="top" style="border-right:dotted 1px #666666;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:solid 1px #999999;">
              <tr>
                <td width="23%" rowspan="5" align="center" style="border-right:solid 1px #999999;"><img src="assets/img/company-logo.png" alt="" style="max-height:80px;" /></td>
                <td width="77%" class="Copy_text">Office Copy</td>
              </tr>
              <tr>
                <td align="center" class="CompanyLogoText">WALLAYAT COMPLEX</td>
              </tr>
              <tr>
                <td class="CompanyAddress">Plaza - 142, Wallayat Complex, Phase 7, Bahria Town, Rawalpindi.</td>
              </tr>
              <tr>
                <td class="MonthlyBillText">Monthly Maintenance Bill</td>
              </tr>
              <tr>
                <td align="center" class="BillMonth">Bill Month : '.$PrintBillHeaderMonth.'</td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="1" class="TopMargin10">
              <tr>
                <td><table width="100%" class="Three_tab_Border" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="40%"> &nbsp; Serial No: </th>
                      <td width="60%" align="center">'.$MonthlyRentDetail["bill_no"].'</td>
                    </tr>
                  </table></td>
                <td><table width="100%" class="Three_tab_Border" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="50%">Issue Date:</th>
                      <td width="50%" align="center">01-'.MonthList($MonthlyRentDetail["rent_of_month"]).'-'.$MonthlyRentDetail["rent_year"].'</td>
                    </tr>
                  </table></td>
                <td><table width="100%" class="Three_tab_Border" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="50%">Due Date:</th>
                      <td width="50%" align="center">'.date('d-M-Y',strtotime($MonthlyRentDetail["due_date"])).'</td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="1" class="TopMargin10">
              <tr>
                <td><table width="100%" class="Three_tab_Border" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="40%">&nbsp;&nbsp;Tenant Code: </th>
                      <td width="60%">&nbsp;'.$TenantInfoDetail["tenant_code"].'</td>
                    </tr>
                  </table></td>
                <td><table width="100%" class="Three_tab_Border" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="40%">&nbsp;&nbsp;No of Units: </th>
                      <td width="60%">&nbsp;'.$UnitCounter.'</td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="1" class="TopMargin10">
              <tr>
                <td><table width="100%" class="Three_tab_Border" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="20%"> &nbsp; Name: </th>
                      <td width="80%">&nbsp;'.ucfirst($TenantInfoDetail["tenant_name"]).'</td>
                    </tr>
                  </table></td>
                <td><table width="100%" class="Three_tab_Border" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="40%">&nbsp;&nbsp;Shop Name: </th>
                      <td width="60%">&nbsp;'.ucfirst($TenantInfoDetail["tenant_shop_name"]).'</td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TopMargin10">
              <tr>
                <td width="60%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="FullBorderTable">
                    <tr>
                      <th width="25%">B/P/F/U</th>
                      <th width="27%">Property Code</th>
                    </tr>
                    ';					$GenHTML .= $UnitListDetail;     $GenHTML .= '
                    <tr>
                      <td colspan="2" align="center"><strong>B/P/F/U</strong> (Building/Plaza No/Floor/Unit No)</td>
                    </tr>
                  </table></td>
                <td width="40%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="FullBorderTable">
                    <tr>
                      <th width="25%">Month</th>
                      <th width="27%">Bill</th>
                      <th width="24%">Paid</th>
                      <th width="24%">Balance</th>
                    </tr>
                    ';								for ($count = 0; $count <= 11; $count++) {										$objOldPaymentRec->resetProperty();					$objOldPaymentRec->setProperty("tenant_id", $MonthlyRentDetail["tenant_id"]);
					$objOldPaymentRec->setProperty("isAcitve", 1);					$objOldPaymentRec->setProperty("rent_of_month", date('m', strtotime($currentMonth.' + '.$count.' Months')));					$objOldPaymentRec->setProperty("rent_year", date('Y', strtotime($currentMonth.' + '.$count.' Months')));					$objOldPaymentRec->lstMonthlyRent();					$GetOldPaymentRecord = $objOldPaymentRec->dbFetchArray(1);     $GenHTML .= '
                    <tr>
                      <td align="center">'.date('M-y', strtotime($currentMonth.' + '.$count.' Months')).'</td>
                      <td align="center">'.ArrearsAmount($GetOldPaymentRecord["total_rent_amount"] - $GetOldPaymentRecord["arrears_rent"]).'</td>
                      <td align="center">'.ArrearsAmount($GetOldPaymentRecord["received_amount"]).'</td>
                      <td align="center">'.ArrearsAmount($GetOldPaymentRecord["total_rent_amount"] - $GetOldPaymentRecord["received_amount"] - $GetOldPaymentRecord["arrears_rent"]).'</td>
                    </tr>
                    ';				}      $GenHTML .= '
                  </table></td>
              </tr>
            </table><br>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TopMargin10 FullBorderTable">
              <tr>';
$GenHTML .= $ExtraChargesTHSection;
$GenHTML .= '<th align="center" valign="top">Arrear</th>
                <th align="center" valign="top">Current Bill</th>
                <th align="center" valign="top">Paid</th>
                <th align="center" valign="top">Total</th>
              </tr>
              <tr>';
$GenHTML .=  $ExtraChargesTDSection;
$GenHTML .= '<td align="center" valign="top">Rs.'.ArrearsAmount($MonthlyRentDetail["arrears_rent"]).'</td>
                <td align="center" valign="top">Rs.'.ArrearsAmount($CurrentBillAmountOnly).'</td>
                <td align="center" valign="top">Rs.'.ArrearsAmount($MonthlyRentDetail["received_amount"]).'</td>
                <td align="center" valign="top">Rs.'.ArrearsAmount($MonthlyRentDetail["total_rent_amount"]).'</td>
              </tr>
            </table>';
			if($MonthlyRentDetail["installment_status"]==1){
$GenHTML .= '<br />
            <h4>Installment Overview</h4>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TopMargin10 FullBorderTable">
              <tr>
                <th width="25%" align="center" valign="top">Outstanding Amount</th>
                <th width="17%" align="center" valign="top">Discount</th>
                <th width="22%" align="center" valign="top">Final Amount</th>
                <th width="18%" align="center" valign="top">No. of Installemt</th>
                <th width="18%" align="center" valign="top">Monthly</th>
              </tr>
              <tr>
                <td align="center" valign="top">'.$TotalRemainingAmount.'</td>
                <td align="center" valign="top">'.$DiscountApply.'</td>
                <td align="center" valign="top">'.$TotalRemainingAmount.'</td>
                <td align="center" valign="top">'.$TotalNoOfInstallement.'</td>
                <td align="center" valign="top">'.$MonthlyRentDetail["installment_amount"].'</td>
              </tr>
            </table>
            <br />';
			} else {
$GenHTML .= '<br /><br />';
			}
$GenHTML .= '<table width="100%" border="0" cellspacing="0" cellpadding="1" class="TopMargin10">
              <tr>
                <td width="50%"><table width="100%" class="Three_tab_Border" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="57%"style="font-size:13px;">&nbsp;Arrears: </th>
                      <td width="43%" align="center"style="font-size:13px;">Rs.'.ArrearsAmount($MonthlyRentDetail["arrears_rent"]).'</td>
                    </tr>
                  </table></td>
                <td><table width="100%" class="Three_tab_Border" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="40%"style="font-size:13px;">&nbsp;Area Assign: </th>
                      <td width="60%" align="center"style="font-size:13px;">'.$GetEmployeeName.'</td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="1" class="TopMargin10">
              <tr>
                <td width="50%"><table width="100%" class="Three_tab_Border" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="57%" style="font-size:13px;">&nbsp;Within due date: </th>
                      <td width="43%" align="center"style="font-size:13px;">Rs.'.ArrearsAmount($MonthlyRentDetail["total_rent_amount"]).'</td>
                    </tr>
                  </table></td>
                <td width="50%"><table width="100%" class="Three_tab_Border" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="56%"style="font-size:13px;">&nbsp;After due date:</th>
                      <td width="44%" align="center"style="font-size:13px;">Rs.'.ArrearsAmount($MonthlyRentDetail["total_rent_amount"] + 250 * $UnitCounter).'</td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="assets/img/note_text.png" style="width:100%; height:auto;"></td>
              </tr>
            </table>
            <p style="border-top:dotted 1px #000000; text-align:center; width:100%">This is a computer generated bill and does not require any  signature. Any discrepancy is subject to adjustment.<br />
            </p></td>
        </tr>
      </table></td>
    <td align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:solid 1px #999999;">
              <tr>
                <td width="23%" rowspan="5" align="center" style="border-right:solid 1px #999999;"><img src="assets/img/company-logo.png" alt="" style="max-height:80px;" /></td>
                <td width="77%" class="Copy_text">Customer Copy</td>
              </tr>
              <tr>
                <td align="center" class="CompanyLogoText">WALLAYAT COMPLEX</td>
              </tr>
              <tr>
                <td class="CompanyAddress">Plaza - 142, Wallayat Complex, Phase 7, Bahria Town, Rawalpindi.</td>
              </tr>
              <tr>
                <td class="MonthlyBillText">Monthly Maintenance Bill</td>
              </tr>
              <tr>
                <td align="center" class="BillMonth">Bill Month : '.$PrintBillHeaderMonth.'</td>
              </tr>
            </table>
             <table width="100%" border="0" cellspacing="0" cellpadding="1" class="TopMargin10">
              <tr>
                <td><table width="100%" class="Three_tab_Border" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="40%"> &nbsp; Serial No: </th>
                      <td width="60%" align="center">'.$MonthlyRentDetail["bill_no"].'</td>
                    </tr>
                  </table></td>
                <td><table width="100%" class="Three_tab_Border" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="50%">Issue Date:</th>
                      <td width="50%" align="center">01-'.MonthList($MonthlyRentDetail["rent_of_month"]).'-'.$MonthlyRentDetail["rent_year"].'</td>
                    </tr>
                  </table></td>
                <td><table width="100%" class="Three_tab_Border" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="50%">Due Date:</th>
                      <td width="50%" align="center">'.date('d-M-Y',strtotime($MonthlyRentDetail["due_date"])).'</td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="1" class="TopMargin10">
              <tr>
                <td><table width="100%" class="Three_tab_Border" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="40%">&nbsp;&nbsp;Tenant Code: </th>
                      <td width="60%">&nbsp;'.$TenantInfoDetail["tenant_code"].'</td>
                    </tr>
                  </table></td>
                <td><table width="100%" class="Three_tab_Border" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="40%">&nbsp;&nbsp;No of Units: </th>
                      <td width="60%">&nbsp;'.$UnitCounter.'</td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="1" class="TopMargin10">
              <tr>
                <td><table width="100%" class="Three_tab_Border" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="20%"> &nbsp; Name: </th>
                      <td width="80%">&nbsp;'.ucfirst($TenantInfoDetail["tenant_name"]).'</td>
                    </tr>
                  </table></td>
                <td><table width="100%" class="Three_tab_Border" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="40%">&nbsp;&nbsp;Shop Name: </th>
                      <td width="60%">&nbsp;'.ucfirst($TenantInfoDetail["tenant_shop_name"]).'</td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TopMargin10">
              <tr>
                <td width="60%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="FullBorderTable">
                    <tr>
                      <th width="25%">B/P/F/U</th>
                      <th width="27%">Property Code</th>
                    </tr>
                    ';	$GenHTML .= $UnitListDetail;     $GenHTML .= '
                    <tr>
                      <td colspan="2" align="center"><strong>B/P/F/U</strong> (Building/Plaza No/Floor/Unit No)</td>
                    </tr>
                  </table></td>
                <td width="40%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="FullBorderTable">
                    <tr>
                      <th width="25%">Month</th>
                      <th width="27%">Bill</th>
                      <th width="24%">Paid</th>
                      <th width="24%">Balance</th>
                    </tr>
                    ';								for ($count = 0; $count <= 11; $count++) {										$objOldPaymentRec->resetProperty();					$objOldPaymentRec->setProperty("tenant_id", $MonthlyRentDetail["tenant_id"]);
					$objOldPaymentRec->setProperty("isAcitve", 1);					$objOldPaymentRec->setProperty("rent_of_month", date('m', strtotime($currentMonth.' + '.$count.' Months')));					$objOldPaymentRec->setProperty("rent_year", date('Y', strtotime($currentMonth.' + '.$count.' Months')));					$objOldPaymentRec->lstMonthlyRent();					$GetOldPaymentRecord = $objOldPaymentRec->dbFetchArray(1);     $GenHTML .= '
                    <tr>
                      <td align="center">'.date('M-y', strtotime($currentMonth.' + '.$count.' Months')).'</td>
                      <td align="center">'.ArrearsAmount($GetOldPaymentRecord["total_rent_amount"] - $GetOldPaymentRecord["arrears_rent"]).'</td>
                      <td align="center">'.ArrearsAmount($GetOldPaymentRecord["received_amount"]).'</td>
                      <td align="center">'.ArrearsAmount($GetOldPaymentRecord["total_rent_amount"] - $GetOldPaymentRecord["received_amount"] - $GetOldPaymentRecord["arrears_rent"]).'</td>
                    </tr>
                    ';				}      $GenHTML .= '
                  </table></td>
              </tr>
            </table><br>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TopMargin10 FullBorderTable">
              <tr>';
$GenHTML .= $ExtraChargesTHSection;
$GenHTML .= '<th align="center" valign="top">Arrear</th>
                <th align="center" valign="top">Current Bill</th>
                <th align="center" valign="top">Paid</th>
                <th align="center" valign="top">Total</th>
              </tr>
              <tr>';
$GenHTML .=  $ExtraChargesTDSection;
$GenHTML .= '<td align="center" valign="top">Rs.'.ArrearsAmount($MonthlyRentDetail["arrears_rent"]).'</td>
                <td align="center" valign="top">Rs.'.ArrearsAmount($CurrentBillAmountOnly).'</td>
                <td align="center" valign="top">Rs.'.ArrearsAmount($MonthlyRentDetail["received_amount"]).'</td>
                <td align="center" valign="top">Rs.'.ArrearsAmount($MonthlyRentDetail["total_rent_amount"]).'</td>
              </tr>
            </table>';
			if($MonthlyRentDetail["installment_status"]==1){
$GenHTML .= '<br />
            <h4>Installment Overview</h4>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TopMargin10 FullBorderTable">
              <tr>
                <th width="25%" align="center" valign="top">Outstanding Amount</th>
                <th width="17%" align="center" valign="top">Discount</th>
                <th width="22%" align="center" valign="top">Final Amount</th>
                <th width="18%" align="center" valign="top">No. of Installemt</th>
                <th width="18%" align="center" valign="top">Monthly</th>
              </tr>
              <tr>
                <td align="center" valign="top">'.$TotalRemainingAmount.'</td>
                <td align="center" valign="top">'.$DiscountApply.'</td>
                <td align="center" valign="top">'.$TotalRemainingAmount.'</td>
                <td align="center" valign="top">'.$TotalNoOfInstallement.'</td>
                <td align="center" valign="top">'.$MonthlyRentDetail["installment_amount"].'</td>
              </tr>
            </table>
            <br />';
			} else {
$GenHTML .= '<br /><br />';
			}
$GenHTML .= '<table width="100%" border="0" cellspacing="0" cellpadding="1" class="TopMargin10">
              <tr>
                <td width="50%"><table width="100%" class="Three_tab_Border" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="57%"style="font-size:13px;">&nbsp;Arrears: </th>
                      <td width="43%" align="center"style="font-size:13px;">Rs.'.ArrearsAmount($MonthlyRentDetail["arrears_rent"]).'</td>
                    </tr>
                  </table></td>
                <td><table width="100%" class="Three_tab_Border" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="40%"style="font-size:13px;">&nbsp;Area Assign: </th>
                      <td width="60%" align="center"style="font-size:13px;">'.$GetEmployeeName.'</td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="1" class="TopMargin10">
              <tr>
                <td width="50%"><table width="100%" class="Three_tab_Border" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="57%" style="font-size:13px;">&nbsp;Within due date: </th>
                      <td width="43%" align="center"style="font-size:13px;">Rs.'.ArrearsAmount($MonthlyRentDetail["total_rent_amount"]).'</td>
                    </tr>
                  </table></td>
                <td width="50%"><table width="100%" class="Three_tab_Border" cellspacing="0" cellpadding="0">
                    <tr>
                      <th width="56%"style="font-size:13px;">&nbsp;After due date:</th>
                      <td width="44%" align="center"style="font-size:13px;">Rs.'.ArrearsAmount($MonthlyRentDetail["total_rent_amount"] + 250 * $UnitCounter).'</td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="assets/img/note_text.png" style="width:100%; height:auto;"></td>
              </tr>
            </table>
            <p style="border-top:dotted 1px #000000; text-align:center; width:100%">This is a computer generated bill and does not require any  signature. Any discrepancy is subject to adjustment.<br />
            </p></td>
        </tr>
      </table></td>
  </tr>
</table>
<div class="pagebrea"></div>';




$UnitListDetail = '';
}
$FooterArea = '</body></html>';
$GenHTML .= $FooterArea;
//echo $GenHTML;
file_put_contents('monthly_bill_gen/'.$GetBillRequest["generate_bill_id"].'__'.$ListOfBlocks["block_id"].'.html', $GenHTML);
//file_put_contents('monthly_bill_gen/testing_new.html', $GenHTML);
$GenHTML = '';


}
/***************************************************************************************************/
/***************************************************************************************************/
/***************************************************************************************************/
/**/$objSSSMonthlyBUp->resetProperty();
/**/$objSSSMonthlyBUp->setProperty("generate_bill_id", $GetBillRequest["generate_bill_id"]);
/**/$objSSSMonthlyBUp->setProperty("process_status", 1);
/**/$objSSSMonthlyBUp->actGenMonthlyBill('U');
/***************************************************************************************************/
/***************************************************************************************************/
/***************************************************************************************************/
}
?>
