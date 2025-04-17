@extends('Admin.admin_dashboard')

@section('content')
    <style>
        .menuSidebar {
            background-color: #FA9C14;
        }

        .form-control {
            border-radius: 20px;
        }

        .btn {
            color: white;
        }

        .recentMenuCard {
            background-color: #F2D55F;
            max-width: 100%;
            border-start-start-radius: 30px;
        }

        .recentMenuRow {
            color: black;
        }

        img {
            border-radius: 0%;
        }
    </style>

    <main class="p-3">
        <div class="container-fluid p-4 pt-0" id="mainContent">
            <!-- Tambah Menu -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card container-fluid rounded" style="background-color: #F2D55F">
                        <div class="row m-3">
                            <h2>Tambah dan Kelola Menu</h2>
                        </div>
                        <div class="row">
                            <div class="container-fluid d-flex flex-column justify-content-center p-0">
                                <form class="container-fluid p-0" action="{{ route('menu.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="ms-5">
                                        <p class="m-0" style="padding-left:1vw;"><strong>Nama Menu</strong></p>
                                        <div class="form-floating mb-2">
                                            <input type="text" class="form-control" id="namaMenu"
                                                placeholder="Nama Menu" style="width:60%;padding-left:2.2rem;" name="nama"required>
                                            <label for="namaMenu" style="padding-left:2vw;">Nama Menu</label>
                                        </div>

                                        <p style="padding-left:1vw;margin:0;margin-top:2vh;"><strong>Harga</strong></p>
                                        <div class="form-floating mb-2">
                                            <input type="text" class="form-control" id="harga" placeholder="Harga"
                                                style="width:60%;padding-left:2.2rem;" name="harga"required>
                                            <label for="harga" style="padding-left:2vw;">Harga</label>
                                        </div>

                                        <p style="padding-left:1vw;margin:0;margin-top:2vh;"><strong>Jenis</strong></p>
                                        <div class="form-floating mb-2">
                                            <select class="form-select" name="jenis" reqired style="width:60%;border-radius:20px;padding:0;margin:0;padding-left:2.2rem;">
                                                <option value="" selected disabled>Pilih Jenis</option>
                                                <option value="Noodle">Noodle</option>
                                                <option value="Rice">Rice</option>
                                                <option value="Drink">Drink</option>
                                            </select>
                                        </div>
                                        <p style="padding-left:1vw;margin:0;margin-top:2vh;">Gambar</p>
                                        <div class="form-floating-fluid">
                                            <input type="file" class="form-control" id="gambar" placeholder="Gambar"
                                                style="width:60%;" name="gambar_makanan" required>
                                        </div>
                                    </div>

                                    <div class="container-fluid mt-3 d-flex justify-content-end align-items-center"
                                        style="background-color: #ED7804; height: 7vh;">
                                        <button class="btn btn-danger mx-2 rounded-pill fw-bold" type="reset">
                                            CANCEL
                                        </button>
                                        <button class="btn btn-success mx-2 rounded-pill fw-bold" type="submit">
                                            ADD
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recently Added Menu --}}
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card container-fluid p-3" style="background-color: #ffffff">
                        <div class="row m-3">
                            <h5>Recently Added Menu</h5>
                        </div>
                        @forelse ($menu as $item)
                            <div class="card recentMenuCard my-2 p-0 mx-5"style="height:50%">
                                <div class="row recentMenuRow">
                                    <div class="col d-flex justify-content-start" style="max-width:20%">
                                        <img src="{{ asset($item->gambar_makanan) }}" class="img-fluid"
                                            style="object-fit:cover; border-radius:8px; min-width:75%; max-width:75%;max-height:100%;min-height:100%;">
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <h3 class="fw-bold my-4">{{ $item->nama }}</h3>
                                        </div>
                                    
                                        <div class="row">
                                            <h4>Price: <Strong>{{ $item->harga }}</Strong></h4>
                                        </div>
                                        <div class="row">
                                            <h4>Jenis: <Strong>{{ $item->jenis }}</Strong></h4>
                                        </div>
                                    </div>
                                    <div class="col d-flex justify-content-end align-items-end me-4 mb-2">
                                        <a class="btn btn-success rounded-pill" style="color: rgb(255, 255, 255);"
                                            href="{{ route('menu.edit', $item->id_menu) }}">
                                            EDIT
                                        </a>
                                        <form action="{{ route('menu.delete', $item->id_menu) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger rounded-pill ms-2"
                                                style="color: rgb(255, 255, 255);" type="submit">
                                                DELETE
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-danger">
                                Data menu belum tersedia
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="message"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @php
        $sessionMessage = session('success') ?? session('error');
    @endphp

    @if ($sessionMessage)
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                @if (session('success'))
                    document.getElementById('modalLabel').innerText = "Success";
                    document.getElementById('message').innerText = "{{ session('success') }}";
                    bootstrap.Modal.getOrCreateInstance(document.getElementById('modal')).show();
                @elseif (session('error'))
                    document.getElementById('modalLabel').innerText = "Error";
                    document.getElementById('message').innerText = "{{ session('error') }}";
                    bootstrap.Modal.getOrCreateInstance(document.getElementById('modal')).show();
                @endif
            });
        </script>
    @endif
@endsection
