@extends('landing-page.layouts.app')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.3.0/tabler-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <div class="container mt-5 pt-5 mb-3">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-4">
                        <img src="{{ asset('uploads/cover/' . $buku->cover) }}" alt="" class="img-fluid"
                            style="width: 300px" />
                        <div class="bg-dark rounded-3 mt-2 p-2 d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div id="rateYo"></div>
                            </div>
                            <div>
                                <p class="mb-0 text-light">{{ $buku->rating }}</p>
                            </div>
                        </div>
                    </div>
                    @php
                        $kategoriArray = json_decode($buku->kategori, true);
                        if ($kategoriArray !== null) {
                            $namaKategoris = [];

                            foreach ($kategoriArray as $kategoriId) {
                                $kategori = App\Models\Kategori::find($kategoriId);
                                if ($kategori) {
                                    $namaKategori[] = $kategori->nama;
                                } else {
                                    $namaKategori[] = '-';
                                }
                            }
                        }
                    @endphp
                    <div class="col-lg-8 mt-4 mt-lg-0 text-break">
                        <div class="fs-2 fw-bold mb-1 ">{{ $buku->judul_buku }}</div>
                        <ul class=" fs-5">
                            <li style="list-style: square">Author &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
                                {{ $buku->penulis }}
                            </li>
                            {{-- <li style="list-style: square">Penerbit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
                                {{ $buku->penerbit }} </li> --}}
                            <li style="list-style: square">Category &nbsp;&nbsp;&nbsp;&nbsp; :
                                {{ implode(', ', $namaKategori) }} </li>
                        </ul>
                        <small>
                            {!! $buku->deskripsi !!}
                        </small>
                        <br>
                        <br>
                        <br>
                        <div class="fs-5 mb-4">
                            <!-- Empty heart icon -->
                            @php
                                $user = Auth::user();

                                if ($user) {
                                    $kaloFav = $user
                                        ->favoritBy()
                                        ->where('buku_id', $buku->id)
                                        ->exists();
                                } else {
                                    $kaloFav = false;
                                    // dd($kaloFav);
                                }
                            @endphp
                            @if (!$kaloFav)
                                <a href="#" id="tambahFavorit" class="btn btn-primary heart-icon like"
                                    data-id="{{ Crypt::encrypt($buku->id) }}">
                                    <i class="ti ti-heart"></i>
                                </a>
                            @else
                                <!-- Filled heart icon (hidden by default) -->
                                <a href="#" class="btn btn-primary heart-icon unlike"
                                    data-id="{{ Crypt::encrypt($buku->id) }}">
                                    <i class="ti ti-heart-filled"></i>
                                </a>
                            @endif
                            @if (Auth::check())
                                <a target="_blank" href="{{ route('bacaBuku', [Crypt::encrypt($buku->id)]) }}"
                                    class="btn btn-primary text-light">Read Now</a>
                            @else
                                <a id="suruhLoginDulu" class="btn btn-primary  text-light">Read Now</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5">
            @php
                if (Auth::user()) {
                    $komentarCheck = Auth::user()
                        ->komentarBy()
                        ->where('buku_id', $buku->id)
                        ->first();
                } else {
                    $komentarCheck = false;
                }
                // dd($komentarCheck);
            @endphp
            @role('user')
                @if (!$komentarCheck)
                    <div class="fs-4">
                        Comments
                    </div>
                    @if (Auth::user())
                        <form id="commentForm" action="{{ route('kirimKomentar') }}" method="post">
                            @csrf
                            <div class="row p-0">
                                <div class="col-12 col-sm-9 col-md-8 col-xl-9">
                                    <input class="form-control" type="text" required name="komentar" id=""
                                        placeholder="tulis komentarmu">
                                    <input type="hidden" name="buku_id" value="{{ Crypt::encrypt($buku->id) }}">
                                </div>
                                <div class="col-12 col-sm-2 col-md-3 col-xl-2">
                                    <div id="rateYo2"></div>
                                </div>
                                <div class="col-1">
                                    <button type="button" id="submitBtn" class="btn btn-primary">kirim</button>
                                </div>
                            </div>
                        </form>
                    @endif
                @else
                    <div class="fs-4">
                        My Comment
                    </div>
                    {{-- <form action="{{ route('kirimKomentar') }}" method="post">
                        @csrf
                        <div class="row p-0">
                            <div class="col-10">
                                <input class="form-control" type="text" name="komentar" id=""
                                    placeholder="tulis komentarmu">
                                <input type="hidden" name="buku_id" value="{{ Crypt::encrypt($buku->id) }}">
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary">kirim</button>
                            </div>
                        </div>
                    </form> --}}
                    <div class="row mb-4">
                        <div class="col-2 col-md-1 mt-2">
                            <img src="{{ asset('storage/profiles/' . Auth::user()->avatar) }}" alt=""
                                class="img-fluid rounded-circle" width="70px">
                        </div>
                        <div class="col-10 col-md-11 mt-2">
                            <div class="row">
                                {{-- <div class="col-md-1 d-none d-md-block"> <!-- Added column for spacing on larger screens -->
                                </div> --}}
                                <div class="col-12 col-md-11">
                                    <div id="rateYosudah"></div>
                                    <textarea style="resize: none;" readonly class="form-control mt-2" name="" id="" cols="2"
                                        rows="3">{{ $komentarCheck->komentar }}</textarea>
                                </div>
                            </div>
                        </div>
                        <script>
                            $("#rateYosudah").rateYo({
                                starWidth: "20px",
                                rating: {{ $komentarCheck->rating }},
                                readOnly: true
                            });
                        </script>
                    </div>
                @endif
            @endrole

            <div class="fs-4 mt-2">All Comment</div>
            <hr>
            @php
                if (Auth::user()) {
                    $allKomentar = \App\Models\KomentarModel::with('komentarOleh')
                        ->where('buku_id', $buku->id)
                        ->where('user_id', '!=', Auth::id())
                        ->paginate(5);
                } else {
                    $allKomentar = \App\Models\KomentarModel::with('komentarOleh')
                        ->where('buku_id', $buku->id)
                        ->paginate(5);
                    // dd($allKomentar);
                }
            @endphp

            @foreach ($allKomentar as $key => $item)
                <div class="row">
                    <div class="col-1 col-md-1  mt-4">
                        <img src="{{ asset('storage/profiles/' . $item->komentarOleh->avatar) }}" alt=""
                            class="img-fluid rounded-2" srcset="" width="70px">
                    </div>
                    <div class="col-11 mt-3">
                        <div class="card border-1">
                            <div class="fs-5 p-2">
                                {{ $item->komentarOleh->name }}
                            </div>
                            <p class="text-break p-2">
                                {{ $item->komentar }}
                            </p>
                            <div class="rateYoAll_{{ $key }} p-2"></div>
                        </div>
                    </div>
                </div>
                <script>
                    $(".rateYoAll_{{ $key }}").rateYo({
                        starWidth: "20px",
                        rating: {{ $item->rating }},
                        readOnly: true
                    });
                </script>
            @endforeach
            <div class="mt-2">
                {{ $allKomentar->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $(function() {
                $("#rateYo").rateYo({
                    starWidth: "25px",
                    rating: {{ $buku->rating }},
                    readOnly: true
                });
            });

            /* Javascript */

            $(function() {

                $("#rateYo2").rateYo({
                    starWidth: "30px"
                });

            });


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#submitBtn').click(function() {
                var rating = $('#rateYo2').rateYo("rating");

                // Prepare form data
                var formData = $('#commentForm').serializeArray();
                formData.push({
                    name: "rating",
                    value: rating
                });
                // console.log(rating);

                $.ajax({
                    url: "{{ route('kirimKomentar') }}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.log(error);
                    }
                });
            });
            $('.like').click(function(e) {
                e.preventDefault();
                var $this = $(this);
                var id = $(this).data('id');
                console.log(id);
                $.ajax({
                    url: '{{ route('favorit') }}',
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function(res) {
                        $this.addClass('d-none');
                        $this.siblings('.like').removeClass('d-none');
                        window.location.reload();
                    },
                    error: function(err) {
                        swal.fire({
                            icon: 'error',
                            text: 'silahkan login dahulu',
                        });
                    },
                });
            });
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

                    },
                });
            });
            $('#suruhLoginDulu').click(function() {
                swal.fire({
                    icon: 'error',
                    text: 'Silahkan Login Dulu'
                })
            });
        });
    </script>
@endsection
