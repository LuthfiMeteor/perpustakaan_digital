<div class="modal fade" tabindex="-1" id="modalEdit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 role="button" class="text-hover-warning mb-0 modal-title">Edit Data</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-dark svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor"/>
                            <rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor"/>
                        </svg>
                    </span>
                </div>
                <!--end::Close-->
            </div>

            <form action="{{ route('kategoriUpdate') }}" method="POST" id="formAdd">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 mt-3">
                            <label class="form-label">Nama Kategori</label>
                            <span class="text-danger">*</span></label>
                            <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="{{ $data->nama }}">
                            <input type="hidden" name="id" id="id" value="{{ $data->id }}">
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

<script>
    $('#btnSubmitUpdate').click(function (e) {
        e.preventDefault()
        $(this).prop('disabled', true);
        $(this).attr('data-kt-indicator', 'on');
        $('#formSubmitUpdate').submit();
    })
</script>