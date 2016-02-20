<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Locate | @yield('title')</title>

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

                            <li class="{{ $nav == 'dashboard' ? 'active' : '' }}">
                                <a aria-expanded="false" role="button" href="{{ url('/') }}"> Locaties</a>
                            </li>
                            <li class="{{ $nav == 'sources' ? 'active' : '' }}">
                                <a aria-expanded="false" role="button" href="{{ url('/sources') }}"> Opnemers</a>
                            </li>
                            <li class="{{ $nav == 'map' ? 'active' : '' }}">
                                <a aria-expanded="false" role="button" href="{{ url('/map') }}"> Kaart</a>
                            </li>
                            <li class="{{ $nav == 'board' ? 'active' : '' }}">
                                <a aria-expanded="false" role="button" href="{{ url('/board') }}"> Planing</a>
                            </li>

                        </ul>

                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <a href="https://mx.rotterdam-monitoring.com/">
                                    <i class="fa fa-sign-out"></i> Email
                                </a>
                            </li>
                            <li>
                                <a href="https://portal.rotterdam-vlg.com/">
                                    <i class="fa fa-sign-out"></i> Portal
                                </a>
                            </li>
                        </ul>

                    </div>
                </nav>
            </div>

            @yield('content')

            <div class="footer">
                <div class="pull-right">Versie {{ App\QuickGit::version_short() }}</div>
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
    <script src="/js/plugins/gantt/jquery.fn.gantt.min.js"></script>

    <script>
        $(document).ready(function() {

            $('.footable').footable();

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
            });

            $(".gantt").gantt({
                    source: "/board/source",
                    navigate: "scroll",
                    scale: "weeks",
                    maxScale: "months",
                    minScale: "hours",
                    itemsPerPage: 30,
                    useCookie: true,
                    onItemClick: function(data) {
                        window.location.href = "/project/edit?id=" + data;
                    },
                });
        });
    </script>

</body>

</html>

