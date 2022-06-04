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
    <h2>Pages</h2>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#dashboard').addClass('active');
        })

        var myPieChart = new Chart(pieChart, {
            type: 'pie',
            data: {
                datasets: [{
                    data: [40, 15, 15, 30],
                    backgroundColor: ["#1d7af3", "#f3545d", "#fdaf4b", "#9b59b6"],
                    borderWidth: 0
                }],
                labels: ['TW1', 'TW2', 'TW3', 'TW4']
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    labels: {
                        fontColor: 'rgb(154, 154, 154)',
                        fontSize: 11,
                        usePointStyle: true,
                        padding: 20
                    }
                },
                pieceLabel: {
                    render: 'percentage',
                    fontColor: 'white',
                    fontSize: 14,
                },
                tooltips: false,
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 20,
                        bottom: 20
                    }
                }
            }
        })

        var myPieChart = new Chart(pieChart2, {
            type: 'pie',
            data: {
                datasets: [{
                    data: [50, 35, 15],
                    backgroundColor: ["#1d7af3", "#f3545d", "#fdaf4b"],
                    borderWidth: 0
                }],
                labels: ['TW1', 'TW2', 'TW3']
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    labels: {
                        fontColor: 'rgb(154, 154, 154)',
                        fontSize: 11,
                        usePointStyle: true,
                        padding: 20
                    }
                },
                pieceLabel: {
                    render: 'percentage',
                    fontColor: 'white',
                    fontSize: 14,
                },
                tooltips: false,
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 20,
                        bottom: 20
                    }
                }
            }
        })

        var myPieChart = new Chart(pieChart3, {
            type: 'pie',
            data: {
                datasets: [{
                    data: [20, 30, 0, 0],
                    backgroundColor: ["#1d7af3", "#f3545d", "#fdaf4b", "#9b59b6"],
                    borderWidth: 0
                }],
                labels: ['TW1', 'TW2']
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    labels: {
                        fontColor: 'rgb(154, 154, 154)',
                        fontSize: 11,
                        usePointStyle: true,
                        padding: 20
                    }
                },
                pieceLabel: {
                    render: 'percentage',
                    fontColor: 'white',
                    fontSize: 14,
                },
                tooltips: false,
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 20,
                        bottom: 20
                    }
                }
            }
        })
    </script>
@endpush
