var ajax_script_url = '/bitrix/components/linemedia/autoportal.auto.info/ajax_get_info_custom.php';function GetBrand(){    $('#f_brand').val('');     $('#f_model').val('');    $('#f_modification').val('');    $('#f_brand_id').val('');     $('#f_model_id').val('');    $('#f_modification_id').val('');    $("#ul_brand").html('<div class="lm_loading">Ждите, идет загрузка...</div>').load(ajax_script_url+'?a=getBrand');		$("#brand_name").html('');		$("#ul_brand").show();    $("#div_model").hide();    $("#div_modification").hide();}function GetModel(BrandID, ItemTitle){    if(BrandID != undefined){	$('#f_model').val('');	$('#f_modification').val('');	$('#f_model_id').val('');	$('#f_modification_id').val('');	if(ItemTitle != undefined){	    $('#f_brand').val(ItemTitle);	    $('#f_brand_id').val(BrandID); 		$('#ul_brand').hide();			    $('#brand_name').html('<strong>' + ItemTitle + '</strong> <small>(<a href="javascript: void(0);" onclick="GetBrand(); return false;">изменить</a>)</small>');	} 	$("#div_model").css('display', 'block');	$('#model_name').html('');		$("#ul_model").html('<div class="lm_loading"></div> Ждите, идет загрузка...').load(ajax_script_url+'?a=getModel&BrandID=' + BrandID);		$("#ul_model").show();	$("#div_modification").hide();    }}function GetModification(ModelID, ItemTitle){    var BrandID = $('#f_brand_id').val();    if(ModelID != undefined && BrandID != undefined){	$('#f_modification').val('');	$('#f_modification_id').val('');		if(ItemTitle != undefined){	    $('#f_model').val(ItemTitle);	    $('#f_model_id').val(ModelID);		$('#ul_model').hide();			    $('#model_name').html('<strong>' + ItemTitle + '</strong> <small>(<a href="javascript: void(0);" onclick="GetModel(\'' + BrandID + '\'); return false;">изменить</a>)</small>');	}	$("#div_modification").css('display', 'block');	$('#modification_name').html('');	$("#ul_modification").html('<div class="lm_loading"></div> Ждите, идет загрузка...').load(ajax_script_url+'?a=GetModification&BrandID=' + BrandID + '&ModelID=' + ModelID);	$("#ul_modification").show();	    }}function SetModification(ModificationID, ItemTitle){    var ModelID = $('#f_model_id').val();    if(ModificationID != undefined && ModelID != undefined){	$('#f_modification').val(ItemTitle);	$('#f_modification_id').val(ModificationID);	$('#ul_modification').hide();	$('#modification_name').html('<strong>' + ItemTitle + '</strong> <small>(<a href="javascript: void(0);" onclick="GetModification(\'' + ModelID + '\'); return false;">изменить</a>)</small>');	    }}