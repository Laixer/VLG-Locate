<?php $nav = 'notepad'; ?>

@extends('layouts.app')

@section('title', 'Kladblok')

@section('content')

<div class="wrapper wrapper-content">

    <div class="row">
        <div class="col-lg-12">

            @if (session('success'))
            <div class="alert alert-success" role="alert">
              {{ session('success') }}
            </div>
            @elseif (session('error'))
            <div class="alert alert-danger" role="alert">
              {{ session('error') }}
            </div>
            @endif

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Kladblok</h5>
                </div>

                <div class="ibox-content no-padding">
                    <form method="post" action="{{ url('/notepad/update') }}" class="form-horizontal">
                        {!! csrf_field() !!}
                        <textarea name="notepad" class="summernote">
                            {!! $notepad !!}
                        </textarea>
                        
                        <div class="hr-line-dashed"></div>
                        <div class="text-right" style="padding: 0 15px 15px 0;">
                            <button class="btn btn-primary" type="submit">Opslaan</button>
                        </div>
                    </form>
                    
                </div>

            </div>
        </div>
    </div>

</div>

@endsection
