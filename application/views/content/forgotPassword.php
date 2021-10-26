<html>

    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->
        <style type="text/css">
            body {
            margin: 0;
            padding: 0;
            background-color: #17a2b8;
            height: 100vh;
            }
            #login .container #login-row #login-column #login-box {
            margin-top: 80px;
            max-width: 600px;
            height: 320px;
            border: 1px solid #9C9C9C;
            background-color: #EAEAEA;
            }
            #login .container #login-row #login-column #login-box #login-form {
            padding: 20px;
            }
            #login .container #login-row #login-column #login-box #login-form #register-link {
            margin-top: -85px;
            }
        </style>
    </head>
    <body>
        <div id="login">
            <h3 class="text-center text-white pt-5">DRTB Forgot Password Page</h3> 
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" action="" method="post">
                                <h3 class="text-center text-info pb-2">Set New Password</h3>
                                <div class="form-group">
                                    <label for="password" class="text-info ">New Password:</label><br>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-info">Confirm Password:</label><br>
                                    <input type="text" name="cpassword" id="cpassword" class="form-control">
                                </div>
                                <div class="form-group">
                                    <span id="error_msg" style="color: red; text-align: center;"></span>
                                    <br>
                                    <input type="button" name="submit" class="btn btn-info btn-md float-right" value="submit" onclick="saveData();">
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript">

            function form_validation(){
                let password=document.getElementById("password").value;    
                let cpassword=document.getElementById("cpassword").value;
                    if(password==""){
                        document.getElementById('error_msg').innerHTML ="Please Enter Password";
                        $("#password").focus();
                        return 0;
                    }
                    else if(cpassword==""){
                        document.getElementById('error_msg').innerHTML ="Please Enter Confirm Password";
                        $("#cpassword").focus();
                        return 0;
                    }


                return 1;  
            }

            function saveData(){

                if(form_validation()){
                    let password=document.getElementById("password").value;    
                    let cpassword=document.getElementById("cpassword").value;
                    let token="<?php echo $token?>";

                    if(password == cpassword ){
                        if(token!=null && token!=""){
                            $.ajax({
                                url:'<?=base_url()?>ResetPasswordController/savePassword',
                                type:"POST",
                                data:{token:token,password:password},
                                success:function(data) {  
                                    
                                    if(data.trim()=="success"){
                                            alert("Password saved successfully");
                                            
                                            document.getElementById('error_msg').innerHTML ="";
                                            document.getElementById("password").value=""; 
                                            document.getElementById("cpassword").value="";
                                        }
                                    else{
                                        alert("Password Not save");

                                    }
                                },
                                error: function(XMLHttpRequest, textStatus, errorThrown) {
                                    console.log(XMLHttpRequest);
                                    console.log(errorThrown);
                                }
                            });
                        }
                        else{
                            document.getElementById('error_msg').innerHTML = "Something went wrong...!!";
                        }
                    }
                    else{
                        document.getElementById('error_msg').innerHTML = "Both password must be same";
                        
                    }
                }

            } 

        </script>


    </body>

</html>
