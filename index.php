
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Easy Sanskrit - Login | Sign Up</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
    var file_code="a";
</script>
<script src="https://www.gstatic.com/firebasejs/5.4.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.6/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.4.0/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.6/firebase-auth.js"></script>
<script src="data/firebase_js.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="data/indexstyle.css">
<link href="https://fonts.googleapis.com/css?family=Cuprum" rel="stylesheet">
<style>
    
    #left_c 
    {
        width:70%;
        float:left;
        display:block;
        line-height:30px;

    }

    #right_c 
    {
        width:30%;
        float:right;
        display:block;
        padding:;
    }
    @media screen and (max-width:850px) {
     #left_c 
    {
        width:100% !important;
        float:none !important;
    }
    #right_c 
    {
        width:100% !important;
        float:none !important;
    }
    }
</style>

 
<script>
  
    function login() 
    {
        var user_login_email = document.getElementById("reginput_email").value;
        var user_login_password = document.getElementById("reginput_pass").value;
        if ((user_login_email ===""||  user_login_password==="") || (user_login_email ==="" && user_login_password==="")) 
        {
            document.getElementById("err_show").innerHTML="Please fill all fields.";
            if (user_login_email ==="") 
            {
                document.getElementById("reginput_email").focus();
            } else {
                document.getElementById("reginput_pass").focus();
            }

        } else
         {

            function validateEmail(email_passed) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(email_passed).toLowerCase());
                /*reference stackoverflow*/ 
            }
            if (validateEmail(user_login_email)) 
            {
                firebase.auth().signInWithEmailAndPassword(user_login_email, user_login_password).catch(function(error) {
                    // Handle Errors here.
                    var errorCode = error.code;
                    var errorMessage = error.message;
                    document.getElementById("reginput_email").focus();
                    document.getElementById("err_show").innerHTML="Try Again!";
                    // ...
                    });
            }
            else 
            {
                document.getElementById("reginput_email").focus();
                document.getElementById("err_show").innerHTML="Enter valid email";
            }
            
         }
    }
    function triggers(y) {
    if (y==="tril") 
    {
        var q = "tris";  
    }
    if (y==="tris") 
    {
        var q = "tril";
    }
    document.getElementById(y).style.backgroundColor="#ececce";
    document.getElementById(y+"-c").style.display="block";
    document.getElementById(q+"-c").style.display="none";
    document.getElementById(q).style.backgroundColor="#ffffff";
    document.getElementById("tris-fp").style.cssText="display:none !important;";
}

    function signUpUser() {
        document.getElementById("tris-c").style.display="block !important";
        var user_s_email = document.getElementById("reginput_s_email").value;
        var user_s_password = document.getElementById("reginput_s_pass").value;
        if (user_s_email===""||user_s_password==="") 
        {
            document.getElementById("err_show").innerHTML="Please fill all fields.";
            document.getElementById("reginput_s_name").focus();

        } else
         {

            function validateEmail(email_passed) {
                var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return regex.test(String(email_passed).toLowerCase());
                /*reference stackoverflow*/ 
            }
            if (validateEmail(user_s_email)) 
            {
                    if (user_s_password.length>=6) 
                    {
                        
                        firebase.auth().createUserWithEmailAndPassword(user_s_email, user_s_password).catch(function(error) {
                                // Handle Errors here.
                                var errorCode = error.code;
                                var errorMessage = error.message;
                                if (errorCode=="auth/email-already-in-use") {
                                        document.getElementById("err_show").innerHTML="Use another email";
                                }
                                
                                });
                                                                
                                                    
                           
                    }   
                    else 
                    {
                        document.getElementById("err_show").innerHTML="Check Password";
                    }
            }
            else 
            {
                document.getElementById("reginput_s_email").focus();
                document.getElementById("err_show").innerHTML="Enter valid email";
            }
            
         }
        };

        function checkpassstrng(pass) 
        {
            
            if (pass.length>=6) 
            {
                
                document.getElementById('fp2').innerHTML="<div style='color:green;'>Strong Password</div>";    
            }    
            else 
            {
                document.getElementById('fp2').innerHTML="<div style='color:red;'>Minimum 6 characters</div>";
            }
        };
        function fp()
        {
            document.getElementById('tris').style.backgroundColor="#ffffff";
            document.getElementById("tris-c").style.display="none";
            document.getElementById("tril-c").style.display="none";
            document.getElementById("tril").style.backgroundColor="#ffffff";
            document.getElementById("err_show").innerHTML="";
            document.getElementById("tris-fp").style.cssText="display:block !important;margin-top:20px;";
        };
        function resetpassword() 
        {
            email_for_fp=document.getElementById("fp_input").value;
            var auth = firebase.auth();
            var emailAddress = email_for_fp;

            auth.sendPasswordResetEmail(emailAddress).then(function() {
                document.getElementById("tris-fp").innerHTML="<div style='background-color:green;padding:15px;color:#ffffff;border-radius:5px;'>Reset password link has been sent to your email. Please reset password and login again.</div>";
            }).catch(function(error) {
                document.getElementById("tris-fp-error").innerHTML="<div style='color:red;'>Try Again!</div>";
            });

        };

</script>
</head>
<body>
    
    <div id="L"></div>
    <div id="containermain">
        <div id='login_signup' style="height:378px !important">
            <div id="lsi">
                <div id="hd">
                    <div style="font-family: 'Lohit Devanagari','Arial';color:#000000;">Easy संस्कृत:</div>    
                </div>
                <div id="triggers_d" style="margin-top:20px !important;height:45.5px;border-bottom:1px solid #aaaaaa;">                    
                    <div id="tril" class="ac-t" onclick="triggers('tril')"  style="background-color:#ececce;border:1px solid #aaaaaa;">
                        Login
                    </div>
                    <div id="tris"  onclick="triggers('tris');" style="border:1px solid #aaaaaa;">
                        Sign Up
                    </div>
                    <div id="err_show" style="float:right;color:#ff0000;margin-top:12px;">
                        
                    </div>
                </div>
                <div id="tril-c" style="">
                       <input type="email" id="reginput_email"  placeholder="Email" maxlength="100">
                       <input type="password" id="reginput_pass"   placeholder="Password" maxlength="100">
                       <button id="regbtn" onclick="login()">Login &raquo;</button>
                   <div id="fp" onclick="fp();">
                       Forgot Password?
                   </div>
                   <div style="width:100%;margin-top:30px;">
                            Today's Quote : जननी जन्मभूमिश्च स्वर्गादपि गरीयसी ।।
                    </div>
                </div>
                <div id="tris-c" style="display:none;">
                    <div style="margin-top:20px;">
                        Sign Up for Easy Sanskrit and enjoy easy learning !
                    </div>
                    <input type="text" id="reginput_s_email" placeholder="Email" maxlength="50">
                    <input type="password" id="reginput_s_pass" placeholder="New Password" onkeyup="checkpassstrng(this.value);" maxlength="50">
                    <div style="margin-top:10px;font-size:10pt;">
                        By clicking below button you agree our terms and conditions
                    </div>
                    <button id="regbtn" onclick="signUpUser()">Sign Up &raquo;</button>
                    <div id="fp2" style="float:right;margin-top:-30px;"></div>
                </div>
                <div style="display:none;" id="tris-fp">
                    <div id="tris-fp-error">

                    </div>
                    Don't worry! We will fix it.
                    <br>
                    Please enter your registered email here, we will send a password reset link.
                    <input type="text" id="fp_input" placeholder="Enter email here..." maxlength="50" style="width:90% !important;margin-top:15px;border-radius:5px;border:1px solid #aaaaaa;padding:12px 5%;font-size:12pt;display:block;">
                    <button id="regbtn" onclick="resetpassword()">Send Reset Link &raquo;</button>
                </div>
                
            </div>
            
        </div>
        
        <div id="login_signup_right" style="text-align:justified;">
            <div style="margin:25px;margin-top:20px;font-size:12pt;">
                <div style="font-size:40pt;">
                    संस्कृतः सुलभ अस्ति !!
                </div>
                <div id="left_c">
                    <br><br><b>Yes</b>, we are made to prove it. We deliver teaching to make you read, write and understand Sanskrit. With Easy Sanskrit, learning Sanskrit is fun and addictive. Play quizzes, compete with friends and get better at Sanskrit. Bite-sized lessons that can be done anywhere, anytime. Specially designed in accordance with the Sanskrit course at <b><i>IIT Gandhinagar</i></b>.<br>
                    <div style=" font-family: 'Cuprum', sans-serif;font-size:20px;margin-top:20px;"> 30+ Chapters | 40+ Quizzes | Free Forever </div>
                </div>
                <div id="right_c"> 
                    <!--div style="width:100%;height:100px;background-color:#000;"></div-->
                </div>                
                <br><br>
                
            </div>
            
        </div>
        
    </div>
    
</body>
</html>
