@extends('layouts.app')

@section('title', 'Nieuwe opnemer')

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
                    <h5>Nieuwe opnemer</h5>
                </div>
                <div class="ibox-content">
                    <form method="post" action="{{ url('/source/new') }}" class="form-horizontal">
                        {!! csrf_field() !!}

                        <div class="form-group {{ $errors->has('name') || $errors->has('last_name') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Naam <span style="color: #C10000;">*</span></label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="name" placeholder="Naam" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                <span class="help-block m-b-none">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Opslaan</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
