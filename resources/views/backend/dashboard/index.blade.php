@extends('backend.template.main')

@section ('title', 'Dashboard')
@section('content')
{{-- Content --}}
<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="#">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('panel.dashboard') }}">Dashboard</a></li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Transaction</h1>
            <p class="mb-0">Daftar Transaction Yummy Restoran</p>
        </div>
</div>

<div class="d-flex justify-content-center">
    <div class="col-12 col-xl-8 mb-4">
        <div class="card border-0 shadow">
            <div class="card-header">
                <h2 class="fs-5 fw-bold mb-0">Transaction</h2>
            </div>
            <div class="card-body">
                <canvas id="transactionChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('transactionChart').getContext('2d');
        var transactionChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total','Pending','Success', 'Failed'],
                datasets: [{
                    label: 'Transactions',
                    data: [
                        {{ $totalTransactions ?? 0 }},
                        {{ $totalPending  ?? 0 }},
                        {{ $totalSuccess ?? 0 }},
                        {{ $totalFailed ?? 0 }}
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

<!-- Tabel Transaksi Terbaru -->
<h2>Latest Transaction</h2>
<div class="table-responsive">
    <table class="table align-middle table-striped table-hover">
        <thead class="thead-dark">
            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                <th class="w-100px">No</th>
                <th class="min-w-125px">Name</th>
                <th class="min-w-125px">Code</th>
                <th class="min-w-125px">Type</th>
                <th class="min-w-125px">Amount</th>
                <th class="min-w-125px">Status</th>
                <th class="min-w-125px">Date/Time</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 fw-bold">
            @if(isset($latestTransactions) && count($latestTransactions) > 0)
                @foreach($latestTransactions as $transaction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaction->name }}</td>
                        <td>{{ $transaction->code }}</td>
                        <td>{{ $transaction->type }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>
                            @if ($transaction->status == 'pending')
                                <span class="badge bg-warning text-dark">{{ ucfirst($transaction->status) }}</span>
                            @elseif ($transaction->status == 'failed')
                                <span class="badge bg-danger">{{ ucfirst($transaction->status) }}</span>
                            @else
                                <span class="badge bg-success">{{ ucfirst($transaction->status) }}</span>
                            @endif
                        </td>
                        <td>{{ date('d-m-Y', strtotime($transaction->date)) }} /  {{ $transaction->time }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center text-muted">No transactions available</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
<div style="margin-bottom: 2rem; gap: 1.5rem" class="d-flex justify-content-center">
    <div class="col-12 col-sm-6 col-xl-4 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                            <svg class="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-400 mb-0">Total Transaction</h2>
                            <h3 class="fw-extrabold mb-2">{{ $totalTransactions ?? 0 }}</h3>
                        </div>
                       
                        <small class="d-flex align-items-center text-gray-500">
                            {{ count($dates) > 0 ? $dates[0] : '' }} - {{ count($dates) > 0 ? end($dates) : '' }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-tertiary rounded me-4 me-sm-0">
                            <svg class="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-400 mb-0"> Total Success</h2>
                            <h3 class="fw-extrabold mb-2">{{ $totalSuccess ?? 0 }}</h3>
                        </div>
                       
                    <small class="d-flex align-items-center text-gray-500">
                        {{ count($dates) > 0 ? $dates[0] : '' }} - {{ count($dates) > 0 ? end($dates) : '' }}
                    </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="gap: 1.5rem; margin-top: -1.5rem" class="d-flex justify-content-center">
    <div class="col-12 col-sm-6 col-xl-4 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                            <svg class="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1h5a1 1 0 011 1v3a1 1 0 01-1 1h-5v1a4 4 0 004 4h5a1 1 0 011-1v-3a1 1 0 01-1-1h-5V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 100 2h1a1 1 0 001-1h-1v-1zm7-1a1 1 0 011-1h1a1 1 0 010 2h-1a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-400 mb-0">Total Pending</h2>
                            <h3 class="fw-extrabold mb-2">{{ $totalPending ?? 0 }}</h3>
                        </div>
                        <small class="d-flex align-items-center text-gray-500">
                            {{ count($dates) > 0 ? $dates[0] : '' }} - {{ count($dates) > 0 ? end($dates) : '' }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mb-4">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-tertiary rounded me-4 me-sm-0">
                            <svg class="icon text-danger" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-400 mb-0">Total Failed</h2>
                            <h3 class="mb-1">{{ $totalFailed ?? 0 }}</h3>
                        </div>
                        <small class="d-flex align-items-center text-gray-500">
                            {{ count($dates) > 0 ? $dates[0] : '' }} - {{ count($dates) > 0 ? end($dates) : '' }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- end Content --}}

@endsection

