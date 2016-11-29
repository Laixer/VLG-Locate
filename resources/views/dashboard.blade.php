<?php $nav = 'dashboard'; ?>

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="wrapper wrapper-content">

    <div class="row">
        <div class="col-lg-12">

            @if (session('success'))
            <div class="alert alert-success" role="alert">
              {{ session('success') }}
            </div>
            @endif

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Locaties</h5>
                </div>
                <div class="ibox-content">

                    <div class="row">
                        <div class="col-sm-8"></div>
                        <div class="col-sm-4 text-right">
                            <a href="{{ url('/?all=true') }}" class="btn btn-white ">Alle locaties</a>
                            @if (Auth::user()->canWrite())
                             <a href="{{ url('/project/new') }}" class="btn btn-primary ">Nieuwe locatie</a>
                            @endif
                        </div>
                    </div>

                    <table class="footable table table-stripped" style="margin-top:20px;">
                        <thead>
                            <tr>
                                <th>Nummer</th>
                                <th>Naam</th>
                                <th>Opnemer</th>
                                <th>Adres</th>
                                <th>Postcode</th>
                                <th>Geplaatst</th>
                                <th>Verwijderd</th>
                                <th>Contact</th>
                                <th>Telefoon</th>
                                <th>Email</th>
                                <th>Data gevraagd</th>
                                <th class="text-right" data-sort-ignore="true"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Location::available($all) as $list)
                            <tr>
                                <td>{{ $list->number }}</td>
                                <td>{{ $list->name }}</td>
                                <td>{{ $list->source->name }}</td>
                                <td>{{ $list->address . ' ' . $list->address_number }}</td>
                                <td>{{ $list->postal }}</td>
                                <td>{{ date('d-m-Y', strtotime($list->placed_at)) }}</td>
                                <td>{{ $list->removed_at ? date('d-m-Y', strtotime($list->removed_at)) : '-' }}</td>
                                <td>{{ $list->contact_name }}</td>
                                <td>{{ $list->phone }}</td>
                                <td>{{ $list->email }}</td>
                                <td>{{ $list->data_requested ? 'Ja' : 'Nee' }}</td>
                                <td class="text-right">
                                    @if (Auth::user()->canWrite())
                                    <div class="btn-group">
                                        <a href="{{ url('/notepad') . '?id=' . $list->id }}" class="btn-white btn btn-xs no-margins">Kladblok</a>
                                        <a href="{{ url('/project/edit') . '?id=' . $list->id }}" class="btn-white btn btn-xs no-margins">Bewerk</a>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
