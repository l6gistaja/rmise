@extends('layouts.app')

@section('content')
@php $CID = App\Http\Controllers\ApplicationController::CID; @endphp
<div class="container">
    <div class="alert alert-info">{{ __('Application') }}</div>
    @if($errors->any()) <div class="alert alert-danger">{{ __('Name field cannot be empty.') }}</div>@endif
    {{ Form::open( Str::of(Route::currentRouteAction())->after('@') == 'edit'
        ? ['url'=>$CID.'/'.$item->app_code, 'method'=>'put'] : ['url'=>$CID]) }}

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}*</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ $item->name ?? old('name') }}"/>
            </div>
        </div>

        <div class="form-group row">
            <label for="app_group" class="col-sm-2 col-form-label">{{ __('Group') }}</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="app_group" name="app_group" value="{{ $item->app_group ?? old('app_group') }}"/>
            </div>
        </div>

        <div class="form-group row">
            <label for="app_type" class="col-sm-2 col-form-label">{{ __('Type') }}</label>
            <div class="col-sm-10">
                <select class="form-control" id="app_type" name="app_type">
                    @include('includes.selectoptions', [
                        'options' => [
                            ['v' => 'java'],
                            ['v' => 'php'],
                            ['v' => 'box'],
                            ['v' => 'os component'],
                            ['v' => 'database engine']
                        ],
                        'value' => $item->app_type ?? old('app_type')
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

        <div class="form-group row">
            <label for="app_cost" class="col-sm-2 col-form-label">{{ __('Cost') }}</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="app_cost" name="app_cost" value="{{ $item->app_cost ?? old('app_cost') }}"/>
            </div>
        </div>

        <br/>
        <input type="submit" class="btn btn-primary" name="add" value="{{ __('Save') }}"/>
        @if(Str::of(Route::currentRouteAction())->after('@') == 'edit')
            <input type="button" class="btn btn-danger" value="{{ __('Delete') }}" onClick="if(confirm('{{ __('Do you really want to delete this application?') }}')){$('#delete-form').submit();} return true;"/>
        @endif
        {{ Form::close() }}
        @if(Str::of(Route::currentRouteAction())->after('@') == 'edit')
            {!! Form::open(['url'=>$CID.'/'.$item->app_code, 'method'=>'delete', 'id'=>'delete-form']).Form::close() !!}
            <br/>
            <div class="alert alert-info">
                <a name="services">{{ __('Application\'s services') }}</a>
            </div>
            <a class="btn btn-success" href="{{ url('/services/create?app_code='.$item->app_code) }}" role="button">{{ __('Add new service to application') }}</a>
            <br/><br/>
            <table class="table table-striped">
            <tbody>
            @foreach($item->appServices()->get() as $k => $s)
            @if($k == 0)
            <tr>
                <th scope="col">{{ __('Name') }}</th>
                <th scope="col">{{ __('Type') }}</th>
                <th scope="col">{{ __('Subtype') }}</th>
            </tr>
            @endif
            <tr>
                <td><a href="{{ url('/services/'.$s->service_code.'/edit') }}">{{ $s->name }}</a></td>
                <td>{{ $s->type }}</td>
                <td>{{ $s->sub_type }}</td>
            </tr>
            @endforeach
            </tbody>
            </table>
        @endif
    <br/>

</div>

@endsection
