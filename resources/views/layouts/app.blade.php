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
                                <a aria-expanded="false" role="button" href="{{ url('/board') }}"> Planboard</a>
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
                    source: [{
                        name: "Sprint 0",
                        desc: "Analysis",
                        values: [{
                            from: "/Date(1320192000000)/",
                            to: "/Date(1322401600000)/",
                            label: "Requirement Gathering",
                            customClass: "ganttRed"
                        }]
                    },{
                        desc: "Scoping",
                        values: [{
                            from: "/Date(1322611200000)/",
                            to: "/Date(1323302400000)/",
                            label: "Scoping",
                            customClass: "ganttRed"
                        }]
                    },{
                        name: "Sprint 1",
                        desc: "Development",
                        values: [{
                            from: "/Date(1323802400000)/",
                            to: "/Date(1325685200000)/",
                            label: "Development",
                            customClass: "ganttGreen"
                        }]
                    },{
                        name: " ",
                        desc: "Showcasing",
                        values: [{
                            from: "/Date(1325685200000)/",
                            to: "/Date(1325695200000)/",
                            label: "Showcasing",
                            customClass: "ganttBlue"
                        }]
                    },{
                        name: "Sprint 2",
                        desc: "Development",
                        values: [{
                            from: "/Date(1326785200000)/",
                            to: "/Date(1325785200000)/",
                            label: "Development",
                            customClass: "ganttGreen"
                        }]
                    },{
                        desc: "Showcasing",
                        values: [{
                            from: "/Date(1328785200000)/",
                            to: "/Date(1328905200000)/",
                            label: "Showcasing",
                            customClass: "ganttBlue"
                        }]
                    },{
                        name: "Release Stage",
                        desc: "Training",
                        values: [{
                            from: "/Date(1330011200000)/",
                            to: "/Date(1336611200000)/",
                            label: "Training",
                            customClass: "ganttOrange"
                        }]
                    },{
                        desc: "Deployment",
                        values: [{
                            from: "/Date(1336611200000)/",
                            to: "/Date(1338711200000)/",
                            label: "Deployment",
                            customClass: "ganttOrange"
                        }]
                    },{
                        desc: "Warranty Period",
                        values: [{
                            from: "/Date(1336611200000)/",
                            to: "/Date(1349711200000)/",
                            label: "Warranty Period",
                            customClass: "ganttOrange"
                        }]
                    }],
                    navigate: "scroll",
                    scale: "weeks",
                    maxScale: "months",
                    minScale: "hours",
                    itemsPerPage: 10,
                    useCookie: true,
                    // onItemClick: function(data) {
                    //     alert("Item clicked - show some details");
                    // },
                    // onAddClick: function(dt, rowId) {
                    //     alert("Empty space clicked - add an item!");
                    // },
                    // onRender: function() {
                    //     if (window.console && typeof console.log === "function") {
                    //         console.log("chart rendered");
                    //     }
                    // }
                });
                $(".gantt").popover({
                    selector: ".bar",
                    title: "I'm a popover",
                    content: "And I'm the content of said popover.",
                    trigger: "hover"
                });

        });
    </script>

</body>

</html>

