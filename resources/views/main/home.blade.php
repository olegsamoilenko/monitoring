@extends('layouts.main')

@section('content')

    <home  :daily-summary="{{$dailySummary}}" :daily-summary-cars="{{$dailySummaryCars}}" :user="{{Auth::user()->load('roles')}}"></home>

@endsection
