<?php $nav = 'dashboard'; ?>

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
                        <div class="col-sm-10"></div>
                        <div class="col-sm-2 text-right">
                            <a href="{{ url('/admin/user/new') }}" class="btn btn-primary ">Nieuw project</a>
                        </div>
                    </div>

                    <table class="footable table table-stripped" style="margin-top:20px;" data-page-size="10" data-filter=#filter>
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
                                <th class="text-right" data-sort-ignore="true">Opmerking</th>
                                <th class="text-right" data-sort-ignore="true"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Location::all() as $list)
                            <tr>
                                <td>{{ $list->number }}</td>
                                <td>{{ $list->name }}</td>
                                <td>{{ $list->source->name }}</td>
                                <td>{{ $list->address . ' ' . $list->address_number }}</td>
                                <td>{{ $list->postal }}</td>
                                <td>{{ $list->placed_at }}</td>
                                <td>{{ $list->removed_at }}</td>
                                <td>{{ $list->contact_name }}</td>
                                <td>{{ $list->phone }}</td>
                                <td>{{ $list->email }}</td>
                                <td>{{ $list->data_requested ? 'Ja' : 'Nee' }}</td>
                                <td>{{ $list->note }}</td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <a href="{{-- url('admin/user/edit') . '?id=' . $user->id --}}" class="btn-white btn btn-xs no-margins">Bewerk</a>
                                    </div>
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
