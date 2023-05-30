<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">



        <style>
            body {
                font-family: 'Nunito', sans-serif;
                /* background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRMOzg5HobyKeJZYD8Lw0jSA0tlvvuo22HGoA&usqp=CAU'); */
                background-image: url({{ URL::asset('/assets/admin/img/dashboard_pic5.jpg') }});
                background-repeat: no-repeat;
                background-size: cover;
                height: 100%;
                /* background-origin: border-box; */
                /* background-position-y: center; */
                /* background-position: center; */
                /* background-position: unset; */
                /* background-position: bottom 50px right 100px; */

            }

/* p {
  background-image: url('dashboard_pic.jpg');
} */
        </style>
    </head>
    <body class="antialiased">






        {{-- <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
          <h3>Buy Borsa for 100.00 ETB</h3>
<form method="POST" action="{{route('payment-mobile')}}" id="paymentForm">
@csrf
    <input type="submit" value="Buy" />
</form>
        </div> --}}
    </body>
</html>


{{--
@php($currency=\App\Models\Business_settings::where(['key'=>'currency'])->first()->value)

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>
        @yield('title')
    </title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <!-- Viewport-->
    {{--<meta name="_token" content="{{csrf_token()}}">--}}
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="shortcut icon" href="favicon.ico">
    <!-- Font -->
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/vendor.min.css">
    <link rel="stylesheet" href="{{asset('assets/admin')}}/vendor/icon-set/style.css">
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/custom.css">
    <!-- CSS Front Template -->
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/theme.minc619.css?v=1.0">

    <style>
        .stripe-button-el {
            display: none !important;
        }

        .razorpay-payment-button {
            display: none !important;
        }
    </style>
    <script
        src="{{asset('assets/admin')}}/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside-mini-cache.js"></script>
    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/toastr.css">

</head>
<!-- Body-->
<body class="toolbar-enabled">
<!-- Page Content-->
<div class="container pb-5 mb-2 mb-md-4">
    <div class="row">
        <div class="col-md-12 mb-5 pt-5">
            <center class="">
                <h1>Payment method</h1>
            </center>
        </div>
        @php($order=\App\Models\Orders::find(session('order_id')))
        <section class="col-lg-12">
            <div class="checkout_details mt-3">
                <div class="row">


                    @php($config=\App\CentralLogics\Helpers::get_business_settings('paypal'))
                    @if($config['status'])
                        <div class="col-md-6 mb-4" style="cursor: pointer">
                            <div class="card">
                                <div class="card-body pb-0 pt-1" style="height: 70px">
                                    <form class="needs-validation" method="POST" id="payment-form"
                                          action="{{route('pay-paypal')}}">
                                        {{ csrf_field() }}
                                        <button class="btn btn-block" type="submit">
                                            <img width="100"
                                                 src="{{asset('assets/admin/img/paypal.png')}}"/>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif


                </div>
            </div>
        </section>
    </div>
</div>

<!-- JS Front -->
<script src="{{asset('assets/admin')}}/js/custom.js"></script>
<script src="{{asset('assets/admin')}}/js/vendor.min.js"></script>
<script src="{{asset('assets/admin')}}/js/theme.min.js"></script>
<script src="{{asset('assets/admin')}}/js/sweet_alert.js"></script>
<script src="{{asset('assets/admin')}}/js/toastr.js"></script>
<script src="{{asset('assets/admin')}}/js/bootstrap.min.js"></script>




{!! Toastr::message() !!}

</body>
</html> --}}
