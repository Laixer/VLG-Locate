@extends('layouts.app')

@section('title', 'Nieuw project')

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
                    <h5>Nieuw project</h5>
                </div>
                <div class="ibox-content">
                    <form method="post" action="{{ url('/project/new') }}" class="form-horizontal">
                        {!! csrf_field() !!}

                        <div class="form-group {{ $errors->has('number') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Projectnummer <span style="color: #C10000;">*</span></label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="number" placeholder="Projectnummer" value="{{ old('number') }}">
                                @if ($errors->has('number'))
                                <span class="help-block m-b-none">{{ $errors->first('number') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('name') || $errors->has('last_name') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Naam <span style="color: #C10000;">*</span></label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="name" placeholder="Projectnaam" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                <span class="help-block m-b-none">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group {{ $errors->has('placed') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Geplaatst op <span style="color: #C10000;">*</span></label>
                            <div class="col-sm-10"><input type="date" name="placed" class="form-control" value="{{ old('placed') }}">
                                @if ($errors->has('placed'))
                                <span class="help-block m-b-none">{{ $errors->first('placed') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('removed') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Verwijderd op <span style="color: #C10000;">*</span></label>
                            <div class="col-sm-10"><input type="date" name="removed" class="form-control" value="{{ old('removed') }}">
                                @if ($errors->has('removed'))
                                <span class="help-block m-b-none">{{ $errors->first('removed') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group {{ $errors->has('address') || $errors->has('address_number') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Adres <span style="color: #C10000;">*</span></label>
                            <div class="col-sm-8"><input type="text" name="address" class="form-control" placeholder="Adres" value="{{ old('address') }}">
                                @if ($errors->has('address'))
                                <span class="help-block m-b-none">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-2"><input type="text" name="address_number" class="form-control" placeholder="Nummer" value="{{ old('address_number') }}">
                                @if ($errors->has('address_number'))
                                <span class="help-block m-b-none">{{ $errors->first('address_number') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('postal') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Postcode <span style="color: #C10000;">*</span></label>
                            <div class="col-sm-10"><input type="text" name="postal" class="form-control" placeholder="Postcode" value="{{ old('postal') }}">
                                @if ($errors->has('postal'))
                                <span class="help-block m-b-none">{{ $errors->first('postal') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Plaats <span style="color: #C10000;">*</span></label>
                            <div class="col-sm-10"><input type="text" name="city" class="form-control" placeholder="Plaats" value="{{ old('city') }}">
                                @if ($errors->has('city'))
                                <span class="help-block m-b-none">{{ $errors->first('city') }}</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>
                        <div class="form-group {{ $errors->has('contact') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Contact <span style="color: #C10000;">*</span></label>
                            <div class="col-sm-10"><input type="text" name="contact" class="form-control" placeholder="Contact" value="{{ old('contact') }}">
                                @if ($errors->has('contact'))
                                <span class="help-block m-b-none">{{ $errors->first('contact') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Email <span style="color: #C10000;">*</span></label>
                            <div class="col-sm-10"><input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                <span class="help-block m-b-none">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Telefoon</label>
                            <div class="col-sm-10"><input type="text" name="phone" placeholder="Telefoon" class="form-control" value="{{ old('phone') }}"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group {{ $errors->has('source') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Opnemer <span style="color: #C10000;">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="source">
                                    <option>Selecteer</option>
                                    @foreach(App\Source::available() as $source)
                                    <option value="{{ $source->id }}">{{ $source->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('source'))
                                <span class="help-block m-b-none">{{ $errors->first('source') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Opmerking</label>
                            <div class="col-sm-10"><input type="text" name="note" class="form-control" placeholder="Opmerking" value="{{ old('note') }}"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Overig</label>
                            <div class="col-sm-10 checkbox-inline">
                                <div class="i-checks"><label> <input type="checkbox" name="data_requested"> <i></i> Data opgevraagd </label></div>
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
