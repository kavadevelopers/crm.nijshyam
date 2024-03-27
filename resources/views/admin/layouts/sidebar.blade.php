<style type="text/css">
.new-mainmenu{
    float: left;
    width: 240px;
    scrollbar-width: none;
    -ms-overflow-style: none;
}
.new-mainmenu::-webkit-scrollbar {
  display: none;
}
.pcoded-inner-navbar {
    height: calc(100% - 80px);
}
</style>

<script type="text/javascript">
    $(document).ready(function($) {
        target = $('.pcoded-inner-navbar .kava-active');
        $('.pcoded-inner-navbar').stop().animate({
                scrollTop: $(target).offset().top - 100
        }, 600, function() {
                //location.hash = target;
        });
    });
</script>

<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <nav class="pcoded-navbar">
            <div class="pcoded-inner-navbar new-mainmenu" style="overflow-y: scroll;">
                <div class="pcoded-navigatio-lavel">Navigation</div>
                <ul class="pcoded-item pcoded-left-item">

                    <li class="{{ AdminHelper::menu(2,['dashboard'])[2] }}">
                        <a href="{{ CommonHelper::admin('dashboard') }}">
                            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                            <span class="pcoded-mtext">Dashboard</span>
                        </a>
                    </li>

                    <div class="pcoded-navigatio-lavel">Master Settings</div>
                    <ul class="pcoded-item pcoded-left-item">
                        <li class="pcoded-hasmenu {{ AdminHelper::menu(2,['master'])[2] }}">
                            <a href="javascript:void(0)">
                                <span class="pcoded-micon"><i class="fa fa-snowflake-o"></i></span>
                                <span class="pcoded-mtext">Masters</span>
                            </a>
                            <ul class="pcoded-submenu">
                                <li class="{{ AdminHelper::menu(3,['products'])[1] }}">
                                    <a href="{{ CommonHelper::admin('master/products') }}">
                                        <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                        <span class="pcoded-mtext">Products</span>
                                    </a>
                                </li>
                                <li class="{{ AdminHelper::menu(3,['source'])[1] }}">
                                    <a href="{{ CommonHelper::admin('master/source') }}">
                                        <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                        <span class="pcoded-mtext">Source</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <li class="{{ AdminHelper::menu(2,['users'])[2] }}">
                        <a href="{{ CommonHelper::admin('users') }}">
                            <span class="pcoded-micon"><i class="fa fa-users"></i></span>
                            <span class="pcoded-mtext">Users</span>
                        </a>
                    </li>
                    @if (Auth::guard('admin')->user()->id == '1')
                        <li class="{{ AdminHelper::menu(2,['settings'])[2] }}">
                            <a href="{{ CommonHelper::admin('settings') }}">
                                <span class="pcoded-micon"><i class="fa fa-cog fa-spin"></i></span>
                                <span class="pcoded-mtext">Settings</span>
                            </a>
                        </li>
                    @endif

                </ul>
            </div>
        </nav>
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
