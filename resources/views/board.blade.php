<?php $nav = 'board'; ?>

@extends('layouts.app')

@section('title', 'Planboard')

@section('content')

<link href="/css/plugins/gantt/style.css" type="text/css" rel="stylesheet">
<style type="text/css">
    body {
        font-family: Helvetica, Arial, sans-serif;
        font-size: 13px;
        padding: 0 0 50px 0;
    }
    h1 {
        margin: 40px 0 20px 0;
    }
    h2 {
        font-size: 1.5em;
        padding-bottom: 3px;
        border-bottom: 1px solid #DDD;
        margin-top: 50px;
        margin-bottom: 25px;
    }
    table th:first-child {
        width: 150px;
    }
    /* Bootstrap 3.x re-reset */
    .fn-gantt *,
    .fn-gantt *:after,
    .fn-gantt *:before {
      -webkit-box-sizing: content-box;
         -moz-box-sizing: content-box;
              box-sizing: content-box;
    }
</style>
<div class="wrapper wrapper-content">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Map</h5>
                </div>
                <div class="ibox-content">
                    <div class="gantt"></div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
