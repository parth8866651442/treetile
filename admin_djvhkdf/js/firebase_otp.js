	//Configuraion of firebase Account
	var firebaseConfig = {
		apiKey: "AIzaSyBao5UcZ-ACaX6MeFVvICdV_NlYETnuZ7A",
        authDomain: "developer-gami.firebaseapp.com",
        databaseURL: "https://developer-gami.firebaseio.com",
        projectId: "developer-gami",
        storageBucket: "developer-gami.appspot.com",
        messagingSenderId: "278267331398",
        appId: "1:278267331398:web:76504f4425611e861ddb47",
        measurementId: "G-PWS2TERM7W"
	};
    //initialize Setting
	firebase.initializeApp(firebaseConfig);

	//Send otp in MobileNo
	var phoneNo = $('#phone_no').val();
	window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container'); 
	firebase.auth().signInWithPhoneNumber(phoneNo, window.recaptchaVerifier) 
	.then(function(confirmationResult) { 
		$('.verify_div').show();
		$('#recaptcha-container').hide();
	window.confirmationResult = confirmationResult; 
		a(confirmationResult); 
	}); 
	//Verify in Otp
	var myFunction = function() { 
		window.confirmationResult.confirm(document.getElementById("verificationcode").value) 
		.then(function(result) { 

			login_user(document.getElementById("loginUserId").value);

		}, function(error) { 
			alert('Please enter correct OTP.'); 
		}); 
	};

	$(document).ready(function(){
		$('#login1').click(function(){
		    var valOk = validate();
		   
		    if(valOk == true)
		    {
				$.ajax({
		            url: 'login_check.php',
		            type: "POST",
		            data : {"text":document.admin_login.text.value,"password": document.admin_login.password.value,'action':'check_user' },
		            success : function(data){
		            	if(data.status =='success')
		            	{
		            		$('#otp_div').show();
		            		$('#phone_no').val('+91'+data.phoneno);
		            		$('#loginUserId').val(data.id);
		            	}
		            	else
		            	{
		            		alert("User name or password is incorrect !");
		            	}
		            }
		        });
	    	}
		});
});

function login_user(uid)
{
	if(uid !=='')
	{
		$.ajax({
            url: 'login_check.php',
            type: "POST",
            data : {"userid":uid,'action':'login_user'},
            success : function(data){
            	window.location.href="index.php";
            }
        });
	}
}