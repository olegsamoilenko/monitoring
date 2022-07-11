@extends('layouts.main')

@section('content')
    @if (Auth::check())
        <add-car :user_id="{{Auth::user()->id}}"></add-car>
    @else
        <add-car></add-car>
    @endif

@endsection
