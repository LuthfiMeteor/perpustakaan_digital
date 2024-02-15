@extends('dashboard.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"><a class="text-muted"
                    href="{{ route('dashboard') }}">Dashboard</a> /</span>
            Manajemen Buku</h4>
        <div class="row">
            @include('sweetalert::alert')
            <div class="col-12">

                {{-- <ol class="breadcrumb text-muted fs-6 fw-bold">
                <li class="breadcrumb-item pe-3"><a href="{{ route('dashboard') }}"
                        class="pe-3 text-muted text-hover-dark">Dashboard</a></li>
                <li class="breadcrumb-item pe-3"><span class="pe-3 text-dark">Manajemen Buku</span></li>
            </ol> --}}
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12 py-2 md-2 mb-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="card-title text">
                            <h5>Manajemen Buku</h5>
                        </div>
                        <div class="text-right">
                            <button id="add" class="btn btn-info">
                                <span class="menu-icon tf-icons ti ti-plus"></span>
                                Buku
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
                                        <th class="text-center">Cover</th>
                                        <th class="text-center">Penulis</th>
                                        <th class="text-center">Kategori</th>
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
    </div>

    <div class="modal fade" tabindex="-1" id="modal">
        <div class="modal-dialog modal-lg">
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

                <form action="{{ route('bukuAdd') }}" method="POST" id="formAdd" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="form-label" for="Judul">Judul
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="judul" id="judul" class="form-control" autocomplete="off"
                                    required>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <label class="form-label" for="penulis">Penulis
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="penulis" id="penulis" class="form-control" autocomplete="off"
                                    required>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <label class="form-label" for="kategori">kategori
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="kategori[]" id="mySelect2" class="form-control" autocomplete="off" required>
                                    <!-- Anggap $kategori adalah variabel PHP yang berisi kategori -->
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 mt-3">
                                <label class="form-label" for="buku">Upload Buku
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="file" name="buku" id="buku" class="form-control"
                                    accept=".pdf, .doc, .docx" required>
                            </div>
                            <div class="col-lg-6 mt-3">
                                <label class="form-label" for="cover">Upload Cover
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="file" name="cover" id="cover" class="form-control"
                                    accept="image/*" required>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <label class="form-label" for="deskripsi">Deskripsi
                                    <span class="text-danger">*</span>
                                </label>
                                <div id="editor">
                                    <textarea name="deskripsi" id="deskripsi" class="form-control" required></textarea>
                                </div>
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

    <div id="responseLihat"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

    <script>
        $('#add').on('click', function() {
            $('#modal').modal('show');
        });

        $('#mySelect2').select2({
            dropdownParent: $('#modal'),
            multiple: true,
            width: '100%' // atau nilai yang Anda inginkan, seperti '300px' atau '75%'
        });

        $(document).ready(function() {
            const table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                order: [],
                ajax: {
                    url: "{{ route('bukuJson') }}",
                    type: 'GET', // Add this line to specify the HTTP request type
                    dataSrc: 'data' // Specify the property name containing the data array
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-center '
                    },
                    {
                        data: 'judul',
                        name: 'judul',
                        className: 'text-center '
                    },
                    {
                        data: 'cover',
                        name: 'cover',
                        className: 'text-center '
                    },
                    {
                        data: 'penulis',
                        name: 'penulis',
                        className: 'text-center '
                    },
                    {
                        data: 'kategori',
                        name: 'kategori',
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
        });

        $(document).ready(function() {
            ClassicEditor
                .create(document.querySelector('#editor'))
                .then(editor => {
                    $('#btnSubmitAdd').click(function(e) {
                        e.preventDefault();

                        // Get the CKEditor instance
                        var editorData = editor.getData();

                        // Set the content of CKEditor as the value of the textarea
                        $('#deskripsi').val(editorData);

                        // Submit the form
                        $('#formAdd').submit();
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        });

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
                    window.location.href = "{{ route('bukuHapus', '') }}/" + btnId;
                }
            });
        });


        $(document).on('click', '.btn-lihat', function() {
            var btnId = $(this).data('id');

            $.ajax({
                type: "GET",
                url: "{{ route('bukuLihat', '') }}" + "/" + btnId,
                success: function(response) {
                    console.log(response);
                    console.log(btnId);

                    $('#responseLihat').html(response);
                    $('#modalLihat').modal('show');
                }
            });
        });

        $(document).on('click', '.btn-edit', function() {
            var btnId = $(this).data('id');
            var editUrl = "{{ route('bukuEdit', '') }}" + "/" + btnId;
            window.location.href = editUrl;
        });
    </script>
@endsection
