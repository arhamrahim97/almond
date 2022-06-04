@extends('dashboard.layouts.main')

@section('title')
    Dashboard
@endsection

@push('style')
@endpush

@section('breadcrumb')
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="{{ url('dashboard') }}">
                <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="{{ url('dashboard') }}">Dashboard</a>
        </li>

    </ul>
@endsection

@section('content')
    <h2>Ini Dashboard</h2>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#dashboard').addClass('active');
        })
    </script>
@endpush
