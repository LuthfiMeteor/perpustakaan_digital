@extends('dashboard.layouts.app')
@section('content')
    <div class="container-fluid mt-3">
        <div class="row gy-5">
            @foreach ($favorit as $item)
                <div class="col-lg-3 col-sm-3">
                    <div class="card h-100 bg-label-primary text-white shadow-lg">
                        <div class="card-body">
                            <div class="bg-primary rounded-3 text-center mb-3 overflow-hidden">
                                <img class="img-pr img-fluid" src="{{ asset('uploads/cover/' . $item->cover) }}"
                                    alt="campaign image" />
                            </div>
                            <div>
                                <ul class="p-0 m-0">
                                    <li class="d-flex mb-3 pb-1">
                                        <div class="w-100 align-items-center d-flex">
                                            <div class="p-2 flex-grow-1">
                                                <h6 class="mb-2">{!! substr($item->judul_buku, 0, 80) !!}</small>
                                            </div>
                                            <div class="p-2">
                                                <a href="#" class="unlike"
                                                    data-id="{{ Crypt::encrypt($item->id) }}">
                                                    <i class="ti ti-heart-filled"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <a href="{{ route('bookDetail', ['id' => $item->id]) }}"
                                class="btn bg-secondary w-100 text-white">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Set up CSRF token for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Event listener for unlike button click
            $('.unlike').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var $this = $(this);
                $.ajax({
                    url: '{{ route('favorit') }}',
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function(res) {
                        $this.addClass('d-none');
                        $this.siblings('.unlike').removeClass('d-none');
                        window.location.reload();
                    },
                    error: function(err) {
                        // Handle errors if needed
                    },
                });
            });
        });
    </script>
@endsection
