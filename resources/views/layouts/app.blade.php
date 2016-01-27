<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Portal | @yield('title')</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/plugins/footable/footable.core.css" rel="stylesheet">
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">

</head>

<body class="top-navigation">

    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom white-bg">
                <nav class="navbar navbar-static-top" role="navigation">
                    <div class="navbar-header">
                        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                            <i class="fa fa-reorder"></i>
                        </button>
                        <a href="{{ url('/') }}" class="navbar-brand">Locate</a>
                    </div>
                    <div class="navbar-collapse collapse" id="navbar">
                        <ul class="nav navbar-nav">

                            <li class="">
                                <a aria-expanded="false" role="button" href="{{ url('/') }}"> Dashboard</a>
                            </li>

                        </ul>

                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <a href="https://mx.rotterdam-monitoring.com/">
                                    <i class="fa fa-sign-out"></i> Email
                                </a>
                            </li>
                            <li>
                                <a href="https://www.rotterdam-vlg.com/">
                                    <i class="fa fa-sign-out"></i> Portal
                                </a>
                            </li>
                        </ul>

                    </div>
                </nav>
            </div>

            @yield('content')

            <div class="footer">
                <div class="pull-right">Versie {{ config('app.appver') }}</div>
                <div>
                    <strong>Copyright</strong> Veldmeetdienst & Laboaratorium Groep &copy; {{ date('Y') }}
                </div>
            </div>

        </div>
    </div>

    {{-- Mainly scripts --}}
    <script src="/js/jquery-2.1.1.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    {{-- Custom and plugin javascript --}}
    <script src="/js/portal.js"></script>
    <script src="/js/plugins/pace/pace.min.js"></script>

    {{-- FooTable --}}
    <script src="/js/plugins/footable/footable.all.min.js"></script>

    {{-- iCheck --}}
    <script src="/js/plugins/iCheck/icheck.min.js"></script>

    <script>
        $(document).ready(function() {

            $('.footable').footable();

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
            });

        });
    </script>

</body>

</html>

