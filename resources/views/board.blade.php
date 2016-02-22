<?php $nav = 'board'; ?>

@extends('layouts.app')

@section('title', 'Planboard')

@section('content')

<link href="/css/plugins/gantt/style.css" type="text/css" rel="stylesheet">
<style type="text/css">
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
                    <h5>Planning</h5>
                </div>
                <div class="ibox-content">
                    <div class="gantt"></div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
