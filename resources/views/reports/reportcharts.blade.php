@extends('./layouts/master-layout')

@section('page_title', 'گزارشات بانک ها')

@section('content')

@push('styles')

@endpush

@push('scripts')
<script src="{{asset('assets/js/mychart.js')}}"></script>

 <script>
    const chartData = @json($chartData);

    // Balance Chart
    const ctxBalance = document.getElementById('balanceChart').getContext('2d');
    new Chart(ctxBalance, {
        type: 'bar',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'بیلانس',
                data: chartData.balanceData,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Rasid Chart
    const ctxRasid = document.getElementById('rasidChart').getContext('2d');
    new Chart(ctxRasid, {
        type: 'line',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'رسید',
                data: chartData.rasidData,
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Bord Chart
    const ctxBord = document.getElementById('bordChart').getContext('2d');
    new Chart(ctxBord, {
        type: 'pie',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'برد',
                data: chartData.bordData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Profit Chart (New Chart Added)
    const ctxProfit = document.getElementById('profitChart').getContext('2d');
    new Chart(ctxProfit, {
        type: 'doughnut',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'سود',
                data: chartData.profitData,
                backgroundColor: [
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(75, 192, 192, 0.6)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Column Chart (New Chart Added)
    const ctxColumn = document.getElementById('columnChart').getContext('2d');
    new Chart(ctxColumn, {
        type: 'bar',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'ستون',
                data: chartData.columnData,
                backgroundColor: 'rgba(255, 205, 86, 0.6)',
                borderColor: 'rgba(255, 205, 86, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y', // Column chart (horizontal bar)
            scales: {
                x: { beginAtZero: true }
            }
        }
    });

</script>

@endpush
<p class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">گراف گزارشات /</span> گراف گزارشات
</p>

<h2>گزارشات بانکها</h2>

<div class="card">
    <div class="card-body">
        <canvas id="balanceChart" width="300" height="300" class="mb-3"></canvas>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <canvas id="rasidChart" width="300" height="300" class="mb-3"></canvas>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <canvas id="bordChart" width="300" height="300" class="mb-3"></canvas>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <canvas id="profitChart" width="300" height="300" class="mb-3"></canvas>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <canvas id="columnChart" width="300" height="300" class="mb-3"></canvas>
    </div>
</div>

@endsection
