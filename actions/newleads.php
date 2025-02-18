<?php
if(trim(DecData($_GET["mode"], 1, $objBF)) == 'Hot' && trim(DecData($_GET["li"], 1, $objBF)) != ''){
$objQayaduser->resetProperty();
$objQayaduser->setProperty("leads_id", trim(DecData($_GET["li"], 1, $objBF)));
$objQayaduser->setProperty("rm_lead_status", 2);
$objQayaduser->setProperty("rm_action_datetime", date('Y-m-d H:i:s'));
$objQayaduser->actLeads('U');
$objCommon->setMessage(_LEAD_STATUS_HOT_CHANGE_SUCCESSFULLY, 'Info');
$link = Route::_('show=newleads');
redirect($link);
}
if(trim(DecData($_GET["mode"], 1, $objBF)) == 'Cold' && trim(DecData($_GET["li"], 1, $objBF)) != ''){
$objQayaduser->resetProperty();
$objQayaduser->setProperty("leads_id", trim(DecData($_GET["li"], 1, $objBF)));
$objQayaduser->setProperty("rm_lead_status", 3);
$objQayaduser->setProperty("rm_action_datetime", date('Y-m-d H:i:s'));
$objQayaduser->actLeads('U');
$objCommon->setMessage(_LEAD_STATUS_COLD_CHANGE_SUCCESSFULLY, 'Info');
$link = Route::_('show=newleads');
redirect($link);
}
?>