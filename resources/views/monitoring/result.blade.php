@extends('layouts.main')

@section('content')

    <monitoring-result :user="{{Auth::user()->load('roles')}}"></monitoring-result>

@endsection

