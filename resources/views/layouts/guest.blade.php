<!DOCTYPE html>
<html lang="zxx">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{csrf_token()}}"/>
    <title>NIWRMC | Portal</title>
    <link rel="icon" href="/img/logo.png" type="image/png">

    <link rel="stylesheet" href="/css/bootstrap1.min.css" />
    <link rel="stylesheet" href="/vendors/themefy_icon/themify-icons.css" />
    <link rel="stylesheet" href="/vendors/swiper_slider/css/swiper.min.css" />
    <link rel="stylesheet" href="/vendors/select2/css/select2.min.css" />
    <link rel="stylesheet" href="/vendors/niceselect/css/nice-select.css" />
    <link rel="stylesheet" href="/vendors/owl_carousel/css/owl.carousel.css" />
    <link rel="stylesheet" href="/vendors/gijgo/gijgo.min.css" />

    <link rel="stylesheet" href="/vendors/font_awesome/css/all.min.css" />
    <link rel="stylesheet" href="/vendors/tagsinput/tagsinput.css" />

    <link rel="stylesheet" href="/vendors/datatable/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="/vendors/datatable/css/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="/vendors/datatable/css/buttons.dataTables.min.css" />

    <link rel="stylesheet" href="/vendors/text_editor/summernote-bs4.css" />
    <link rel="stylesheet" href="/vendors/morris/morris.css">
    <link rel="stylesheet" href="/vendors/material_icon/material-icons.css" />
    <link rel="stylesheet" href="/css/metisMenu.css">

    <link rel="stylesheet" href="/css/style1.css" />
    <link rel="stylesheet" href="/css/custom.css" />
    <link rel="stylesheet" href="/css/colors/default.css" id="colorSkinCSS">

    @stack('css')
    <style>
        body {
            overflow-x: hidden;
        }
        .nav-item.active .nav-link{
            font-weight: 700;
            color: #55a51c;
        }

        .text-green {
            color: #55a51c;
        }
        .rotate-180{
            transform: rotate(180deg);
        }

        .content{
            padding: 35px;
        }

        .title-div{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .name-header p{
            line-height: 20px;
        }

        .mobile-nav{
            display: none;
        }

        .form-checkbox{
            height: 15px !important;
            width: 30px !important;
            display: inline !important;
        }

        .form-check-label{
            line-height: 3 !important;
            display: block !important;
        }

        .steps-content{
            width: 75%;
        }

        .steps-content a{
            color: black;
        }

        .steps .number{
            background: #9f9f9f;
            color: #f1f1f1;
            width: 22px;
            margin: auto;
            border-radius: 50%;
        }

        .steps .number.active{
            background: #55a51c;
        }

        .img-div{
            height: 225px;
            width: 200px;
            background: #c9c9c9;
            margin: auto;
            border: 7px solid white;
            border-radius: 3px;
        }

        .inline-input{
            width: 88%;
            margin-left: 15px;
            display: inline;
        }

        @media(max-width: 768px){
            .content{
                padding: 0;
            }

            .title-div{
                display: block;
            }

            .title-div div{
                display: none;
            }

            .title-div h4{
                font-size: 15px
            }

            .footer_part{
                position: relative;
            }

            .mobile-nav{
                display: unset !important;
            }

            .steps-content {
                width: 95%;
                margin-top: 15px;
                font-size: 12px;
            }

            .steps .number{
                width: 18px;
            }

            .modal-title{
                font-size: 18px !important;
            }
        }

        .bg-img{
            background: url(/img/logo.png);
            background-repeat: no-repeat;
            background-position: center;
            filter: blur(8px);
            -webkit-filter: blur(8px);
            opacity: 0.13;
            height: 100%;
            width: 100%;
            position: absolute;
        }
    </style>
</head>

<body class="crm_body_bg" style="background-color: #ebebeb;">
    <nav class="navbar navbar-expand-sm navbar-light px-5 shadow-sm" style="background-color: #ffffff;">
        <a class="navbar-brand" href="/"><img src="/img/nwirmc-logo.png" class="img-fluid" width="300"></a>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mt-2 mt-lg-0" style="margin-left: auto; font-weight: 600">
                <li class="nav-item">
                    <a class="nav-link" href="https://niwrmc.gov.ng/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pay-remita">Pay With Remita</a>
                </li>
                @if(Auth::guard('customer')->check())
                    <li class="nav-item ml-10">
                        <a class="btn" href="/customer-dashboard" role="button" style="background-color: #55a51c; border:none; color: #fff;">Dashboard</a>
                    </li>
                @elseif(Auth::check())
                    <li class="nav-item ml-10">
                        <a class="btn" href="/user-dashboard" role="button" style="background-color: #55a51c; border:none; color: #fff;">Dashboard</a>
                    </li>
                @else
                    <li class="nav-item mr_10">
                        <a class="nav-link" href="/register">Sign Up</a>
                    </li>
                    <li class="nav-item ml-10">
                        <a class="btn" href="/login" role="button" style="background-color: #55a51c; border:none; color: #fff;">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    <section class="content">
        <div class="bg-img" style="margin-left: -30px;"></div>
        <div class="row" style="z-index: 999; position: relative;">
            <div class="col-md-12 mobile-nav">
                <div class="row justify-content-center" style="background: #191919fa;">
                    <div class="d-flex justify-content-between p-3" style="width: 300px;">
                        <a class="text-white" href="https://niwrmc.gov.ng" role="button">Home</a>
                        @if(Auth::guard('customer')->check())
                            <a class="text-white" href="/customer-dashboard">Dashboard</a>
                        @elseif(Auth::check())
                            <a class="text-white" href="/user-dashboard">Dashboard</a>
                        @else
                            <a class="text-white" href="/register">Sign Up</a>
                            <a class="text-white" href="/login">Login</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
        @yield('content')
    </section>
    <div class="footer_part mt-2" style="padding-left: 0; position: relative;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="footer_iner text-center">
                        <p>{{Date('Y')}} © NIWRMC - Designed by<a href="#" style="color: #55a51c;"> Carlton Concepts Limited</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.bottom-scripts')
</body>
</html>
