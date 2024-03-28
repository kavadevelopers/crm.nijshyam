
<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ CommonHelper::setting('app_name') }} | Admin Login</title>
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
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    
                        <form class="md-float-material form-material" action="#" method="post" id="login" >
                            <div class="text-center">
                                <img src="{{ url('themes/logos/logo.png') }}" alt="" style="width: 100px;">                         
                            </div>
                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center">Sign In</h3>
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
                                                <p style="font-weight: bold; margin: 9px 0;">
                                                    Login Successfull...
                                                </p>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="text" name="username" id="user" class="form-control" placeholder="User Name" autocomplete="off" required autofocus>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="password" name="password" id="pass" class="form-control" placeholder="Password" required autocomplete="off">
                                    </div>
                                    <div class="row m-t-25">
                                        <div class="col-12">
                                            <div class="checkbox-fade fade-in-primary d-" style="display:none;">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span class="text-inverse">Remember me</span>
                                                </label>
                                            </div>
                                            <div class="forgot-phone text-right f-right">
                                                <a href="{{ url(CommonHelper::admin('forget-password')) }}" class="text-right f-w-600"> Forgot
                                                    Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-30">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20" style="font-size: 18px" id="sign-in-button">
                                                <span id="sign-in">Sign in</span>
                                                <span id="sign-in-loader" style="display: none;">
                                                    <i class="fa fa-circle-o-notch fa-spin"></i> Checking...
                                                </span>
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
            $('#login').submit(function(event) {
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var user = $('#user').val();
                var pass = $('#pass').val();
                $.ajax({
                    type: "POST",
                    url : "{{ url(CommonHelper::admin('login')) }}",
                    dataType: "JSON",
                    data : "user="+user+"&pass="+pass+"&_token=<?= csrf_token() ?>",
                    cache : false,
                    beforeSend: function() {
                        $("#sign-in").hide();
                        $("#sign-in-loader").show();
                        $("#sign-in-button").attr("disabled",true);       
                    },      
                    success: function(out)
                    {
                        if(out[0] == '0')
                        {
                            $("#error").hide();
                            $("#success").show();
                            $("#sign-in-loader").html('<i class="fa fa-circle-o-notch fa-spin"></i> Redirecting...');
                            setTimeout(function(){
                                window.location = "<?= url(CommonHelper::admin('dashboard')) ?>";
                            },1000);
                        }
                        else
                        {
                            $("#error-message").html(out[1]);
                            $("#error").show();
                            $("#success").hide();
                            $("#sign-in").show();
                            $("#sign-in-loader").hide();
                            $("#sign-in-button").removeAttr("disabled"); 
                        }
                        
                    }
                });
            });
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
</body>

</html>
