<?php $nav = 'map'; ?>

@extends('layouts.app')

@section('title', 'Map')

@section('content')

<div class="wrapper wrapper-content">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Map</h5>
                </div>
                <div class="ibox-content">{!! $helper->renderHtmlContainer($map) !!}</div>
            </div>
        </div>
    </div>

</div>

{!! $helper->renderJavascripts($map) !!}

@endsection
