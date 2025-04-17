@extends('Admin.admin_dashboard')

@section('content')
    <style>
        .userSidebar {
            background-color: #FA9C14;
        }

        .recentUserCard {
            background-color: #F2D55F;
            max-width: 100%;
        }

        .recentUserRow {
            color: black;
        }
    </style>

    <main class="p-3">
        <div class="container-fluid p-4 pt-0" id="mainContent">
            <!-- Recent User -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card container-fluid">
                        <div class="row">
                            <h2>Recent User</h2>
                        </div>
                        <div class="row">
                            <div class="container-fluid d-flex flex-column justify-content-center">
                                @forelse ($user as $item)
                                    <div class="card recentUserCard my-2 py-3">
                                        <div class="row recentUserRow">
                                            <div class="col d-flex justify-content-start align-items-center">
                                                <i class="fa-solid fa-user mx-3" style="color: black;"></i>
                                                <span class="fw-bold">{{ $item->username }}</span>
                                            </div>
                                            <div class="col d-flex justify-content-center align-items-center">
                                                <p class="mb-0" style="color: black;">{{ $item->tanggal_register }}</p>
                                            </div>
                                            <div class="col d-flex justify-content-end align-items-center">
                                                <form action="{{ route('user.delete', $item->id_user) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger rounded-pill mx-3"
                                                        style="color: rgb(255, 255, 255);" type="submit">
                                                        DELETE
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="alert alert-danger">
                                        Data user belum tersedia
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- User Chart -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">
                                <i class="fa-solid fa-chart-line fs-3"></i>
                                <span class="fs-4">User Activity</span>
                            </p>
                            <canvas id="userChart"></canvas>
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
        var userData = @json($userCounts);
        new Chart(document.getElementById("userChart"), {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "User Registrations",
                    backgroundColor: "#FB9D14",
                    hoverBackgroundColor: "#EE7804",
                    data: userData,
                    barPercentage: .75,
                    categoryPercentage: .5
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false
                        },
                        stacked: false
                    }],
                    xAxes: [{
                        stacked: false,
                        gridLines: {
                            color: "transparent"
                        }
                    }]
                }
            }
        });
    </script>
@endsection
