<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        @yield("page-title")
    </title>

    <meta name="description" content="Where Exlusive and Premium Videos come to hang">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset("assets/bootstrap/css/bootstrap.min.css") }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allura">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anton">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Asset">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Astloch">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Atomic+Age">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
 

    <link rel="stylesheet" href="{{ $___pFont->url("fontawesome-all.min.css") }}">

    <link rel="stylesheet" href="{{ $___pCSS->url("Footer-Dark.css") }}">
    <link rel="stylesheet" href="{{ $___pCSS->url("Highlight-Clean.css") }}">
    <link rel="stylesheet" href="{{ $___pCSS->url("styles.css") }}">
    <link rel="stylesheet" href="{{ $___pCSS->url("video-list.css?v=2") }}">
    <link rel="stylesheet" href="{{ $___pCSS->url("section-loader.css") }}">

</head>

<body>
    @section("page-nav")
    @include("navbar.banneronly")
    @show

    @yield("main-page")

    @include("addins.footer")
</body>

</html>

<script src="{{ $___pJS->url("jquery.min.js") }}"></script>
<script src="{{ asset("assets/bootstrap/js/bootstrap.min.js") }}"></script>

<script src="{{ $___pJS->url("ajax-forms.js") }}"></script>
<script src="{{ $___pJS->url("confirm-follow.js") }}"></script>
<script src="{{ $___pJS->url("section-loader.js") }}"></script>

@yield('page-js')