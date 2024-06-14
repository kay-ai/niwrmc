<!DOCTYPE html>
<html lang="zxx">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{csrf_token()}}"/>
    <title>{{$pageTitle}}</title>
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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    @stack('css')
    <style>
        .alert{
            width: max-content;
            margin-left: auto;
            margin-right: 20px;
            padding-right: 20px;
        }
    </style>
</head>

<body class="crm_body_bg">
    @include('includes.nav')
    <section class="main_content dashboard_part">
        @include('includes.header')
        @include('includes.messages')
        @yield('content')
        @include('includes.footer')
    </section>

    @include('includes.bottom-scripts')
</body>
</html>
