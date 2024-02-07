@extends('dashboard.layouts.app')
@section('content')

<div class="container-fluid mt-3">
    <div class="row">
        @include('sweetalert::alert')
        <div class="col-12">

            <ol class="breadcrumb text-muted fs-6 fw-bold">
                <li class="breadcrumb-item pe-3"><a href="{{ route('dashboard') }}" class="pe-3 text-muted text-hover-dark">Dashboard</a></li>
                <li class="breadcrumb-item pe-3"><a href="{{ route('manajemenBuku') }}" class="pe-3 text-muted text-hover-dark">Manajemen Buku</a></li>
                <li class="breadcrumb-item pe-3"><span class="pe-3 text-dark">Edit Buku</span></li>
            </ol>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12 py-2 md-2 mb-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title text">
                        <h5>Edit Buku</h5>
                    </div>
                </div> 
                <div class="card-body">
                    <form action="{{ route('bukuUpdate') }}" method="POST" id="formAdd"  enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class="form-label" for="Judul">Judul
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="judul" id="judul" class="form-control" autocomplete="off" required value="{{ $data->judul_buku }}">
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <label class="form-label" for="penulis">Penulis
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="penulis" id="penulis" class="form-control" autocomplete="off" required  value="{{ $data->penulis }}">
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <label class="form-label" for="kategori">kategori
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="kategori" id="kategori" class="form-control" autocomplete="off" required value="{{ $data->kategori }}">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="form-label" for="buku">Upload Buku
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" name="buku" id="buku" class="form-control" accept=".pdf, .doc, .docx" required>
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti buku.</small>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <label class="form-label" for="cover">Upload Cover
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" name="cover" id="cover" class="form-control" accept="image/*" required>
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti cover.</small>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <label class="form-label" for="deskripsi">Deskripsi
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div id="editor">
                                        <textarea name="deskripsi" id="deskripsi" class="form-control" required>{{ strip_tags($data->deskripsi) }} </textarea>
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
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<script>
        $(document).ready(function () {
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                $('#btnSubmitAdd').click(function (e) {
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
    })
</script>
@endsection