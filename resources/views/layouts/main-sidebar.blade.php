<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">

                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="{{ route('home') }}"><i class="ti-home"></i><span class="right-nav-text">
                                الرئيسية</span> </a>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">البيانات الاساسية</li>
                    <!-- menu item Elements-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                            <div class="pull-left"><i class="ti-user"></i><span class="right-nav-text">المسؤولين</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('admins.index') }}">معالجة بيانات المسؤولين</a></li>

                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements2">
                            <div class="pull-left"><i class="ti-user"></i><span class="right-nav-text">الإعتمادات</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements2" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('credits.index') }}">معالجة بيانات الإعتمادات</a></li>

                        </ul>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">البيانات الإضافية</li>
                    <!-- menu item Elements-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#element">
                            <div class="pull-left"><i class="ti-harddrives"></i><span
                                    class="right-nav-text">المرسلين</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="element" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('sections.index') }}">معالجة بيانات المرسلين</a></li>

                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#element3">
                            <div class="pull-left"><i class="ti-archive"></i><span
                                    class="right-nav-text">العملات</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="element3" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('banks.index') }}">معالجة بيانات العملات</a></li>

                        </ul>
                    </li>
                    <!-- menu item calendar-->
<!--
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements3">
                            <div class="pull-left"><i class="fa fa-puzzle-piece"></i><span
                                    class="right-nav-text">المنتجات</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements3" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('products.index') }}">معالجة بيانات المنتجات</a></li>
                        </ul>
                    </li>
                -->

                    <!-- menu item mailbox-->






                    <!-- menu item Custom pages-->

                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================-->
