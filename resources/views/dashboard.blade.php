@extends('layout.master')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center mb-4">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $paketCount }}</h3>
            <p>Total Paket</p>
          </div>
          <div class="icon">
            <i class="fas fa-box"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $pesananCount }}</h3>
            <p>Total Pesanan</p>
          </div>
          <div class="icon">
            <i class="fas fa-shopping-cart"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $reservasiCount }}</h3>
            <p>Total Reservasi</p>
          </div>
          <div class="icon">
            <i class="fas fa-calendar-check"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ $customerCount }}</h3>
            <p>Total Customer</p>
          </div>
          <div class="icon">
            <i class="fas fa-users"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Kiri -->
      <div class="col-md-6">
        <!-- AREA CHART -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Pesanan</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div>

        <!-- DONUT CHART -->
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Reservasi</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
        </div>

        <!-- PIE CHART -->
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Pie Chart</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
        </div>
      </div>

      <!-- Kanan -->
      <div class="col-md-6">
        <!-- LINE CHART -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Line Chart</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div>

        <!-- BAR CHART -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Bar Chart</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div>

        <!-- STACKED BAR CHART -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Stacked Bar Chart</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Area Chart
  const areaCtx = document.getElementById('areaChart').getContext('2d');
  const areaChart = new Chart(areaCtx, {
    type: 'line',
    data: {
      labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
      datasets: [{
        label: 'Pesanan',
        data: [{{ $pesananBulanIni }}, 10, 15, 20, 18, 25],
        backgroundColor: 'rgba(60,141,188,0.4)',
        borderColor: 'rgba(60,141,188,1)',
        fill: true,
        tension: 0.3,
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: { beginAtZero: true }
      }
    }
  });

  // Donut Chart
  const donutCtx = document.getElementById('donutChart').getContext('2d');
  const donutChart = new Chart(donutCtx, {
    type: 'doughnut',
    data: {
      labels: ['Paket', 'Pesanan', 'Reservasi', 'Customer'],
      datasets: [{
        data: [{{ $paketCount }}, {{ $pesananCount }}, {{ $reservasiCount }}, {{ $customerCount }}],
        backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545'],
        hoverOffset: 30
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { position: 'bottom' } }
    }
  });

  // Pie Chart
  const pieCtx = document.getElementById('pieChart').getContext('2d');
  const pieChart = new Chart(pieCtx, {
    type: 'pie',
    data: {
      labels: ['Pesanan', 'Reservasi', 'Customer'],
      datasets: [{
        data: [{{ $pesananBulanIni }}, {{ $reservasiBulanIni }}, {{ $customerBulanIni }}],
        backgroundColor: ['#28a745', '#ffc107', '#dc3545']
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { position: 'right' } }
    }
  });

  // Line Chart
  const lineCtx = document.getElementById('lineChart').getContext('2d');
  const lineChart = new Chart(lineCtx, {
    type: 'line',
    data: {
      labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
      datasets: [{
        label: 'Reservasi',
        data: [5, 10, 15, {{ $reservasiBulanIni }}],
        borderColor: '#17a2b8',
        backgroundColor: 'rgba(23,162,184,0.4)',
        fill: true,
        tension: 0.1
      }]
    },
    options: {
      responsive: true,
      scales: { y: { beginAtZero: true } }
    }
  });

  // Bar Chart
  const barCtx = document.getElementById('barChart').getContext('2d');
  const barChart = new Chart(barCtx, {
    type: 'bar',
    data: {
      labels: ['Paket', 'Pesanan', 'Reservasi', 'Customer'],
      datasets: [{
        label: 'Jumlah',
        data: [{{ $paketCount }}, {{ $pesananCount }}, {{ $reservasiCount }}, {{ $customerCount }}],
        backgroundColor: ['#28a745', '#007bff', '#ffc107', '#dc3545']
      }]
    },
    options: {
      responsive: true,
      scales: { y: { beginAtZero: true, precision: 0 } }
    }
  });

  // Stacked Bar Chart
  const stackedCtx = document.getElementById('stackedBarChart').getContext('2d');
  const stackedBarChart = new Chart(stackedCtx, {
    type: 'bar',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
      datasets: [
        {
          label: 'Pesanan',
          data: [12, 19, 3, 5, 2, 3],
          backgroundColor: '#007bff'
        },
        {
          label: 'Reservasi',
          data: [2, 3, 20, 5, 1, 4],
          backgroundColor: '#28a745'
        },
        {
          label: 'Customer',
          data: [3, 10, 13, 15, 22, 30],
          backgroundColor: '#ffc107'
        }
      ]
    },
    options: {
      responsive: true,
      scales: {
        x: { stacked: true },
        y: { stacked: true, beginAtZero: true }
      }
    }
  });
</script>
@endsection
