@extends('Admin.admin_dashboard')

@section('content')
    <style>
        .dashboardSidebar {
            background-color: #FA9C14;
        }

        #small{
            height: 130px;
        }
    </style>

    <main class="p-3">
        <div class="container-fluid p-4 pt-0" id="mainContent">
            <div class="row">
                <!-- Stats Cards -->
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body" id="small">
                            <h5 class="card-title">Order</h5>
                            <p class="card-text" style="color:rgb(0, 255, 0);">+{{ $content['order'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body" id="small">
                            <h5 class="card-title">Reservation</h5>
                            @if ($content['reservasi'] >= 0)
                                <p class="card-text" style="color:rgb(0, 255, 0);">+{{ $content['reservasi'] }}</p>
                            @else
                                <p class="card-text" style="color:rgb(255, 0, 0);">-{{ $content['reservasi'] }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body" id="small">
                            <h5 class="card-title">Earning</h5>
                            <p class="card-text" style="color:rgb(0, 255, 0);">${{ number_format($content['earning'], 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body" id="small">
                            <h5 class="card-title">User</h5>
                            @if ($content['user'] >= 0)
                                <p class="card-text" style="color:rgb(0, 255, 0);">+{{ $content['user'] }}</p>
                            @else
                                <p class="card-text" style="color:rgb(255, 0, 0);">-{{ $content['user'] }}</p>
                            @endif
                            <p class="mb-0">Since last month</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings Chart -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">
                                <i class="fa-solid fa-chart-line fs-3"></i>
                                <span class="fs-4">Reservation</span>
                            </p>
                            <canvas id="reservasiChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var reservasiData = @json($reservasiChart);
        new Chart(document.getElementById("reservasiChart"), {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: 'Reservation',
                    fill: true,
                    borderColor: 'blue',
                    tension: 0.3,
                    data: reservasiData,
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        reverse: true,
                        gridLines: {
                            color: "rgba(0,0,0,0.05)"
                        }
                    }],
                    yAxes: [{
                        borderDash: [5, 5],
                        gridLines: {
                            color: "rgba(0,0,0,0)",
                            fontColor: "#F0DAA1"
                        }
                    }]
                }
            }
        });
    </script>
@endsection