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

                    {{-- @if (Auth::guard('admin')->user()->id == '1' || AdminHelper::hasPermission([15,16])) --}}
                        <div class="pcoded-navigatio-lavel">Master Settings</div>
                        {{-- @if (Auth::guard('admin')->user()->id == '1')
                            <li class="{{ AdminHelper::menu(2,['users'])[2] }}">
                                <a href="{{ CommonHelper::admin('users') }}">
                                    <span class="pcoded-micon"><i class="fa fa-user-secret"></i></span>
                                    <span class="pcoded-mtext">Manage Admin</span>
                                </a>
                            </li>
                        @endif --}}
                        {{-- @if (AdminHelper::hasPermission([15])) --}}
                            {{-- <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu {{ AdminHelper::menu(2,['cms'])[2] }}">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="fa fa-snowflake-o"></i></span>
                                        <span class="pcoded-mtext">CMS</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="{{ AdminHelper::menu(3,['social-media'])[1] }}">
                                            <a href="{{ CommonHelper::admin('cms/social-media') }}">
                                                <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                                <span class="pcoded-mtext">Social media links</span>
                                            </a>
                                        </li>
                                        <li class="{{ AdminHelper::menu(3,['pages'])[1] }}">
                                            <a href="{{ CommonHelper::admin('cms/pages') }}">
                                                <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                                <span class="pcoded-mtext">Pages</span>
                                            </a>
                                        </li>
                                        <li class="{{ AdminHelper::menu(3,['blogs'])[1] }}">
                                            <a href="{{ CommonHelper::admin('cms/blogs') }}">
                                                <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                                <span class="pcoded-mtext">Blogs</span>
                                            </a>
                                        </li>
                                        <li class="{{ AdminHelper::menu(3,['infoicons'])[1] }}">
                                            <a href="{{ CommonHelper::admin('cms/infoicons') }}">
                                                <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                                <span class="pcoded-mtext">Manage Info Icons</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul> --}}
                        {{-- @endif --}}
                        {{-- @if (AdminHelper::hasPermission([16])) --}}
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu {{ AdminHelper::menu(2,['master'])[2] }}">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="fa fa-snowflake-o"></i></span>
                                        <span class="pcoded-mtext">Masters</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        {{-- <li class="{{ AdminHelper::menu(3,['bank'])[1] }}">
                                            <a href="{{ CommonHelper::admin('master/bank') }}">
                                                <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                                <span class="pcoded-mtext">Bank</span>
                                            </a>
                                        </li>
                                        <li class="{{ AdminHelper::menu(3,['banktype'])[1] }}">
                                            <a href="{{ CommonHelper::admin('master/banktype') }}">
                                                <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                                <span class="pcoded-mtext">Type of Account</span>
                                            </a>
                                        </li>
                                        <li class="{{ AdminHelper::menu(3,['smtype'])[1] }}">
                                            <a href="{{ CommonHelper::admin('master/smtype') }}">
                                                <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                                <span class="pcoded-mtext">Social Media types</span>
                                            </a>
                                        </li> --}}

                                        <li class="{{ AdminHelper::menu(3,['country'])[1] }}">
                                            <a href="{{ CommonHelper::admin('master/country') }}">
                                                <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                                <span class="pcoded-mtext">Country</span>
                                            </a>
                                        </li>
                                        <li class="{{ AdminHelper::menu(3,['state'])[1] }}">
                                            <a href="{{ CommonHelper::admin('master/state') }}">
                                                <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                                <span class="pcoded-mtext">State</span>
                                            </a>
                                        </li>
                                        <li class="{{ AdminHelper::menu(3,['city'])[1] }}">
                                            <a href="{{ CommonHelper::admin('master/city') }}">
                                                <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                                <span class="pcoded-mtext">City</span>
                                            </a>
                                        </li>
                                        <li class="{{ AdminHelper::menu(3,['sectors'])[1] }}">
                                            <a href="{{ CommonHelper::admin('master/sectors') }}">
                                                <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                                <span class="pcoded-mtext">Sectors</span>
                                            </a>
                                        </li>
                                        <li class="{{ AdminHelper::menu(3,['investortype'])[1] }}">
                                            <a href="{{ CommonHelper::admin('master/investortype') }}">
                                                <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                                <span class="pcoded-mtext">Investor Type</span>
                                            </a>
                                        </li>
                                        <li class="{{ AdminHelper::menu(3,['instrument-type'])[1] }}">
                                            <a href="{{ CommonHelper::admin('master/instrument-type') }}">
                                                <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                                                <span class="pcoded-mtext">Instrument Type</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        {{-- @endif --}}
                        @if (Auth::guard('admin')->user()->id == '1')
                            {{-- <li class="{{ AdminHelper::menu(2,['memberships'])[2] }}">
                                <a href="{{ CommonHelper::admin('memberships') }}">
                                    <span class="pcoded-micon"><i class="fa fa-eject"></i></span>
                                    <span class="pcoded-mtext">Manage Membership</span>
                                </a>
                            </li> --}}
                            <li class="{{ AdminHelper::menu(2,['settings'])[2] }}">
                                <a href="{{ CommonHelper::admin('settings') }}">
                                    <span class="pcoded-micon"><i class="fa fa-cog fa-spin"></i></span>
                                    <span class="pcoded-mtext">Settings</span>
                                </a>
                            </li>
                        @endif
                    {{-- @endif --}}

                </ul>
            </div>
        </nav>
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
