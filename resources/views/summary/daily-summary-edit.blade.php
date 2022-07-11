@extends('layouts.main')

@section('content')

    <daily-summary-edit :daily-summary="{{$dailySummary}}"></daily-summary-edit>

@endsection
