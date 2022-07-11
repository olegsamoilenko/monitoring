@extends('layouts.admin')

@section('content')

    <edit-post-admin :post="{{$post}}"></edit-post-admin>

@endsection
