@extends('layouts.default')

@section('page_title', 'Dashboard')

@section('content')
    <app-components></app-components>
@endsection

@section('scripts_before_body')

    <script src="{{ asset('js/master/app.js') }}"></script>
@endsection
