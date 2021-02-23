@extends('layouts.app')

@section('content')
@php $CID = App\Http\Controllers\ApplicationController::CID; @endphp
    <div class="container">

        <form action="{{ url('/'.$CID) }}" class="input-group">
            <div class="input-group-prepend">
                <input type="submit" class="btn btn-primary" id="bq" value="{{ __('Search') }}"/>
            </div>
            <input type="text" name="q" class="form-control" placeholder="{{ __('Insert keywords here and click Search') }}" aria-describedby="bq" value="{{ $q }}"/>
            <a class="btn btn-success" href="{{ url('/'.$CID.'/create') }}" role="button">{{ __('Add application') }}</a>
        </form>
        <br/><br/>
&nbsp;
        @if($items)@if(count($items))<table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">{{ __('Name') }}</th>
                <th scope="col">{{ __('Group') }}</th>
                <th scope="col">{{ __('Type') }}</th>
                <th scope="col">{{ __('Cost') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $k => $item)
            <tr>
                <td><a href="{{ url('/'.$CID.'/'.$item->app_code.'/edit') }}">{{ $item->name }}</a></td>
                <td>{{ $item->app_group }}</td>
                <td>{{ $item->app_type }}</td>
                <td>{{ $item->app_cost }} €</td>
            </tr>
            @endforeach
            </tbody>
        </table>@else {{__('(Empty list, nothing to show here.)')}} @endif @endif
    </div>
@endsection
