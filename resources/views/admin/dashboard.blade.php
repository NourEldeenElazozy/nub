<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>الرئيسية</title>
    @include('layouts.head')

</head>

<body>

    <div class="wrapper">

        <!--=================================
 preloader -->

        <div id="pre-loader">
            <img src="assets/images/pre-loader/loader-01.svg" alt="">
        </div>

        <!--=================================
 preloader -->

        @include('layouts.main-header')

        @include('layouts.main-sidebar')

        <!--=================================
 Main content -->
        <!-- main-content -->
        <div class="content-wrapper">
            <div class="page-title">
                <div class="row" style="display: grid; align-items: center; justify-content: center;">
                    <div class="col">
                    <h5 class="mb-0">مصرف الإتحاد الوطني</h5>
                </div>
            </div>
            <br>
                <div class="row" style="display: grid; align-items: center; justify-content: center;">
                    <div class="col-sm-6">
                        <img src="assets\images\admins\logo.jpg" alt="Girl in a jacket" width="300" height="300" class="center">
                    </div>

            </div>
            <br>
        </div>
            <!-- widgets -->
            <div class="row d-flex justify-content-center">
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-danger">
                                        <i class="fa fa-bar-chart-o highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">إجمالي عدد الإعتمادات</p>
                                    <h4>4000 اعتماد</h4>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-warning">
                                        <i class="fa fa-user highlight-icon"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">المرسلين</p>
                                    <h4>200 مرسل</h4>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>


            {{-- <div class=" mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class=" card-title d-flex justify-content-between">
                            <h5>اخر 5 طلبيات</h5>
                        </div>
                        <ul class="list-unstyled ">
                            @forelse ($orders as $order)
                                <li class="mb-20">
                                    <div class="d-flex">
                                        <div class="ms-3 w-100">
                                            <h6 class="mt-0 mb-0">{{ $order->productRel->name }}</h6>
                                            <p>{{ $order->userRel->phone }} رقم هاتف المستخدم : </p>
                                        </div>
                                    </div>
                                    <div class="divider dotted mt-20"></div>
                                </li>
                            @empty
                                لايوجد مواد مشترك بها حاليا
                            @endforelse

                        </ul>
                    </div>
                </div>
            </div> --}}
            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('layouts.footer-scripts')

</body>

</html>
