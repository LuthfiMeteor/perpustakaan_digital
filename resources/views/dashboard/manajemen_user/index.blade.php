@extends('dashboard.layouts.app')
@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        @include('sweetalert::alert')
        <div class="col-12">

            <ol class="breadcrumb text-muted fs-6 fw-bold">
                <li class="breadcrumb-item pe-3"><a href="{{ route('dashboard') }}" class="pe-3 text-muted text-hover-dark">Dashboard</a></li>
                <li class="breadcrumb-item pe-3"><span class="pe-3 text-dark">Manajemen User</span></li>
            </ol>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12 py-2 md-2 mb-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title text">
                        <h5>Manajemen User</h5>
                    </div>
                    <div class="text-right">
                        {{-- <button id="add" class="btn btn-info">
                            <span class="menu-icon tf-icons ti ti-plus"></span>
                            User
                        </button> --}}
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-row-bordered table-row-gray-400 text-start" id="table">
                            <thead class="fw-bolder">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center" >Actions</th>
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
</div>

<div id="responseLihat"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

<script>

        $(document).ready(function () {
        const table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            order: [],
            ajax: {
                url: "{{ route('userJson') }}",
                type: 'GET', // Add this line to specify the HTTP request type
                dataSrc: 'data' // Specify the property name containing the data array
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center ' },
                { data: 'name', name: 'name', className: 'text-center ' },
                { data: 'email', name: 'email', className: 'text-center ' },
                { data: 'edit', name: 'edit', className: 'text-center ' },
            ],
            "dom":
                "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +
                "<'table-responsive'tr>" +
                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">",
        });
    });

    $(document).on('click', '.btn-hapus', function () {
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
                window.location.href = "{{ route('userHapus', '') }}/" + btnId;
            }
        });
    });

</script>
@endsection