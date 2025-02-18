<?php
$RequestedOrderId = trim($objBF->decrypt($_GET["i"], 1, ENCRYPTION_KEY));
$objSSSDestination = new SSSjatlan;
$objSSSCustomers = new SSSjatlan;
$objSSSProducts = new SSSjatlan;
$objSSSVehicleType = new SSSjatlan;
$objSSSOrderCounter = new SSSjatlan;

$objSSSjatlan->resetProperty();
$objSSSjatlan->setProperty("order_id", $RequestedOrderId);
$objSSSjatlan->setProperty("isActive", 1);
$objSSSjatlan->lstOrders();
$OrderProcess = $objSSSjatlan->dbFetchArray(1);

$objSSSCustomers->resetProperty();
$objSSSCustomers->setProperty("vehicle_id", $OrderProcess["vechile_id"]);
$objSSSCustomers->lstVehicle();
$VehicleNumber = $objSSSCustomers->dbFetchArray(1);

$objSSSVehicleType->resetProperty();
$objSSSVehicleType->setProperty("driver_id", $OrderProcess["driver_id"]);
$objSSSVehicleType->setProperty("isActive", 1);
$objSSSVehicleType->lstVehicleAssignDriver();
$DriverDetail = $objSSSVehicleType->dbFetchArray(1);

$objSSSDestination->resetProperty();
$objSSSDestination->setProperty("location_id", $OrderRequest["destination_id"]);
$objSSSDestination->lstLocation();
$DestinationInfo = $objSSSDestination->dbFetchArray(1);

$objSSSOrderCounter->resetProperty();
$objSSSOrderCounter->setProperty("order_id", $OrderProcess["order_id"]);
$objSSSOrderCounter->setProperty("isActive", 1);
$objSSSOrderCounter->setProperty("order_status", 2);
$objSSSOrderCounter->lstOrderDetail();
$TotalNoOfOrders = $objSSSOrderCounter->totalRecords();
?>