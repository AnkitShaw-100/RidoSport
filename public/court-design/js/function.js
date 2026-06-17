function validate_contact(){
	
var name=$('#txtname').val();
var name=name.trim();
var mobile=$('#txtmobile').val();
var mobile=mobile.trim();
var email=$('#txtemailid').val();
var email=email.trim();
var comments=$('#comments').val(); 
var comments=comments.trim();
 
  if(name==''){
	 
	 $('#err_msg').html('Please Enter Your Name.');
	 $('#txtname').css('border','1px solid #FF0000');
	 $('#txtname').css('box-shadow','0 0 3px 0 #FF0000');
     $('#txtname').focus();
	   return false;
	 }else{
	  $('#err_msg').html('');
	  $('#txtname').css('border','');
	  $('#txtname').css('box-shadow','');
	  }

		
	if(mobile==''){
	 
	 $('#err_msg').html('Please Enter Mobile No.');
	 $('#txtmobile').css('border','1px solid #FF0000');
	 $('#txtmobile').css('box-shadow','0 0 3px 0 #FF0000');
     $('#txtmobile').focus();
	   return false;
	 }else{
		 
    var filter=/^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
  if(!mobile.match(filter)){
   
     $('#err_msg').html('Please Enter Valid Mobile No.');
	 $('#txtmobile').css('border','1px solid #FF0000');
	 $('#txtmobile').css('box-shadow','0 0 3px 0 #FF0000');
     $('#txtmobile').focus();
	   return false;
  }else{
	  $('#err_msg').html('');
	  $('#txtmobile').css('border','');
	  $('#txtmobile').css('box-shadow','');
	  }
		 
	}
		   
	 if(email==''){
	 
	 $('#err_msg').html('Please Enter Email ID.');
	 $('#txtemailid').css('border','1px solid #FF0000');
	 $('#txtemailid').css('box-shadow','0 0 3px 0 #FF0000');
     $('#txtemailid').focus();
	   return false;
	 }else{
		 
		  var emailformat=/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})$/;
  if(!email.match(emailformat)){
   
     $('#err_msg').html('Please Enter Valid Email ID.');
	 $('#txtemailid').css('border','1px solid #FF0000');
	 $('#txtemailid').css('box-shadow','0 0 3px 0 #FF0000');
     $('#txtemailid').focus();
	   return false;
  }else{
	  $('#err_msg').html('');
	  $('#txtemailid').css('border','');
	  $('#txtemailid').css('box-shadow','');
	  }
		 
	}
		   
	
	  if(comments==''){
	 
	 $('#err_msg').html('Please Enter Comment.');
	 $('#comments').css('border','1px solid #FF0000');
	 $('#comments').css('box-shadow','0 0 3px 0 #FF0000');
     $('#comments').focus();
	   return false;
	 }else{
	  $('#err_msg').html('');
	  $('#comments').css('border','');
	  $('#comments').css('box-shadow','');
	}
		 

	
	       var captcha = document.getElementById("captcha").value;
            captcha.trim();
			
			var captcha_js = document.getElementById("captcha_js").value;
			captcha_js.trim();


            if (captcha == "Enter the code shown") {
				 $('#err_msg').html('Please enter captcha.');
				 $('#captcha').css('border','1px solid #FF0000');
				 $('#captcha').css('box-shadow','0 0 3px 0 #FF0000');
				 $('#captcha').focus();
				   return false;
			  }else{
				  $('#err_msg').html('');
				  $('#captcha').css('border','');
				  $('#captcha').css('box-shadow','');
				 }
     
            if (captcha != captcha_js) {
				$('#err_msg').html('Please enter valid captcha.');
				 $('#captcha').css('border','1px solid #FF0000');
				 $('#captcha').css('box-shadow','0 0 3px 0 #FF0000');
				 $('#captcha').focus();
				   return false;
			  }else{
				  $('#err_msg').html('');
				  $('#captcha').css('border','');
				  $('#captcha').css('box-shadow','');
				 }
				return true;
}



function randomString() {
            var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
            var string_length = 4;
            var randomstring = '';
            for (var i = 0; i < string_length; i++) {
                var rnum = Math.floor(Math.random() * chars.length);
                randomstring += chars.substring(rnum, rnum + 1);
            }
            //document.randform.randomfield.value = randomstring;
            document.getElementById("captcha_js_put").innerHTML = randomstring;
            document.getElementById("captcha_js").value = randomstring;
        }
