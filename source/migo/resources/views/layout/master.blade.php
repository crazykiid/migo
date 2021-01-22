<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>{{ $page_title }}</title>
    <meta name="google-site-verification" content="">
    <meta name="msvalidate.01" content="">
    <!-- basic meta tags - social media meta tags - Facebook Open Graph - Twitter Cards -->
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, minimal-ui, user-scalable=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="">
    <meta property="og:type" content="website">
    <meta property="twitter:card" content="summary">
    <meta property="twitter:title" content="">
    <meta property="twitter:image" content="">
    <meta property="twitter:url" content="">
    <meta property="twitter:description" content="">
    <!-- end of SMMT - FOG - TC -->
    <link rel="canonical" href="">
    <link rel="shortcut icon" href="" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.6.3/css/foundation.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.2.3/motion-ui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.6.3/css/foundation-prototype.min.css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">

</head>
<body>
@yield('page')

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.6.3/js/foundation.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.2.3/motion-ui.min.js"></script>
<script>$(document).foundation();</script>
@yield('extra')
</body>
</html>