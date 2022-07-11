@extends('layouts.admin')

@section('content')

    <edit-user-admin :user="{{$user}}"></edit-user-admin>

@endsection
