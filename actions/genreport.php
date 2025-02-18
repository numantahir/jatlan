<?php
$GetTypeofReport = trim(DecData($_GET["gen"], 1, $objBF));
$GetTypeName = trim(DecData($_GET["i"], 1, $objBF));

if($GetTypeofReport == "Company"){
$objQayaduser->resetProperty();
$objQayaduser->setProperty("isActive", 1);
$objQayaduser->setProperty("company_id", $GetTypeName);
$objQayaduser->lstCompanies();
$CompanyName = $objQayaduser->dbFetchArray(1);

$PageTitle = $CompanyName["company_name"].' - '.$GetTypeofReport. ' Employee Report <code>[Date Range: '.dateFormate_3(REPORT_START_DATE).' <-> '.dateFormate_3(REPORT_END_DATE).']</code>';
}
?>