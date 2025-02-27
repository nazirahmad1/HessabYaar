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
                label: 'Balance',
                data: chartData.balanceData,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
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
                label: 'Rasid',
                data: chartData.rasidData,
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
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
                label: 'Bord',
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
            responsive: true
        }
    });

</script>



@endpush
<p class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">گراف گزارشات /</span> گراف گزارشات 
</p>

<h2>Bank Balances</h2>
    
<canvas id="balanceChart"></canvas>
<canvas id="rasidChart"></canvas>
<canvas id="bordChart"></canvas>



@endsection
