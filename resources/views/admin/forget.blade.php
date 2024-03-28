
<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ Common::setting('app_name') }} | Forget Password</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="headers/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="headers/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="headers/favicon-16x16.png">
    <link rel="manifest" href="headers/site.webmanifest">
    <link rel="mask-icon" href="headers/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    
    <script type="text/javascript" src="{{ url('themes/admin/bower_components/jquery/js/jquery.min.js') }}"></script>
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ url('themes/admin/bower_components/bootstrap/css/bootstrap.min.css') }}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ url('themes/admin/assets/icon/themify-icons/themify-icons.css') }}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ url('themes/admin/assets/icon/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('themes/admin/assets/icon/icofont/css/icofont.css') }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ url('themes/admin/assets/css/style.css') }}">
    <!-- PNotify -->
    <link rel="stylesheet" type="text/css" href="{{ url('themes/admin/bower_components/pnotify/css/pnotify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('themes/admin/bower_components/pnotify/css/pnotify.brighttheme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('themes/admin/bower_components/pnotify/css/pnotify.buttons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('themes/admin/bower_components/pnotify/css/pnotify.history.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('themes/admin/bower_components/pnotify/css/pnotify.mobile.css') }}">
</head>

<body class="fix-menu">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    
                        <form class="md-float-material form-material" action="#" method="post" id="login" >
                            <div class="text-center">
                                <img src="<?php echo url('themes/logos/logo.png'); ?>" alt="" style="width: 100px;">                       
                            </div>
                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center">Reset Password</h3>
                                        </div>
                                        <div class="col-md-12">

                                            <div class="alert alert-danger icons-alert" style="margin-bottom: 0px; display: none;" id="error">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-top: 9px;">
                                                 <i class="icofont icofont-close-line-circled"></i>
                                                </button>
                                                <p style="font-weight: bold; margin: 9px 0;" id="error-message">
                                                </p>
                                            </div>

                                            <div class="alert alert-success icons-alert" style="margin-bottom: 0px; display: none;" id="success">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-top: 9px;">
                                                 <i class="icofont icofont-close-line-circled"></i>
                                                </button>
                                                <p style="font-weight: bold; margin: 9px 0;" id="success-msg">
                                                    
                                                </p>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="email" name="email" class="form-control" placeholder="Email" autocomplete="off" autofocus>
                                    </div>
                                    <div class="form-group form-primary after-code" style="display:none;">
                                        <input type="text" name="otp" class="form-control" placeholder="Verification Code" autocomplete="off" >
                                    </div>
                                    <div class="form-group form-primary after-code" style="display:none;">
                                        <input type="password" name="pass" class="form-control" placeholder="Password" autocomplete="off">
                                    </div>
                                    <div class="form-group form-primary after-code" style="display:none;">
                                        <input type="password" name="cpass" class="form-control" placeholder="Confirm Password" autocomplete="off">
                                    </div>
                                    <div class="row m-t-25">
                                        <div class="col-12">
                                            <div class="checkbox-fade fade-in-primary d-">
                                                <a href="#" class="text-right f-w-600" style="display:none;" id="verAgain">Send verification code again</a>
                                            </div>
                                            <div class="forgot-phone text-right f-right">
                                                <a href="<?= url(Common::admin('login')); ?>" class="text-right f-w-600"> or login here</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-30">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20" style="font-size: 18px" id="sign-in-button">
                                                Send verification code
                                            </button>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </form>
                        <!-- end of form -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>

    <script>
    $(document).ready(function() {
        isSent = false;
        user = "";
        $('#login').submit(function(event) {
            event.preventDefault();
            if (!isSent) {
                if ($('input[name=email]').val() != "") {
                    $("#sign-in-button").attr("disabled",true);
                    $("#sign-in-button").html('<i class="fa fa-circle-o-notch fa-spin"></i> Checking...');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url : "<?= url(Common::admin('forget-check')); ?>",
                        dataType: "JSON",
                        data : "email="+$('input[name=email]').val()+"&_token=<?= csrf_token() ?>",
                        success: function(out)
                        {
                            if (out._return) {
                                showSuccess(out.msg);
                                $('input[name=otp]').val('');
                                $('input[name=pass]').val('');
                                $('input[name=cpass]').val('');
                                $("#sign-in-button").html('Reset Password');
                                $("#sign-in-button").removeAttr("disabled"); 
                                $('.after-code').show();
                                $('input[name=email]').hide();
                                user = out.user;
                                isSent = true;
                                $('#verAgain').show();
                            }else{
                                $('.after-code').hide();
                                $('input[name=email]').show();
                                $("#sign-in-button").html('Send verification code');
                                $("#sign-in-button").removeAttr("disabled"); 
                                showError(out.msg);
                            }
                        }
                    });
                }else{
                    $('.after-code').hide();
                    $('input[name=email]').show();
                    showError('Email is required');
                }
            }else{
                if ($('input[name=otp]').val() == "") {
                    showError('Verification code is required');   
                }else if($('input[name=pass]').val() == ""){
                    showError('Password is required');   
                }else if($('input[name=cpass]').val() == ""){
                    showError('Confirm Password is required');   
                }else if($('input[name=cpass]').val() != $('input[name=pass]').val()){
                    showError('Password and Confirm Password is not match');   
                }else{
                    hideMsges();
                    $("#sign-in-button").attr("disabled",true);
                    $("#sign-in-button").html('<i class="fa fa-circle-o-notch fa-spin"></i> Checking...');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url : "<?= url(Common::admin('reset-password')); ?>",
                        dataType: "JSON",
                        data : "id="+user+"&code="+$('input[name=otp]').val()+"&pass="+$('input[name=pass]').val()+"&_token=<?= csrf_token() ?>",
                        success: function(out)
                        {
                            if (out._return) {
                                showSuccess(out.msg);
                                $('.after-code').hide();
                                $('input[name=email]').hide();
                                $("#sign-in-button").html('<i class="fa fa-circle-o-notch fa-spin"></i> Redirecting...');
                                setTimeout(function(){
                                    window.location = "<?= url(Common::admin('login')) ?>";
                                },1000);
                            }else{
                                $("#sign-in-button").html('Reset Password');
                                $("#sign-in-button").removeAttr("disabled"); 
                                showError(out.msg);
                            }
                        }
                    });
                }
            }
        });
        $('#verAgain').click(function(e){
            e.preventDefault();
            isSent = false;
            hideMsges();
            $('.after-code').hide();
            $('input[name=email]').show();
            $('#login').submit();
        })
    });
    </script>
    <script type="text/javascript" src="{{ url('themes/admin/bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('themes/admin/bower_components/popper.js/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('themes/admin/bower_components/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{ url('themes/admin/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{ url('themes/admin/bower_components/modernizr/js/modernizr.js') }}"></script>
    <script type="text/javascript" src="{{ url('themes/admin/bower_components/modernizr/js/css-scrollbars.js') }}"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="{{ url('themes/admin/assets/js/common-pages.js') }}"></script>

    <!-- pnotify js -->
    <script type="text/javascript" src="{{ url('themes/admin/bower_components/pnotify/js/pnotify.js') }}"></script>
    <script type="text/javascript" src="{{ url('themes/admin/bower_components/pnotify/js/pnotify.desktop.js') }}"></script>
    <script type="text/javascript" src="{{ url('themes/admin/bower_components/pnotify/js/pnotify.buttons.js') }}"></script>
    <script type="text/javascript" src="{{ url('themes/admin/bower_components/pnotify/js/pnotify.confirm.js') }}"></script>
    <script type="text/javascript" src="{{ url('themes/admin/bower_components/pnotify/js/pnotify.callbacks.js') }}"></script>
    <script type="text/javascript" src="{{ url('themes/admin/bower_components/pnotify/js/pnotify.animate.js') }}"></script>
    <script type="text/javascript" src="{{ url('themes/admin/bower_components/pnotify/js/pnotify.history.js') }}"></script>
    <script type="text/javascript" src="{{ url('themes/admin/bower_components/pnotify/js/pnotify.mobile.js') }}"></script>
    <script type="text/javascript" src="{{ url('themes/admin/bower_components/pnotify/js/pnotify.nonblock.js') }}"></script>
    <script type="text/javascript" src="{{ url('themes/admin/bower_components/sweetalert/js/sweetalert.min.js') }}"></script>



    <script type="text/javascript">
        function showError(error) {
            $("#success").hide();
            $("#error-message").html(error);
            $("#error").show();
        }
        function showSuccess(msg) {
            $("#error").hide();
            $("#success").show();
            $('#success-msg').html(msg);
        }
        function hideMsges() {
            $("#error").hide();
            $("#success").hide();
        }
    </script>
</body>

</html>
