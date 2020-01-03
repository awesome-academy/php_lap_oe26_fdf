<div id="header">
    <div class="header-top" >
        <div class="container">
            <div class="pull-left auto-width-left">
                <ul class="top-menu menu-beta l-inline">
                    <li>
                        <a href="{{ route('contact') }}">
                            <i class="fa fa-home"></i>
                            {{ trans('header.address') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('index') }}">
                            <i class="fa fa-phone"></i>
                            {{ trans('header.phone') }}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="pull-right auto-width-right">
                <ul class="top-details menu-beta l-inline">
                    <li>
                        <a href="#"><i class="fa fa-user"></i>
                            {{ trans('header.acount') }}
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            {{ trans('header.signin') }}
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            {{ trans('header.signup') }}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="header-body">
        <div class="container beta-relative">
            <div class="pull-left">
                <a href="#" id="logo">
                    <img src="{{ config('config.logo-cake') }}" height="100px" alt="">
                </a>
            </div>
            <div class="pull-right beta-components space-left ov">
                <div class="space10">&nbsp;</div>
                <div class="beta-comp">
                    <form role="search" method="get" id="searchform" action="/">
                        <input type="text" value="" name="search"/>
                        <button class="fa fa-search" type="submit" id="searchsubmit">
                        </button>
                    </form>
                </div>
                <div class="beta-comp">
                    <div class="cart">
                        <div class="beta-select">
                            <i class="fa fa-shopping-cart"></i>
                            <i class="fa fa-chevron-down"></i>
                        </div>
                        <div class="beta-dropdown cart-body">
                            <div class="cart-item">
                                <a class="cart-item-delete" href=""><i class="fa fa-times"></i></a>
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img src="" alt="">
                                    </a>
                                    <div class="media-body">
                                        <span class="cart-item-title"></span>
                                        <span class="cart-item-amount">
                                            <span>

                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-caption">
                                <div class="cart-total text-right">
                                    {{ trans('message.total') }}
                                    <span class="cart-total-value"></span>
                                </div>
                                <div class="clearfix"></div>
                                <div class="center">
                                    <div class="space10">&nbsp;</div>
                                    <a href="" class="beta-btn primary text-center">
                                        {{ trans('message.checkout') }}
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="visible-xs clearfix"></div>
            <nav class="main-menu">
                <ul class="l-inline ov">
                    <li>
                        <a href="{{ route('index') }}">{{ trans('header.index') }}</a>
                    </li>
                    <li>
                        <a href="#">{{ trans('header.category') }}</a>
                        <ul class="sub-menu">
                            <li><a href=""></a></li>
                            <li><a href=""></a></li>
                            <li><a href=""></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('about') }}">{{ trans('header.about') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}">{{ trans('header.contact') }}</a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </nav>
        </div>
    </div>
</div>
