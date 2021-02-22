@extends('layouts.app')

@section('content')
    <div class="container">

        <form action="{{ url('/applications') }}">
        <input type="text" name="q" />
        <input type="submit" class="btn btn-primary" role="button" value="{{ __('Search') }}"/><br/><br/>
        </form>

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
                <td><a href="{{ url('/applications/'.$item->id.'/edit') }}">{{ $item->name }}</a></td>
                <td>{{ $item->app_group }}</td>
                <td>{{ $item->app_type }}</td>
                <td>{{ $item->app_cost }} €</td>
            </tr>
            @endforeach
            </tbody>
        </table>@else {{__('(Empty list, nothing to show here.)')}} @endif @endif
    </div>
@endsection
