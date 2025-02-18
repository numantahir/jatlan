<script type="text/javascript">
 var SITE_URL = "<?php echo SITE_URL;?>";
 $(document).ready(function() {
	 
	 
	jQuery.fn.preventDoubleSubmission = function() {
	  $(this).on('submit',function(e){
		var $form = $(this);
	
		if ($form.data('submitted') === true) {
		  // Previously submitted - don't submit again
		  e.preventDefault();
		} else {
		  // Mark it so that the next submit can be ignored
		  $form.data('submitted', true);
		}
	  });
	
	  // Keep chainability
	  return this;
	};

	 $('#TypeValidation').preventDoubleSubmission();
	 
	
	 $('#destination_id').change(function(){
		var GetUnloading = $(this).find("option:selected").data("unloading");
		var GetDeliver = $(this).find("option:selected").data("deliver");
		$("#unloading_price").val(GetUnloading);
		$("#delivery_chagres").val(GetDeliver);
	});
	
	
	 $('#itemselection').change(function(){
		var Getselling_price = $(this).find("option:selected").data("selling");
		$("#selling_price").val(Getselling_price);
		$("#to_selling_price").val(Getselling_price);
	});
	
	$('#selectpurchaseorder').change(function(){
		var Getselling_price = $(this).find("option:selected").data("selling");
		$("#selling_price").val(Getselling_price);
		$("#to_selling_price").val(Getselling_price);
		
		var GetRemainingQty = $(this).find("option:selected").data("remaining");
		$("#no_of_items").attr({
		   "max" : GetRemainingQty,
		   "min" : 1
		});
	});
	
	$('.calculate_item_price_mod').load('input', function() {
		var GetSellingPrice = $("#selling_price").val();
		var GetNoOfQuantity = $(".item_no_of_item").val();
		var GetDeliveryCharges = $("#delivery_chagres").val();
		var GetUnloadingCharges = $("#unloading_price").val();
		
		var FinalAmount = GetSellingPrice * GetNoOfQuantity;
		var FinalDeliveryCharges = GetDeliveryCharges  * GetNoOfQuantity;
		var FinalUnloadingCharges = GetUnloadingCharges  * GetNoOfQuantity;
		var SumAllAmount = parseInt(FinalAmount) + parseInt(FinalDeliveryCharges) + parseInt(FinalUnloadingCharges);
		$("#final_amount").val(SumAllAmount);
	});

	$('.calculate_item_price').on('input', function() {
		var GetSellingPrice = $("#selling_price").val();
		var GetNoOfQuantity = $(".item_no_of_item").val();
		var GetDeliveryCharges = $("#delivery_chagres").val();
		var GetUnloadingCharges = $("#unloading_price").val();
		
		var FinalAmount = GetSellingPrice * GetNoOfQuantity;
		var FinalDeliveryCharges = GetDeliveryCharges  * GetNoOfQuantity;
		var FinalUnloadingCharges = GetUnloadingCharges  * GetNoOfQuantity;
		var SumAllAmount = parseInt(FinalAmount) + parseInt(FinalDeliveryCharges) + parseInt(FinalUnloadingCharges);
		$("#final_amount").val(SumAllAmount);
	});
	
	$('.contra_calculate_item_price').on('input', function() {
		var GetSellingPrice = $("#selling_price").val();
		var GEtToSellingPrice = $("#to_selling_price").val();
		var GetNoOfQuantity = $(".item_no_of_item").val();
		var GetDeliveryCharges = $("#delivery_chagres").val();
		var GetUnloadingCharges = $("#unloading_price").val();
		
		var ToFinalAmount = GetSellingPrice * GetNoOfQuantity;
		var FromFinalAmount = GEtToSellingPrice * GetNoOfQuantity;
		var FinalDeliveryCharges = GetDeliveryCharges;
		var FinalUnloadingCharges = GetUnloadingCharges;
		var ToSumAllAmount = parseInt(ToFinalAmount) + parseInt(FinalDeliveryCharges) + parseInt(FinalUnloadingCharges);
		var FromSumAllAmount = parseInt(FromFinalAmount) + parseInt(FinalDeliveryCharges) + parseInt(FinalUnloadingCharges);
		$("#final_amount").val(ToSumAllAmount);
		$("#to_final_amount").val(FromSumAllAmount);
	});
	
	$('.outside_order_qty').on('input', function() {
		var GetNoOfQuantity = $(".item_no_of_item").val();
		var GetDeliveryCharges = $("#delivery_chagres").val();
		
		var FinalAmount = GetNoOfQuantity * GetDeliveryCharges;
		//var SumAllAmount = parseInt(FinalAmount) + parseInt(FinalDeliveryCharges) + parseInt(FinalUnloadingCharges);
		$("#final_amount").val(FinalAmount);
	});
	
	$(".transferamountfrom").click(function() {
    if($(this).is(":checked")) {
        $("#supplyorder_customer").show('slow');
    } else {
        $("#supplyorder_customer").hide('slow');
    }
	});

	$('#op_vehicle_selection').change(function(){
		
		var op_number = $(this).find("option:selected").data("number");
		var op_name = $(this).find("option:selected").data("name");
		var op_type = $(this).find("option:selected").data("type");
		var op_capacity = $(this).find("option:selected").data("capacity");
		var op_driver = $(this).find("option:selected").data("driver");
		var op_source = $(this).find("option:selected").data("source");
		var op_driver_id = $(this).find("option:selected").data("did");
		
		$("#op_number").val(op_number);
		$("#op_name").val(op_name);
		$("#op_type").val(op_type);
		$("#op_capacity").val(op_capacity);
		$("#op_driver").val(op_driver);
		$("#op_source").val(op_source);
		$("#op_driver_id").val(op_driver_id);
	});
	
	$('.order_rq_c').click(function(){
		
		var t_cap = $("#t_cap").val();
		
    	var newcapval = 0;
		$('.order_rq_c').filter(":checked").each(function () {
        	newcapval += +$(this).data('capacity');
   		});
		
		if(newcapval > t_cap){
		$("#overcaperror").show('slow');
		} else {
		$("#overcaperror").hide('slow');
		}
	});
	
	//$(window).load(function(){
	$("#jointaplic_section").hide();
	$(".proertyarea").hide();
	$(".proertysection").hide();
	$(".row_property_area").hide();
	<?php if($_GET['show']=='installmentform'){?>
	$("#discount_apply").change(function () {
		var GetMainPendingAmount = $("#total_pending_amount").val();
		if($(this).val() == 1){
		$("#discount_opt_yes").show(500);
		$("#discount_value").prop('required',true);
		$("#pending_amount").val(0);
		} else {
		$("#discount_opt_yes").hide();
		$("#discount_value").prop('required',false);
		$("#pending_amount").val(GetMainPendingAmount);
		}
		var GetFinalPendingAmount = $("#pending_amount").val();
		var GetNoofInstallment = $("#no_of_installment").val();
		var MonthlyInstallmentAmount = GetFinalPendingAmount / GetNoofInstallment;
		$("#installment_amount").val(MonthlyInstallmentAmount.toFixed(2));
	});	
	//
	$("#discount_value").change(function () {
		var GetMainPendingAmount = $("#total_pending_amount").val();
		var GetDiscountType = $("#discount_type").val();
		var GetDiscountValue = $("#discount_value").val();
		if(GetDiscountType == 1){
		
		var getpercentagevalue = GetMainPendingAmount * GetDiscountValue / 100;
		var getremainingAmount = GetMainPendingAmount - getpercentagevalue;
		$("#pending_amount").val(getremainingAmount);
		} else {
		var getremainingAmount = GetMainPendingAmount - GetDiscountValue;
		$("#pending_amount").val(getremainingAmount);
			
		}
		var GetFinalPendingAmount = $("#pending_amount").val();
		var GetNoofInstallment = $("#no_of_installment").val();
		var MonthlyInstallmentAmount = GetFinalPendingAmount / GetNoofInstallment;
		$("#installment_amount").val(MonthlyInstallmentAmount.toFixed(2));
	});	
	$("#no_of_installment").change(function () {
		var GetFinalPendingAmount = $("#pending_amount").val();
		var GetNoofInstallment = $("#no_of_installment").val();
		var MonthlyInstallmentAmount = GetFinalPendingAmount / GetNoofInstallment;
		$("#installment_amount").val(MonthlyInstallmentAmount.toFixed(2));
	});	
	<?php } if($_GET['show']=='newappreg'){?>
	$(".row_property_section").hide();
	$(".row_property_floor").hide();
	<?php } if($_GET['show']=='propertyform' && $mode=='I'){?>
	$(".row_property_section").hide();
	$(".row_property_floor").hide();
	<?php }elseif($_GET['show']=='propertyform' && $mode=='U'){?>
	$(".propertyfloor").hide();
	$(".propertysection").hide();
	$(".row_property_section").show();
	$(".row_property_floor").show();
	$(".floor-num-" + <?php echo $property_registered_id;?>).show();
	$(".sectionradio-<?php echo $propety_floor_id.'-'.$property_registered_id;?>").show();
	<?php } ?>
	<?php if($_GET['show']=='unitlockedform' && $mode=='I'){?>
	$(".row_property_section").hide();
	$(".row_property_floor").hide();
	<?php } ?>
	demo.initFormExtendedDatetimepickers();
	<?php //echo $objCommon->displayMessage_js();
	$GetReturnmessage = $objCommon->displayMessage_Test();
	if($GetReturnmessage!=''){
		list($MegPas,$ModePas)= explode('---',$GetReturnmessage);
			echo "demo.showNotification('top','right', '".$ModePas."', '".$MegPas."');";
	} else {
	
	}
	 ?>
	 
	//speak('div.comment');
		<?php if($joint_aplic_opt==1){ ?>
			$("#jointaplic_section").show("slow");

			$(".jointaplic").prop('required',true);

		<?php } ?>

	<?php if($_GET['show']=='transrecpay'){?>
	$("#aplic_dp").hide();
	$("#aplic_mode").change(function () {
		if($(this).val() == 1){
			$("#aplic_dp").show('slow');
			$("#aplic_instalment").hide('slow');
		} else if($(this).val() == 2){
			$("#aplic_dp").hide('slow');
			$("#aplic_instalment").show('slow');
		}
	});
	
	$('#head_id').change(function(){
       <?php if($GetAPMId == 1){?>
	   $("#loadingresp").show('slow');
        var GetAplicId = $("#head_id").val();
	    $.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_1', 1, $objBF);?>" }
        })
        .done(function(data){
			if(data == 0){
			alert( "Ooppsss.... Are you sure....?" );
			} else {
			$("#loadingresp").hide('slow');
            $('#loadingdate').html(data);
			$("#otherfields").show('slow');
			$('#token_transfer_head_id').selectpicker('refresh');
			$(".material-datatables").css('background-image', 'none');
			$(".material-datatables").css('min-height', 'auto');
			$(".material-datatables").show();
			$(".material-datatables table").show();
			}
        })
        .fail(function() {
            alert( "Ooppsss.... Your Request failed." );
			location.reload();
			return false;
        });
		
		$.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_1_1', 1, $objBF);?>" }
        })
        .done(function(rt_data){
			if(rt_data !=''){
			var RTAjAxVal = jQuery.parseJSON(rt_data);
			$("#trans_title").val(RTAjAxVal.var_customer_name);
			}
        })
        .fail(function() {
			return false;
        });
		
		<?php } if($GetAPMId == 2){?>
		$("#loadingresp").show('slow');
        var GetAplicId = $("#head_id").val();
	    $.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_2', 1, $objBF);?>" }
        })
        .done(function(data){
			if(data == 0){
			alert( "Ooppsss.... Are you sure....?" );
			} else {
			$("#loadingresp").hide('slow');
            $('#loadingdate').html(data);
			$("#otherfields").show('slow');
			$('#token_transfer_head_id').selectpicker('refresh');
			$(".material-datatables").css('background-image', 'none');
			$(".material-datatables").css('min-height', 'auto');
			$(".material-datatables").show();
			$(".material-datatables table").show();
			}
        })
        .fail(function() {
            alert( "Ooppsss.... Your Request failed." );
			location.reload();
			return false;
        });
		
		$.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_2_1', 1, $objBF);?>" }
        })
        .done(function(rt_data){
			if(rt_data !=''){
			var RTAjAxVal = jQuery.parseJSON(rt_data);
			$("#trans_title").val(RTAjAxVal.var_customer_name);
			}
        })
        .fail(function() {
			return false;
        });
		<?php } if($GetAPMId == 3){?>
		$("#otherfields").show('slow');
		<?php } if($GetAPMId == 9){?>
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		$("#loadingresp").show('slow');
        var GetAplicId = $("#head_id").val();
	    $.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_9', 1, $objBF);?>" }
        })
        .done(function(data){
			if(data == 0){
			alert( "Ooppsss.... Are you sure....?" );
			} else {
			$("#loadingresp").hide('slow');
            $('#loadingdate').html(data);
			$("#otherfields").show('slow');
			$('#token_transfer_head_id').selectpicker('refresh');
			$(".material-datatables").css('background-image', 'none');
			$(".material-datatables").css('min-height', 'auto');
			$(".material-datatables").show();
			$(".material-datatables table").show();
			}
        })
        .fail(function() {
            alert( "Ooppsss.... Your Request failed." );
			location.reload();
			return false;
        });
		
		$.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_9_1', 1, $objBF);?>" }
        })
        .done(function(rt_data){
			if(rt_data !=''){
			var RTAjAxVal = jQuery.parseJSON(rt_data);
			$("#trans_title").val(RTAjAxVal.var_customer_name);
			}
        })
        .fail(function() {
			return false;
        });
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		
		<?php } if($GetAPMId == 10){?>
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		$("#loadingresp").show('slow');
        var GetAplicId = $("#head_id").val();
	    $.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_10', 1, $objBF);?>" }
        })
        .done(function(data){
			if(data == 0){
			alert( "Ooppsss.... Are you sure....?" );
			} else {
			$("#loadingresp").hide('slow');
            $('#loadingdate').html(data);
			$("#otherfields").show('slow');
			$('#token_transfer_head_id').selectpicker('refresh');
			$(".material-datatables").css('background-image', 'none');
			$(".material-datatables").css('min-height', 'auto');
			$(".material-datatables").show();
			$(".material-datatables table").show();
			}
        })
        .fail(function() {
            alert( "Ooppsss.... Your Request failed." );
			location.reload();
			return false;
        });
		
		$.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_10_1', 1, $objBF);?>" }
        })
        .done(function(rt_data){
			if(rt_data !=''){
			var RTAjAxVal = jQuery.parseJSON(rt_data);
			$("#trans_title").val(RTAjAxVal.var_customer_name);
			$("#trans_amount").val(RTAjAxVal.var_trans_amount);
			}
        })
        .fail(function() {
			return false;
        });
		/****************************************************************************************************/
		/****************************************************************************************************/
		/****************************************************************************************************/
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		<?php } ?>
		<?php  if($GetAPMId == 14){?>
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		$("#loadingresp").show('slow');
        var GetAplicId = $("#head_id").val();
	    $.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_14', 1, $objBF);?>" }
        })
        .done(function(data){
			if(data == 0){
			alert( "Ooppsss.... Are you sure....?" );
			} else {
			$("#loadingresp").hide('slow');
            $('#loadingdate').html(data);
			$("#otherfields").show('slow');
			$('#token_transfer_head_id').selectpicker('refresh');
			$(".material-datatables").css('background-image', 'none');
			$(".material-datatables").css('min-height', 'auto');
			$(".material-datatables").show();
			$(".material-datatables table").show();
			}
        })
        .fail(function() {
            alert( "Ooppsss.... Your Request failed." );
			location.reload();
			return false;
        });
		
		$.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_14_1', 1, $objBF);?>" }
        })
        .done(function(rt_data){
			if(rt_data !=''){
			var RTAjAxVal = jQuery.parseJSON(rt_data);
			$("#trans_title").val(RTAjAxVal.var_customer_name);
			}
        })
        .fail(function() {
			return false;
        });
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		<?php } ?>
		<?php  if($GetAPMId == 15){?>
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		$("#loadingresp").show('slow');
        var GetAplicId = $("#head_id").val();
	    $.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_15', 1, $objBF);?>" }
        })
        .done(function(data){
			if(data == 0){
			alert( "Ooppsss.... Are you sure....?" );
			} else {
			$("#loadingresp").hide('slow');
            $('#loadingdate').html(data);
			$("#otherfields").show('slow');
			$('#token_transfer_head_id').selectpicker('refresh');
			$(".material-datatables").css('background-image', 'none');
			$(".material-datatables").css('min-height', 'auto');
			$(".material-datatables").show();
			$(".material-datatables table").show();
			}
        })
        .fail(function() {
            alert( "Ooppsss.... Your Request failed." );
			location.reload();
			return false;
        });
		
		$.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_15_1', 1, $objBF);?>" }
        })
        .done(function(rt_data){
			if(rt_data !=''){
			var RTAjAxVal = jQuery.parseJSON(rt_data);
			$("#trans_title").val(RTAjAxVal.var_customer_name);
			}
        })
        .fail(function() {
			return false;
        });
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		<?php } ?>
		<?php  if($GetAPMId == 16){?>
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		$("#loadingresp").show('slow');
        var GetAplicId = $("#head_id").val();
	    $.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_16', 1, $objBF);?>" }
        })
        .done(function(data){
			if(data == 0){
			alert( "Ooppsss.... Are you sure....?" );
			} else {
			$("#loadingresp").hide('slow');
            $('#loadingdate').html(data);
			$("#otherfields").show('slow');
			$('#token_transfer_head_id').selectpicker('refresh');
			$(".material-datatables").css('background-image', 'none');
			$(".material-datatables").css('min-height', 'auto');
			$(".material-datatables").show();
			$(".material-datatables table").show();
			}
        })
        .fail(function() {
            alert( "Ooppsss.... Your Request failed." );
			location.reload();
			return false;
        });
		
		$.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_16_1', 1, $objBF);?>" }
        })
        .done(function(rt_data){
			if(rt_data !=''){
			var RTAjAxVal = jQuery.parseJSON(rt_data);
			$("#trans_title").val(RTAjAxVal.var_customer_name);
			}
        })
        .fail(function() {
			return false;
        });
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		<?php } ?>
		<?php  if($GetAPMId == 17){?>
		 $("#loadingresp").show('slow');
        var GetAplicId = $("#head_id").val();
	    $.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_1', 1, $objBF);?>" }
        })
        .done(function(data){
			if(data == 0){
			alert( "Ooppsss.... Are you sure....?" );
			} else {
			$("#loadingresp").hide('slow');
            $('#loadingdate').html(data);
			$("#Third_section_").show('slow');
			$('#token_transfer_head_id').selectpicker('refresh');
			$(".material-datatables").css('background-image', 'none');
			$(".material-datatables").css('min-height', 'auto');
			$(".material-datatables").show();
			$(".material-datatables table").show();
			}
        })
        .fail(function() {
            alert( "Ooppsss.... Your Request failed." );
			location.reload();
			return false;
        });
		
		$.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_1_1', 1, $objBF);?>" }
        })
        .done(function(rt_data){
			if(rt_data !=''){
			var RTAjAxVal = jQuery.parseJSON(rt_data);
			$("#trans_title").val(RTAjAxVal.var_customer_name);
			}
        })
        .fail(function() {
			return false;
        });
		<?php } ?>
		<?php  if($GetAPMId == 20){?>
		 $("#loadingresp").show('slow');
        var GetAplicId = $("#head_id").val();
	    $.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_20', 1, $objBF);?>" }
        })
        .done(function(data){
			if(data == 0){
			alert( "Ooppsss.... Are you sure....?" );
			} else {
			$("#loadingresp").hide('slow');
            $('#loadingdate').html(data);
			$("#Third_section_").show('slow');
			$('#token_transfer_head_id').selectpicker('refresh');
			$(".material-datatables").css('background-image', 'none');
			$(".material-datatables").css('min-height', 'auto');
			$(".material-datatables").show();
			$(".material-datatables table").show();
			}
        })
        .fail(function() {
            alert( "Ooppsss.... Your Request failed." );
			location.reload();
			return false;
        });
		
		/*$.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php //echo $objQayaduser->user_id;?>", tp: "<?php //echo EncData('transrecpay_20_1', 1, $objBF);?>" }
        })
        .done(function(rt_data){
			if(rt_data !=''){
			var RTAjAxVal = jQuery.parseJSON(rt_data);
			$("#trans_title").val(RTAjAxVal.var_customer_name);
			}
        })
        .fail(function() {
			return false;
        });*/
		<?php } ?>
		<?php  if($GetAPMId >= 21 && $GetAPMId <= 22){?>
		 $("#loadingresp").show('slow');
        var GetAplicId = $("#head_id").val();
	    $.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_1', 1, $objBF);?>" }
        })
        .done(function(data){
			if(data == 0){
			alert( "Ooppsss.... Are you sure....?" );
			} else {
			$("#loadingresp").hide('slow');
            $('#loadingdate').html(data);
			$("#Third_section_").show('slow');
			$('#token_transfer_head_id').selectpicker('refresh');
			$(".material-datatables").css('background-image', 'none');
			$(".material-datatables").css('min-height', 'auto');
			$(".material-datatables").show();
			$(".material-datatables table").show();
			}
        })
        .fail(function() {
            alert( "Ooppsss.... Your Request failed." );
			location.reload();
			return false;
        });
		<?php } ?>
		<?php  if($GetAPMId >= 23 && $GetAPMId <= 24){?>
		 $("#loadingresp").show('slow');
        var GetAplicId = $("#head_id").val();
	    $.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_23', 1, $objBF);?>" }
        })
        .done(function(data){
			if(data == 0){
			alert( "Ooppsss.... Are you sure....?" );
			} else {
			$("#loadingresp").hide('slow');
            $('#loadingdate').html(data);
			$("#Third_section_").show('slow');
			$('#token_transfer_head_id').selectpicker('refresh');
			$(".material-datatables").css('background-image', 'none');
			$(".material-datatables").css('min-height', 'auto');
			$(".material-datatables").show();
			$(".material-datatables table").show();
			}
        })
        .fail(function() {
            alert( "Ooppsss.... Your Request failed." );
			location.reload();
			return false;
        });
		<?php } ?>
		<?php  if($GetAPMId == 18){?>
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		$("#loadingresp").show('slow');
        var GetAplicId = $("#head_id").val();
	    $.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_18', 1, $objBF);?>" }
        })
        .done(function(data){
			if(data == 0){
			alert( "Ooppsss.... Are you sure....?" );
			} else {
			$("#loadingresp").hide('slow');
            $('#loadingdate').html(data);
			$("#otherfields").show('slow');
			$('#token_transfer_head_id').selectpicker('refresh');
			$(".material-datatables").css('background-image', 'none');
			$(".material-datatables").css('min-height', 'auto');
			$(".material-datatables").show();
			$(".material-datatables table").show();
			}
        })
        .fail(function() {
            alert( "Ooppsss.... Your Request failed." );
			location.reload();
			return false;
        });
		
		$.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_18_1', 1, $objBF);?>" }
        })
        .done(function(rt_data){
			if(rt_data !=''){
			var RTAjAxVal = jQuery.parseJSON(rt_data);
			$("#trans_title").val(RTAjAxVal.var_customer_name);
			}
        })
        .fail(function() {
			return false;
        });
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		<?php } ?>
		
		<?php  if($GetAPMId == 19){?>
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		$("#loadingresp").show('slow');
        var GetAplicId = $("#head_id").val();
	    $.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_19', 1, $objBF);?>" }
        })
        .done(function(data){
			if(data == 0){
			alert( "Ooppsss.... Are you sure....?" );
			} else {
			$("#loadingresp").hide('slow');
            $('#loadingdate').html(data);
			$("#Third_section_").show('slow');
			$('#token_transfer_head_id').selectpicker('refresh');
			$(".material-datatables").css('background-image', 'none');
			$(".material-datatables").css('min-height', 'auto');
			$(".material-datatables").show();
			$(".material-datatables table").show();
			}
        })
        .fail(function() {
            alert( "Ooppsss.... Your Request failed." );
			location.reload();
			return false;
        });
		
		$.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_19_1', 1, $objBF);?>" }
        })
        .done(function(rt_data){
			if(rt_data !=''){
			var RTAjAxVal = jQuery.parseJSON(rt_data);
			$("#trans_title").val(RTAjAxVal.var_customer_name);
			}
        })
        .fail(function() {
			return false;
        });
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		<?php } ?>


		<?php  if($GetAPMId == 25){?>
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		$("#loadingresp").show('slow');
        var GetAplicId = $("#head_id").val();
	    $.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_25', 1, $objBF);?>" }
        })
        .done(function(data){
			if(data == 0){
			alert( "Ooppsss.... Are you sure....?" );
			} else {
			$("#loadingresp").hide('slow');
            $('#loadingdate').html(data);
			$("#Third_section_").show('slow');
			$('#token_transfer_head_id').selectpicker('refresh');
			$(".material-datatables").css('background-image', 'none');
			$(".material-datatables").css('min-height', 'auto');
			$(".material-datatables").show();
			$(".material-datatables table").show();
			}
        })
        .fail(function() {
            alert( "Ooppsss.... Your Request failed." );
			location.reload();
			return false;
        });
		
		$.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_25_1', 1, $objBF);?>" }
        })
        .done(function(rt_data){
			if(rt_data !=''){
			var RTAjAxVal = jQuery.parseJSON(rt_data);
			//alert(RTAjAxVal.var_customer_name);
			$("#trans_title").val(RTAjAxVal.var_customer_name);
			} else {
				alert('Error - Sec - AJX');
			}
        })
        .fail(function() {
			return false;
        });
		<?php  } if($GetAPMId == 27){ ?>
			
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		$("#loadingresp").show('slow');
        var GetAplicId = $("#head_id").val();
	    $.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_27', 1, $objBF);?>" }
        })
        .done(function(data){
			if(data == 0){
			alert( "Ooppsss.... Are you sure....?" );
			} else {
			$("#loadingresp").hide('slow');
            $('#loadingdate').html(data);
			$("#Third_section_").show('slow');
			$('#token_transfer_head_id').selectpicker('refresh');
			$(".material-datatables").css('background-image', 'none');
			$(".material-datatables").css('min-height', 'auto');
			$(".material-datatables").show();
			$(".material-datatables table").show();
			}
        })
        .fail(function() {
            alert( "Ooppsss.... Your Request failed." );
			location.reload();
			return false;
        });
		
		$.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_27_1', 1, $objBF);?>" }
        })
        .done(function(rt_data){
			if(rt_data !=''){
			var RTAjAxVal = jQuery.parseJSON(rt_data);
			//alert(RTAjAxVal.var_customer_name);
			$("#trans_title").val(RTAjAxVal.var_customer_name);
			} else {
				alert('Error - Sec - AJX');
			}
        })
        .fail(function() {
			return false;
        });
		<?php  } if($GetAPMId == 26){?>
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		$("#loadingresp").show('slow');
        var GetAplicId = $("#head_id").val();
	    $.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_26', 1, $objBF);?>" }
        })
        .done(function(data){
			if(data == 0){
			alert( "Ooppsss.... Are you sure....?" );
			} else {
			$("#loadingresp").hide('slow');
            $('#loadingdate').html(data);
			$("#Third_section_").show('slow');
			$('#token_transfer_head_id').selectpicker('refresh');
			$(".material-datatables").css('background-image', 'none');
			$(".material-datatables").css('min-height', 'auto');
			$(".material-datatables").show();
			$(".material-datatables table").show();
			}
        })
        .fail(function() {
            alert( "Ooppsss.... Your Request failed." );
			location.reload();
			return false;
        });
		
		$.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetAplicId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('transrecpay_26_1', 1, $objBF);?>" }
        })
        .done(function(rt_data){
			if(rt_data !=''){
			var RTAjAxVal = jQuery.parseJSON(rt_data);
			//alert(RTAjAxVal.var_customer_name);
			$("#trans_title").val(RTAjAxVal.var_customer_name);
			} else {
				alert('Error - Sec - AJX');
			}
        })
        .fail(function() {
			return false;
        });
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////
		<?php } ?>
		
    });

	
<?php  
		if($GetAPMId == 13){ ?>
		
		$('#vehicle_order_list').change(function(){
		var GetPayModeId = $(this).val();
		$("#Third_section_").hide('slow');
		$("#headitem_id").val('');
		$("#Generalhaeditemdiv").hide('slow');
		 $.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetPayModeId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('vehicle_order_get', 1, $objBF);?>" }
        })
        .done(function(data){
			$("#loadingresp").hide('slow');
            $('#load_vehicle_order_list').html(data);
			$("#Generalhaeditemdiv").show('slow');
			$('#supply_order_id').selectpicker('refresh');
        })
        .fail(function() {
            alert( "Ooppsss.... Your Request failed." );
			location.reload();
			return false;
        });	
	});

		<?php } ?>
		
		
	$('#transfer_head_id').change(function(){

		var GetPayModeId = $(this).val();

		$("#haeditemdiv").hide('slow');

		 $.ajax({

            type: 'POST',

            url: '<?php echo SITE_URL;?>ajax.php', 

            data: { i: GetPayModeId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('head', 1, $objBF);?>" }

        })

        .done(function(data){

			$("#loadingresp").hide('slow');

            $('#haeditemdiv').html(data);

			$("#haeditemdiv").show('slow');

			$('#transfer_item_id').selectpicker('refresh');

        })

        .fail(function() {

            alert( "Ooppsss.... Your Request failed." );

			location.reload();

			return false;

        });	

	});

	

	$('#token_transfer_head_id').change(function(){

		var GetPayModeId = $(this).val();

		$("#haeditemdiv").hide('slow');

		 $.ajax({

            type: 'POST',

            url: '<?php echo SITE_URL;?>ajax.php', 

            data: { i: GetPayModeId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('tokenhead', 1, $objBF);?>" }

        })

        .done(function(data){

			$("#loadingresp").hide('slow');

            $('#tokenhaeditemdiv').html(data);

			$("#tokenhaeditemdiv").show('slow');

			$('#token_transfer_item_id').selectpicker('refresh');

        })

        .fail(function() {

            alert( "Ooppsss.... Your Request failed." );

			location.reload();

			return false;

        });	

	});

	

	$('#general_head_id').change(function(){

		var GetPayModeId = $(this).val();

		$("#Third_section_").hide('slow');

		$("#headitem_id").val('');

		$("#Generalhaeditemdiv").hide('slow');

		 $.ajax({

            type: 'POST',

            url: '<?php echo SITE_URL;?>ajax.php', 

            data: { i: GetPayModeId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('general_head', 1, $objBF);?>" }

        })

        .done(function(data){

			$("#loadingresp").hide('slow');

            $('#Generalhaeditemdiv').html(data);

			$("#Generalhaeditemdiv").show('slow');

			$('#general_item_id').selectpicker('refresh');

			if($("#transfer_mode").val() == 1){

				$("#Third_section_").show('slow');

				$("#trans_type").val('4');

			} else {

				$("#trans_type").val('2');

			}

        })

        .fail(function() {

            alert( "Ooppsss.... Your Request failed." );

			location.reload();

			return false;

        });	

	});

	
	
	$('#emp_salary_sel').change(function(){

		var GetPayModeId = $(this).val();
		var GetEmpSalary = $(this).find("option:selected").data("salary");
		var GetHeadId = $(this).find("option:selected").data("head");
		var GetEmployeeName = $(this).find("option:selected").data("emname");
		var GetPaidDate = $(this).find("option:selected").data("paiddate");
		
		if(GetEmpSalary >= 0){
		$("#Third_section_").hide('slow');
		$("#Third_section_").show('slow');
		$("#trans_amount").val(GetEmpSalary);
		$("#dyn_head_id").val(GetHeadId);
		$("#trans_title").val(GetPaidDate + " Salary paid to "+ GetEmployeeName +".");
		
		} else {
			alert('Oops! Sorry selected employee salary is not valid or amount below zero to pay please check with hr or administration.');	
			$("#Third_section_").hide('slow');
		}

	});
	

	$('#pay_mode').change(function(){

		var GetPayModeId = $(this).val();

		if(GetPayModeId != 1){

			$("#mode_no").show('slow');

		} else if(GetPayModeId == 1){

			$("#mode_no").hide('slow');

		}

	});

	$('.discount_apply').click(function(){

		$('.instalment_option').prop('checked', false);

		$("#customize_instalment_div").hide('slow');

		if($(this).val() == 1){

			$('#discount_value').val('');

			$("#discount_in_opt").show('slow');

		} else {

			$("#discount_in_opt").hide('slow');

			ResetDiscountValues();

		}

	});

	

	$.fn.digits = function(){ 

		return this.each(function(){ 

			$(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, ",") ); 

		})

	}

	

	$('#discount_value').change(function(){

		DiscountOptionSet();

	});

	

	$('.discount_on').change(function(){

		DiscountOptionSet();

	});

	

	$('.instalment_option').change(function(){

		var CheckDiscountOption = $("input[name='discount_apply']:checked").val();

		var CheckInstalmentOption = $("input[name='instalment_option']:checked").val();

		var DiscountValue = $('#discount_value').val();

		if(CheckDiscountOption == 1 && DiscountValue == ''){

			alert('Please Enter Discount Value First...');

			$(this).prop('checked', false);

			return false;

		}

		if(CheckInstalmentOption == 2){

			$("#customize_instalment_div").show('slow');	

		} else {

			$('#no_of_instalment').val('');

			$('.instalment_due_on').prop('checked', false);

			$("#mainplan_loading").hide('slow');

			$("#instalment_plan_loading").html('');

			$("#customize_instalment_div").hide('slow');		

		}

	});

	

	$('.instalment_due_on, .instalment_pay_as, #no_of_instalment').change(function(){

		var CheckInstalmentDueOption = $("input[name='instalment_due_on']:checked").val();

		var CheckDiscountOption = $("input[name='instalment_pay_as']:checked").val();

		var NoOfInstalmentVal = $('#no_of_instalment').val();

		$("#instalment_plan_loading").html('');

		if(NoOfInstalmentVal == ''){

			alert('Please enter no of instalment first...');

			$(this).prop('checked', false);

			return false;

		}

		var lopi;

		var optputHTML;

		

		for(lopi = 1; lopi<=NoOfInstalmentVal;lopi++){

			if(CheckInstalmentDueOption == 1){

			$("#instalment_plan_loading").append(DueInstalmentOpt_1(lopi,CheckDiscountOption));

			$( "#" + lopi ).datetimepicker({format: 'MM/DD/YYYY'});

			} else {

			$("#instalment_plan_loading").append(DueInstalmentOpt_2(lopi,CheckDiscountOption));

			$("#dp_" + lopi).selectpicker('refresh');

			}

		}

		$("#mainplan_loading").show('slow');

		$("#instalment_plan_loading").show('slow');

		

	});

	

	<?php if(trim(DecData($_GET["p"], 1,$objBF)) == 'a' && trim(DecData($_GET["api"], 1,$objBF)) != '' && trim(DecData($_GET["ini"], 1,$objBF)) != '' && $_GET["show"] == 'transrecpay'){ ?>

			$("#loadingresp").show('slow');

			$('#loadingdate').html('');

			var CheckSearchOpt = 1;

			var GetAplicId = '<?php echo $PrintApplicationNumber;?>';

			$.ajax({

				type: 'POST',

				url: '<?php echo SITE_URL;?>ajax.php', 

				data: { i: GetAplicId, sopt: CheckSearchOpt, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('keysearch', 1, $objBF);?>" }

			})

			.done(function(data){

				if(data == 0){

				alert( "Ooppsss.... Are you sure....?" );	

				location.reload();

				} else {

				$("#loadingresp").hide('slow');

				$('#loadingdate').html(data);

				$(".material-datatables").css('background-image', 'none');

				$(".material-datatables").css('min-height', 'auto');

				//

				$(".material-datatables").show();

				$("#datatables").show();

				if($(".ct_api").val() == 0){

				$("#otherfields").hide('slow');

				} else {

				}

				}

			})

			.fail(function() {

				alert( "Ooppsss.... Your Request failed." );

				location.reload();

				return false;

			});

			$("#otherfields").show('slow');

	<?php } else { ?>

	$("#application_number_search, .searchopt").keypress(function(e) {

    if(e.which == 13) {

			$("#loadingresp").show('slow');

			$('#loadingdate').html('');

			var CheckSearchOpt = $("input[name='searchopt']:checked").val();

			var GetAplicId = $("#application_number_search").val();

			$.ajax({

				type: 'POST',

				url: '<?php echo SITE_URL;?>ajax.php', 

				data: { i: GetAplicId, sopt: CheckSearchOpt, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('keysearch', 1, $objBF);?>" }

			})

			.done(function(data){

				if(data == 0){

				alert( "Ooppsss.... Are you sure....?" );	

				location.reload();

				} else {

				$("#loadingresp").hide('slow');

				$('#loadingdate').html(data);

				$(".material-datatables").css('background-image', 'none');

				$(".material-datatables").css('min-height', 'auto');

				//

				$(".material-datatables").show();

				$("#datatables").show();

				if($(".ct_api").val() == 0){

				$("#otherfields").hide('slow');

				} else {

				}

				}

			})

			.fail(function() {

				alert( "Ooppsss.... Your Request failed." );

				location.reload();

				return false;

			});

    return false;

	}

	});

	

	

	<?php } ?>

	

	function DueInstalmentOpt_2(lopi,CheckDiscountOption){

		if(CheckDiscountOption == 1){ var ReturnTextVal = 'Note: Instalment in <strong>%</strong> Only.'; var MaxValue = 'max="100"';

		} else { var ReturnTextVal = 'Note: Instalment in Fix value Base.'; var MaxValue = 'max="100000000"'; }

		return '<div class="col-sm-12"><input type="hidden" name="noofdues[]" value="'+lopi+'"><label class="col-sm-2 label-on-left">Instalment Plan <span id="noofinstalment">'+lopi+'</span>:</label><div class="form-group label-floating"><div class="col-sm-3"><div class="form-group label-floating"><label class="control-label"></label><input class="form-control perstanceval" type="number" '+MaxValue+' name="instalment_amount_'+lopi+'" id="instalment_amount_'+lopi+'" required value="" /><code>'+ReturnTextVal+'</code></div></div><div class="col-sm-6"><div class="form-group label-floating"><label class="control-label"></label><select class="selectpicker" data-style="select-with-transition" name="instalment_event_'+lopi+'" id="dp_'+lopi+'" title="List of Project Event" required tabindex="2"><?php $objQayadProerty->resetProperty(); $objQayadProerty->setProperty("ORDERBY", 'project_event_id'); $objQayadProerty->lstPropertyProjectEvent(); while($ProjectEvent = $objQayadProerty->dbFetchArray(1)){ ?><option value="<?php echo $ProjectEvent["project_event_id"];?>"><?php echo $ProjectEvent["event_name"] .'('.dateFormate_3($ProjectEvent["expected_date"]).')';?></option><?php } ?></select></div></div></div></div>';

	}

	

	<?php } ?>

	var uv = '<?php echo $objQayaduser->user_id;?>';

	var tpv = '<?php echo EncData('checkcnic', 1, $objBF);?>';

	var SITE_URL = '<?php echo SITE_URL;?>';

	$("#customer_cnic").blur(function(e) {

		var CustomerCNIC = $(this).val();

		$.ajax({

				type: 'POST',

				url: SITE_URL + 'ajax.php', 

				data: { cnic: CustomerCNIC, u: uv, tp: tpv }

			})

			.done(function(data){

				if(data != 0){

					$( "#cnic_div" ).addClass( "is-empty has-error" );

					$( "#customer_cnic" ).addClass( "error" );

					$( "#cnic_error_msg" ).html('This cnic number is already in use with another application.');

				} else {

					$( "#cnic_div" ).removeClass( "is-empty has-error" );

					$( "#customer_cnic" ).removeClass( "error" );

					$( "#cnic_error_msg" ).html('');

				}

			})

			.fail(function() {

				alert( "Ooppsss.... Your Request failed." );

				location.reload();

				return false;

			});

	});

	

	$("#n_customer_cnic").blur(function(e) {

		var CustomerCNIC = $(this).val();

		$.ajax({

				type: 'POST',

				url: SITE_URL + 'ajax.php', 

				data: { cnic: CustomerCNIC, u: uv, tp: tpv }

			})

			.done(function(data){

				if(data != 0){

					$( "#n_cnic_div" ).addClass( "is-empty has-error" );

					$( "#n_customer_cnic" ).addClass( "error" );

					$( "#n_cnic_error_msg" ).html('This cnic number is already in use with another application.');

				} else {

					$( "#n_cnic_div" ).removeClass( "is-empty has-error" );

					$( "#n_customer_cnic" ).removeClass( "error" );

					$( "#n_cnic_error_msg" ).html('');

				}

			})

			.fail(function() {

				alert( "Ooppsss.... Your Request failed." );

				location.reload();

				return false;

			});

	});

	

	$("#ja_customer_cnic").blur(function(e) {

		var CustomerCNIC = $(this).val();

		$.ajax({

				type: 'POST',

				url: SITE_URL + 'ajax.php', 

				data: { cnic: CustomerCNIC, u: uv, tp: tpv }

			})

			.done(function(data){

				if(data != 0){

					$( "#ja_cnic_div" ).addClass( "is-empty has-error" );

					$( "#ja_customer_cnic" ).addClass( "error" );

					$( "#ja_cnic_error_msg" ).html('This cnic number is already in use with another application.');

				} else {

					$( "#ja_cnic_div" ).removeClass( "is-empty has-error" );

					$( "#ja_customer_cnic" ).removeClass( "error" );

					$( "#ja_cnic_error_msg" ).html('');

				}

			})

			.fail(function() {

				alert( "Ooppsss.... Your Request failed." );

				location.reload();

				return false;

			});

	});


$("#hideafterclick").click(function () {
		$("#hideafterclick").hide();
});

$('#request_type').change(function(){
	var GerRequestedOption = $(this).val();
	if(GerRequestedOption ==1){
		$("#d_original_bill_no").show('slow');
		$("#d_arrear_amount_remove").hide('slow');
		$("#d_original_amount").hide('slow');
		
		$("#original_bill_no").prop('required',true);
		$("#arrear_amount_remove").prop('required',false);
		$("#original_amount").prop('required',false);
		
	} else if(GerRequestedOption ==2){
		$("#d_original_bill_no").hide('slow');
		$("#d_arrear_amount_remove").show('slow');
		$("#d_original_amount").hide('slow');
		
		$("#original_bill_no").prop('required',false);
		$("#arrear_amount_remove").prop('required',true);
		$("#original_amount").prop('required',false);
		
	} else if(GerRequestedOption ==3){
		$("#d_original_bill_no").hide('slow');
		$("#d_arrear_amount_remove").hide('slow');
		$("#d_original_amount").show('slow');
		
		$("#original_bill_no").prop('required',false);
		$("#arrear_amount_remove").prop('required',false);
		$("#original_amount").prop('required',true);
		
	} else {
		$("#d_original_bill_no").hide('slow');
		$("#d_arrear_amount_remove").hide('slow');
		$("#d_original_amount").hide('slow');
		
		$("#original_bill_no").prop('required',false);
		$("#arrear_amount_remove").prop('required',false);
		$("#original_amount").prop('required',false);
	}
	
});



$('#main_project_id').change(function(){
		var GetMainProjectId = $(this).val();
		$("#floorinnersection").hide();
		$("#propety_floor_id").html('<option disabled>Select Project Floor</option>');
		 $.ajax({
            type: 'POST',
            url: '<?php echo SITE_URL;?>ajax.php', 
            data: { i: GetMainProjectId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('GetProjectFloorList', 1, $objBF);?>", mod: "I" }
        })
        .done(function(data){
			$("#floorinnersection").show('slow');
			$("#propety_floor_id").append(data);
			$('#propety_floor_id').selectpicker('refresh');
        })
        .fail(function() {
            alert( "Ooppsss.... Your Request failed." );
			location.reload();
			return false;
        });	
	});
<?php if($_GET['show']=='floorplanform' && $_GET['i'] != ""){?>
var GetMainProjectId = <?php echo $project_id;?>;
$("#floorinnersection").hide();
$("#propety_floor_id").html('<option disabled>Select Project Floor</option>');
 $.ajax({
	type: 'POST',
	url: '<?php echo SITE_URL;?>ajax.php', 
	data: { i: GetMainProjectId, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('GetProjectFloorList', 1, $objBF);?>", mod: "U", fi: "<?php echo $_GET['i'];?>" }
})
.done(function(data){
	$("#floorinnersection").show('slow');
	$("#propety_floor_id").append(data);
	$('#propety_floor_id').selectpicker('refresh');
})
.fail(function() {
	alert( "Ooppsss.... Your Request failed." );
	location.reload();
	return false;
});	
<?php } ?>
$('.CompleteOrder').on('click', function () {
        return confirm('Are you sure you want to complete this selected order...?');
});
$('.cancel').on('click', function () {
        return confirm('Are you sure you want to cancle this selected order...?');
});
$('.remove').on('click', function () {
        return confirm('Are you sure you want to remove this selected entity...?');
});
$('.modifiy').on('click', function () {
        return confirm('Are you sure you want to change this selected entity...?');
});
$('.leave').on('click', function () {
        return confirm('Are you sure the tenant has been living in this property...?');
});
$('.paidbill').on('click', function () {
        return confirm('Are you sure you want to clear "'+ $(this).attr("data-title") +'" tenant "November" pending Charges [ '+ $(this).attr("data-price") +' ] ?');
});
$('.submitbutton').on('click', function () {
	$(".form-horizontal").submit();
	$(".btn").prop('disabled', true);
});
<?php if($_GET['show']=='propertytypeform' && $_GET['ip'] != ""){?>
var GetMainProjectId = <?php echo $project_id;?>;
var PassFloorID = <?php echo $propety_floor_id;?>;
$("#floorinnersection").hide();
$("#propety_floor_id").html('<option disabled>Select Project Floor</option>');
 $.ajax({
	type: 'POST',
	url: '<?php echo SITE_URL;?>ajax.php', 
	data: { i: GetMainProjectId, ip: PassFloorID, u: "<?php echo $objQayaduser->user_id;?>", tp: "<?php echo EncData('GetProjectFloorList_2', 1, $objBF);?>", mod: "U", fi: "<?php echo $_GET['i'];?>" }
})
.done(function(data){
	$("#floorinnersection").show('slow');
	$("#propety_floor_id").append(data);
	$('#propety_floor_id').selectpicker('refresh');
})
.fail(function() {
	alert( "Ooppsss.... Your Request failed." );
	location.reload();
	return false;
});	
<?php } ?>
var message = new SpeechSynthesisUtterance($("#spkmessage").val());
var voices = speechSynthesis.getVoices();
var interval = setInterval(function () { voices = speechSynthesis.getVoices(); }, 1);
/*$("input").on("change", function () {
    console.log($(this).attr("id"), $(this).val());
	message[$(this).attr("id")] = $(this).val();
});
$("select").on("change", function () {
	//console.log(voices[$(this).val()] + '-' + $(this).val() );
    message.voice = voices[1];
});*/
/*speechSynthesis.speak(message);*/
// Hack around voices bug
});
</script>

<input type="hidden" id="spkmessage" value="<?php echo $MegPas; ?>">
</input>
<input type="hidden" id="volume" value="0">
</input>
<input type="hidden" id="rate" value="1">
</input>
<input type="hidden" id="pitch" value="2">
</input>
<button type="button" style="display:none;">Speak!</button>
