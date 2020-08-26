<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Admin Panel - @yield('title')</title>
    <script src="https://use.fontawesome.com/1504552d47.js"></script>
    @yield('style')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
{{--    <link rel="stylesheet" href="{{asset('css/continental.css')}}">--}}


    <style>

        h6 h5 h4 h3 h2 h1 {
            color: white;
        }
        .dashboard .card-section .fa{
            font-size: 2.5rem;
        }

        .dashboard .fa {
            font-size: 2.5rem;
        }

        .dashboard .card-divider {
            background-color: black;
        }

        .dashboard li {
            color: #f5f5ff;
        }

        .dashboard ul span {
            color: #00cc00;
        }

        #mapid {
            height: 400px;

        }
        body {
            background-color: #010101;
        }
    </style>

</head>

<body class="outer-container" id="@yield('page-id')" >


<!-- Side navigation -->
<div class="sidenav" >
    <div class="image-holder text-center " >
        <img src="{{ asset('user.png') }}" alt="pfa" title="Admin">
    </div>
    <ul >
        <li><a href="/admin"><i class="fa fa-tachometer fa-fw" aria-hidden="true"></i>&nbsp; Dashboard</a>
        <li><a href="/admin/gain_lost"><i class="fa fa-money fa-fw" aria-hidden="true"></i>&nbsp;Cost & Lost variation</a></li>
        <li><a href="/sales_prediction"><i class="fa fa-money fa-fw" aria-hidden="true"></i>&nbsp;Sales Predictions</a></li>
        <li><a href="/admin/manage_sales"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>&nbsp;Sales By region</a></li>
        <li><a href="/admin/map"><i class="fa fa-map fa-fw" aria-hidden="true"></i>&nbsp;Map pfa-Sales </a></li>
        <li><a href="/api_data"><i class="fa fa-info fa-fw" aria-hidden="true"></i>&nbsp;Api pfa-Sales </a></li>
        <li><a href="/logout"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>&nbsp; Logout</a></li>
    </ul>
</div>

<!-- Page content -->
<div class="main" >


@yield('content')
<!-- Your page content lives here -->
</div>


<script src="{{ asset('js/script.js') }}"></script>

@yield('script')

</body>
</html>
