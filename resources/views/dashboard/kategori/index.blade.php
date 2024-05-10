@extends('dashboard.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            @include('sweetalert::alert')
            <div class="col-12">
                <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a class="text-muted"
                            href="{{ route('dashboard') }}">Dashboard</a> /</span>
                    Category</h4>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12 py-2 md-2 mb-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="card-title text">
                            <h5>Manajemen Kategori</h5>
                        </div>
                        <div class="text-right">
                            <button id="add" class="btn btn-info">
                                <span class="menu-icon tf-icons ti ti-plus"></span>
                                Kategori
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-row-bordered table-row-gray-400 text-start"
                                id="table">
                                <thead class="fw-bolder">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Judul</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="modal">
        <div class="modal-dialog modal-s">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 role="button" class="text-hover-warning mb-0 modal-title">Tambah Data</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-dark svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1"
                                    transform="rotate(-45 7.05025 15.5356)" fill="currentColor" />
                                <rect x="8.46447" y="7.05029" width="12" height="2" rx="1"
                                    transform="rotate(45 8.46447 7.05029)" fill="currentColor" />
                            </svg>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('kategoriAdd') }}" method="POST" id="formAdd" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="form-label" for="nama">Nama Kategori
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nama" id="nama" class="form-control" autocomplete="off"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info" id="btnSubmitAdd">
                            <span class="indicator-label">
                                Submit
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="responseEdit"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            const table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                order: [],
                ajax: {
                    url: "{{ route('kategoriJson') }}",
                    type: 'GET', // Add this line to specify the HTTP request type
                    dataSrc: 'data' // Specify the property name containing the data array
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-center '
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        className: 'text-center '
                    },
                    {
                        data: 'edit',
                        name: 'edit',
                        className: 'text-center '
                    },
                ],
                "dom": "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                    ">" +
                    "<'table-responsive'tr>" +
                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">",
            });
        });;

        $(document).on('click', '.btn-hapus', function() {
            var btnId = $(this).data('id');
            console.log(btnId);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('kategoriHapus', '') }}/" + btnId;
                }
            });
        });

        $('#add').on('click', function() {
            $('#modal').modal('show');
        })

        $(document).on('click', '.btn-edit', function() {
            var btnId = $(this).data('id');

            $.ajax({
                type: "GET",
                url: "{{ route('kategoriEdit', '') }}" + "/" + btnId,
                success: function(response) {
                    console.log(response);
                    console.log(btnId);

                    $('#responseEdit').html(response);
                    $('#modalEdit').modal('show');
                }
            });
        });
    </script>
@endsection
