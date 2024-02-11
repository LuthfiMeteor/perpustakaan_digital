<div class="modal fade" tabindex="-1" id="modalLihat">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 role="button" class="text-hover-warning mb-0 modal-title">Deskripsi Buku</h3>

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
            <div class="modal-body">
                <div class="row">
                    <div class="col-6 d-flex justify-content-center">
                        <img src="{{ asset('uploads/cover/' . $data->cover) }}" alt="Cover" class="img-fluid mx-auto">
                    </div>
                    <div class="col-6">
                        <table class="table table-hover table-row-bordered table-row-white-400 text-start" id="table">
                            <tr>
                                <td>
                                    {{ $data->judul_buku }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{ $data->penulis }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @foreach ($kategori as $index => $item)
                                    {{ $item->nama }}
                                    @if ($index < count($kategori) - 1)
                                    ,  
                                    @endif
                                @endforeach
                                
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {!! $data->deskripsi !!}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
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
