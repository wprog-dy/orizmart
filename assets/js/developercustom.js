$(document).ready(function()
{
	$('.cart-sidebar').load(base_url+'EcommercePages/loadCart');
	$('.cart-value').load(base_url+'EcommercePages/loadCountCartItems');

	     
    $(document).on('click','.remove-cart',function()
    {
        var data =  
        {   
            row_id: $(this).attr("delete-id")
        }
        data[csfr_token_name] = csfr_token_value; 
       
        $.ajax({
            url : base_url+'EcommercePages/deleteCart',
            method : "POST",
            data : data,
            success :function(response)
            {
                $('.cart-sidebar').html(response);
                $('.cart-value').load(base_url+'EcommercePages/loadCountCartItems');
                $('.showcart').show();
            }
        });
    });
	$("#profileImage").click(function(e) {
		    $("#imageUpload").click();
	});

	function fasterPreview( uploader ) 
	{
	    if ( uploader.files && uploader.files[0] )
	    {
	          $('#profileImage').attr('src', 
	             window.URL.createObjectURL(uploader.files[0]) );
	    }
	}

	$("#imageUpload").change(function()
	{
	    fasterPreview( this );
	});
	if (document.cookie.indexOf('visited=true') == -1)
	{
	    // load the overlay
	    $('#myModal').modal({show:true});	    
	    var year = 1000*60*60*24*1;
	    var expires = new Date((new Date()).valueOf() + year);
	    document.cookie = "visited=true;expires=" + expires.toUTCString();
  	}
  	var ca = document.cookie.split(';');
  	var checkZipCodeform = $(".checkzipCode").attr('action');
	if(ca[1] > 0)
	{
		$('.setzipcode').html(ca[1]).removeClass('extrahideshow');
		var zipcode_val=ca[1].trim();
		diplayCategory(checkZipCodeform,zipcode_val);

		if((voucher_page_url == window.location.href)||(base_url == window.location.href))
		{
			displayVoucher(zipcode_val);
		}	
	}
	$('.location-top').click(function()
	{
		$('#myModal').modal({show:true});
	});
	$('.modal-close').click(function()
	{
		$('#myModal').modal('hide');
	});
  	$('.countryId').change(function()
  	{
  		$('.countrycode').val("+"+$(this).find(':selected').attr('data-countrycode'));
  	});
	$('.onlynumber').keyup(function(e)
    {
		if (/\D/g.test(this.value))
		{
		    this.value = this.value.replace(/\D/g, '');
		}
	});
	var form = $(".myForm");
	$(".smt").click(function(e)
	{
		$('#loader').show();
		e.preventDefault();
		$.ajax({
	        type:"POST",
	        url:form.attr("action"),
	        data:form.serialize(),
	        dataType: "json",
	        success: function(response)
	        {
	        	$('#loader').hide();
	            if(response.status == '1')
	            {
	            	$('.message').html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+response.msg+'</div>');
	            	setTimeout(function() { $(".alert-success").hide(); }, 8000);
	            	$('.myForm').hide();	
	            	$('.verifymyFormOtp').show();	
	            	$('.mobilenumber').val($('.mobileuse').val());
	            	$('.clientId').val(response.clientId);
	            	$('.userName').val(response.userName);
	            	$('.timeFrom').val(response.timeFrom);
	            }
	            else if(response.status == '2')
	            {
	            	$('.message').html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+response.msg+'</div>');
	            	setTimeout(function() { $(".alert-success").hide(); }, 8000);
	            }
	            else if(response.status == '3')
				{
					if(response.countryId_error != '')
				    {
				      	$('.countryId_error').html(response.countryId_error);
				    }
				    else
				    {
				      	$('.countryId_error').html('');
				    }
				    if(response.firstname_error != '')
				    {
				      	$('.firstname_error').html(response.firstname_error);
				    }
				    else
				    {
				      	$('.firstname_error').html('');
				    }
				    if(response.lastname_error != '')
				    {
				      	$('.lastname_error').html(response.lastname_error);
				    }
				    else
				    {
				      	$('.lastname_error').html('');
				    }
				    if(response.userEmail_error != '')
				    {
				      	$('.userEmail_error').html(response.userEmail_error);
				    }
				    else
				    {
				      	$('.userEmail_error').html('');
				    }
				    if(response.clientmobile_error != '')
				    {
				      	$('.clientmobile_error').html(response.clientmobile_error);
				    }
				    else
				    {
				      	$('.clientmobile_error').html('');
				    }
				    if(response.password_error != '')
				    {
				    	
				      	$('.password_error').html(response.password_error);
				    }
				    else
				    {
				      	$('.password_error').html('');
				    }
				    if(response.zipcode_error != '')
				    {
				      	$('.zipcode_error').html(response.zipcode_error);
				    }
				    else
				    {
				      	$('.zipcode_error').html('');
				    }
				    if(response.gender_error != '')
				    {
				      	$('.gender_error').html(response.gender_error);
				    }
				    else
				    {
				      	$('.gender_error').html('');
				   	}
				}   	
	            else
	            {
	            	$('.message').html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+response.msg+'</div>');	
	            	setTimeout(function() { $(".alert-danger").hide(); }, 8000);
	            }
	        }
	    });
	});
	
	$(".smtressendotp").click(function()
	{
		var data =  
        {
            mobile : $('.mobilenumber').val(),
        }
        data[csfr_token_name] = csfr_token_value;

		$('#loader').show();
		$.ajax({
	        type:"POST",
	        url:$(this).attr('data-url'),
	        data: data,
	        dataType: "json",
	        success: function(response)
	        {
	        	$('#loader').hide();
	        	$('.clientId').val(response.userId);
            	$('.userName').val($('.mobilenumber').val());
            	$('.timeFrom').val(response.timeFrom);
            	$('.otp_field').val(response.code);

	        	/*if(response.status == '1')
	            {
	            	$('.message').html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+response.msg+'</div>');
	            }    
				else
				{
            		$('.message').html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+response.msg+'</div>');	
            	}*/	
	            
	        }
	    });
	});
	var verifyotpform = $(".verifymyFormOtp");
	$(".verifysmtotp").click(function(e)
	{

		e.preventDefault();
		$('#loader').show();
		$.ajax({
	        type:"POST",
	        url:verifyotpform.attr("action"),
	        data:verifyotpform.serialize(),
	        dataType: "json",
	        success: function(response)
	        {
	        	$('#loader').hide();
	        	if(response.status == '1')
	            {
	            	$('.message').html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+response.msg+'</div>');

	            	setTimeout(function() { $(".alert-success").hide(); }, 8000);

	            	window.setTimeout(function () 
	            	{
				        location.reload(true);
				    }, 9000);
	            	
	            }
	            else if(response.status == '3')
				{
					if(response.code_error != '')
				    {
				      	$('.code_error').html(response.code_error);
				    }
				    else
				    {
				      	$('.code_error').html('');
				    }
				}    
				else
				{
            		$('.message').html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+response.msg+'</div>');	
            		setTimeout(function() { $(".alert-danger").hide(); }, 8000);
            	}	
	            
	        }
	    });
	});
	
	$(".smtzipcode").click(function(e)
	{
		var zipcode_val = $('.chkzipcode').val().trim();
		if(zipcode_val !="")
		{
			document.cookie = zipcode_val;
			$('.setzipcode').html(zipcode_val).removeClass('extrahideshow');
			$('#myModal').modal({show:true});
		}
		e.preventDefault();
		$('#loader').show();
		diplayCategory(checkZipCodeform,zipcode_val);
		displayVoucher(zipcode_val);
	});
	
	function diplayCategory(checkZipCodeform,zipcode_val)
	{
		$('.chkzipcode').val(zipcode_val);
		$(".owl-wrapper:not(:first)").addClass("item-data").css("width", "3336px");
		var numItems = $('.owl-wrapper').length;
		var numItems3 = 2;
		var i = 0;
		$('.owl-wrapper').each(function()
		{
            i++;
            if(i==numItems3)
            {
                $(this).addClass("item-data").css("width", "3336px");
            }
            else
            {
            	$(this).removeClass("item-data");
            }
        });
		var data =  
        {
            zipcode : zipcode_val,
        }
        data[csfr_token_name] = csfr_token_value;

		var html_data = '';
		$.ajax({
	        type:"POST",
	        url:checkZipCodeform,
	        data:data,
	        dataType: "json",
	        success: function(response)
	        {
	        	$('#loader').hide();
	        	if(response.status == '1')
	            {
	            	$('#myModal').modal('hide');
	            	var categories = response.data;
	            	categories.forEach(function (category) 
	            	{
					    html_data += '<div class="owl-item" style="width: 139px;"><div class="item"><div class="category-item"><a href="'+base_url+'getmerchant/'+category.id+'/'+zipcode_val+'#mercahants"><img class="img-fluid" src="'+category.image+'" alt=""><h6>'+category.merchant_type_name+'</h6><p>150 Items</p></a></div></div></div>';
					});
					$('.item-data').html(html_data);
	            }
	            if(response.status == '3')
				{
					if(response.zipcode_error != '')
				    {
				      	$('.zipcode_modal_error').html(response.zipcode_error);
				    }
				    else
				    {
				      	$('.zipcode_modal_error').html('');
				    }
				}    	

	        }
	    });
	}
	var loginform = $(".checkLogin");
	$(".smtlogin").click(function(e)
	{
		e.preventDefault();
		$('#loader').show();
		$.ajax({
	        type:"POST",
	        url:loginform.attr("action"),
	        data:loginform.serialize(),
	        dataType: "json",
	        success: function(response)
	        {
	        	$('#loader').hide();
	        	if(response.status == '1')
	            {
	            	$('.message').html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+response.msg+'</div>');
	            	setTimeout(function() { $(".alert-success").hide(); }, 3000);

	            	window.setTimeout(function () 
	            	{
				        location.reload(true);
				    }, 4000);
	            	
	            }
	            else if(response.status == '3')
				{
					if(response.userName_error != '')
				    {
				      	$('#userName_error').html(response.userName_error);
				    }
				    else
				    {
				      	$('#userName_error').html('');
				    }
				    if(response.password_error != '')
				    {
				      	$('#password_error').html(response.password_error);
				    }
				    else
				    {
				      	$('#password_error').html('');
				    }
				}    
				else
				{
            		$('.message').html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+response.msg+'</div>');	
            		setTimeout(function() { $(".alert-success").hide(); }, 8000);
            	}	
	        }
	    });
	});
	$(".forgetpass").click(function()
	{
		$('.checkLogin').hide();
		$('.changepass').show();
	});
	$('.login').click(function()
	{
		$('.checkLogin').show();
		$('.changepass').hide();
	});
	var changepassform = $(".changepass");
	$(".smtfp").click(function(e)
	{
		e.preventDefault();
		$('#loader').show();
		$.ajax({
	        type:"POST",
	        url:changepassform.attr("action"),
	        data:changepassform.serialize(),
	        dataType: "json",
	        success: function(response)
	        {
	        	$('#loader').hide();
	        	if(response.status == '1')
	            {
	            	$('.message').html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+response.msg+'</div>');
	            	setTimeout(function() { $(".alert-success").hide(); }, 8000);

	            	$('.newpass').show();
	            	$('.changepass').hide();

	            	$('.otp_field').val(response.otp);
	            	$('.timeFrom_field').val(response.timeFrom);
	            	$('.userData_field').val(response.userData);
	            	$('.userDataType_field').val(response.userDataType);
	            	$('.userId_field').val(response.userId);
	            	$('.usersUId_field').val(response.usersUId);
	            }
	            else if(response.status == '3')
				{
					if(response.userData_error != '')
				    {
				      	$('.userData_error').html(response.userData_error);
				    }
				    else
				    {
				      	$('.userData_error').html('');
				    }
				}    
				else
				{
            		$('.message').html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+response.msg+'</div>');	
            		setTimeout(function() { $(".alert-success").hide(); }, 8000);
            	}	
	        }
	    });
	});
	var newpassform = $(".newpass");
	$(".smtnewpass").click(function(e)
	{
		e.preventDefault();
		$('#loader').show();
		$.ajax({
	        type:"POST",
	        url:newpassform.attr("action"),
	        data:newpassform.serialize(),
	        dataType: "json",
	        success: function(response)
	        {
	        	$('#loader').hide();
	        	if(response.status == '1')
	            {
	            	$('.message').html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+response.msg+'</div>');
	            	setTimeout(function() { $(".alert-success").hide(); }, 3000);

	            	window.setTimeout(function () 
	            	{
				        location.reload(true);
				    }, 4000);
	            }
	            else if(response.status == '3')
				{
					if(response.newPassword_error != '')
				    {
				      	$('.newPassword_error').html(response.newPassword_error);
				    }
				    else
				    {
				      	$('.newPassword_error').html('');
				    }
				    if(response.newPassword_confirmation_error != '')
				    {
				      	$('.newPassword_confirmation_error').html(response.newPassword_confirmation_error);
				    }
				    else
				    {
				      	$('.newPassword_confirmation_error').html('');
				    }
				}    
				else
				{
            		$('.message').html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+response.msg+'</div>');	
            		setTimeout(function() { $(".alert-success").hide(); }, 8000);
            	}	
	        }
	    });
	});
});