<?php $nav = 'sources'; ?>

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="wrapper wrapper-content">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Projecten</h5>
                </div>
                <div class="ibox-content">

                    <div class="row">
                        <div class="col-sm-8"></div>
                        @if (Auth::user()->canWrite())
                        <div class="col-sm-4 text-right">
                            <a href="{{ url('/source/new') }}" class="btn btn-primary ">Nieuwe opnemer</a>
                        </div>
                        @endif
                    </div>

                    <table class="footable table table-stripped" style="margin-top:20px;" data-page-size="10" data-filter=#filter>
                        <thead>
                            <tr>
                                <th data-sort-ignore="true">Naam</th>
                                <th data-sort-ignore="true">Project</th>
                                <th class="text-right" data-sort-ignore="true"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Source::all() as $list)
                            <tr>
                                <td>{{ $list->name }}</td>
                                <td>{{ $list->isAvailable() ? '-' : $list->location()->first()->name }}</td>
                                <td class="text-right">
                                    @if ($list->isAvailable() && Auth::user()->canWrite())
                                    <div class="btn-group">
                                        <a href="{{ url('/source/delete') . '?id=' . $list->id --}}" class="btn-danger btn btn-xs no-margins">Verwijderen</a>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="13">
                                    <ul class="pagination pull-right"></ul>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
