function validate_alias(alias,type){
	$.ajax({
		type: "POST",
		url: base_url+'monologadmin/home/check_alias2',
		data: "alias="+alias+"&type="+type,		  
		success: function(temp){		
			$("#flag").val(temp);
		}
	});		
}

function validate_alias_edit(alias,type,id){
	$.ajax({
		type: "POST",
		url: base_url+'monologadmin/home/check_alias_edit2',
		data: "alias="+alias+"&type="+type+"&id="+id,		  
		success: function(temp){		
			$("#flag").val(temp);
		}
	});		
}


$(document).ready(function(){
	//login
	$('label.autoFade').inFieldLabels();
	$('form').not('.loginForm').highlight('dl', 'highlight', 'focus', 'blur');
	
	//homebanner
	if($("#homebanner_form").length > 0){	
		$('#homebanner_form').validationEngine('attach');
		$("#homebanner_submit").click(function(){
			$("#homebanner_form").submit();	
		});
	}
	
	//product
	if($("#product_form").length > 0){	
		$('#product_form').validationEngine('attach');
		$("#product_submit").click(function(){
			$("#product_form").submit();	
		});
	}
	
	///package
	if($("#package_form").length > 0){	
		$('#package_form').validationEngine('attach');
		$("#package_submit").click(function(){
			$("#package_form").submit();	
		});
	}
	if($("#changepass_form").length > 0){
		$("#changepass_form").validationEngine('attach');
		$("#changepass_submit").click(function(){
			$("#changepass_form").submit();
		});
	}
	if($("#form_add_article").length > 0){
		$("#form_add_article").validationEngine('attach');
		$("#add_article").click(function(){
			$("#form_add_article").submit();
		});
	}
	
	if($("#form_add_user").length > 0){
		$("#form_add_user").validationEngine('attach');
		$("#add_user").click(function(){
			$("#form_add_user").submit();
		});
	}
	
	if($("#form_add_address").length > 0){
		$("#form_add_address").validationEngine('attach');
		$("#add_address").click(function(){
			$("#form_add_address").submit();
		});
	}
	
	if($("#city_form").length > 0){
		$("#city_form").validationEngine('attach');
		$("#product_submit").click(function(){
			$("#city_form").submit();
		});
	}
	
	if($("#add_administrator_form").length > 0){
		$("#add_administrator_form").validationEngine('attach');
		$("#add_administrator_submit").click(function(){
			$("#add_administrator_form").submit();
		});
	}
	

});
//initialize redactor
	$(document).ready(function(){
		$('#story').redactor({
			//imageUpload: base_url+'monologadmin/home/add_image'
		});
		$('#short_description').redactor({
			//imageUpload: base_url+'monologadmin/home/add_image'
		});

	}
		
);
