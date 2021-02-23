@extends('layouts.app')

@section('content')
@php $CID = App\Http\Controllers\AppServiceController::CID; @endphp
<div class="container">
    <div class="alert alert-info">{{ __('Service') }}</div>
    @if($errors->any()) <div class="alert alert-danger">{{ __('Name field cannot be empty.') }}</div>@endif
    {{ Form::open( Str::of(Route::currentRouteAction())->after('@') == 'edit'
        ? ['url'=>$CID.'/'.$item->service_code, 'method'=>'put'] : ['url'=>$CID]) }}

        <input type="hidden" value="{{ $app_code ?? old('app_code') }}" id="app_code" name="app_code"/>

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}*</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ $item->name ?? old('name') }}"/>
            </div>
        </div>

        <div class="form-group row">
            <label for="type" class="col-sm-2 col-form-label">{{ __('Type') }}</label>
            <div class="col-sm-10">
                <select class="form-control" id="type" name="type">
                    @include('includes.selectoptions', [
                        'options' => [
                            ['v' => 'HTTP'],
                            ['v' => 'SAML'],
                            ['v' => 'SSH'],
                            ['v' => 'JDBC'],
                            ['v' => 'ODBC']
                        ],
                        'value' => $item->type ?? old('type')
                    ])
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="sub_type" class="col-sm-2 col-form-label">{{ __('Subtype') }}</label>
            <div class="col-sm-10">
                <select class="form-control" id="sub_type" name="sub_type">
                    @include('includes.selectoptions', [
                        'options' => [
                            ['v' => 'REST'],
                            ['v' => 'SOAP']
                        ],
                        'value' => $item->sub_type ?? old('sub_type')
                    ])
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">{{ __('Description') }}</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="description" name="description" wrap="virtual" rows="10" maxlength="20000">{{ $item->description ?? old('description') }}</textarea>
            </div>
        </div>

        <br/>
        <input type="submit" class="btn btn-primary" name="add" value="{{ __('Save') }}"/>
        @if(Str::of(Route::currentRouteAction())->after('@') == 'edit')
            <input type="button" class="btn btn-danger" value="{{ __('Delete') }}" onClick="if(confirm('{{ __('Do you really want to delete this application?') }}')){$('#delete-form').submit();} return true;"/>
        @endif
        <a href="{{url('applications/'.($item->app_code ?? $app_code).'/edit#services')}}" class="btn btn-warning">{{ __('Back to application') }}</a>
        {{ Form::close() }}
        @if(Str::of(Route::currentRouteAction())->after('@') == 'edit')
            {!! Form::open(['url'=>$CID.'/'.$item->service_code, 'method'=>'delete', 'id'=>'delete-form']).Form::close() !!}
        @endif
    <br/>

</div>

@endsection
