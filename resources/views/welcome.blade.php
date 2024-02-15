@extends('landing-page.layouts.app')
@section('css-content')
    <link rel="stylesheet" href="{{ asset('asset-template/css/landing-page/welcome.css') }}">
@endsection

@section('content')
    <section id="hero-animation">
        <div id="landingHero" class="section-py bg-home position-relative">
            <div class="container">
               <div class="row">
                    <div class="col-lg-6 ps-lg-5">
                        <h5 class="fw-semibold logo-title"> Reading Room </h1>
                        <h1 class="fw-bold first-title"> Enjoy Your Reading, how much a book</h1>
                        <p class="fw-medium desc-title"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus inventore sit dolores possimus dolorum magni nulla ducimus, error quas ullam omnis beatae sint. Aspernatur repellendus qui quam deleniti ratione omnis.</p>
                        <a href="" class="btn btn-primary">Get Started</a>
                    </div>
                    <div class="col-lg-6">
                        <img src="{{asset('asset-template/img/front-pages/landing-page/book_home.svg')}}" class="mx-auto d-flex" width="300" alt="">
                    </div>
               </div>
            </div>
        </div>
        <!-- List book -->
        <div class="container">
            <div class="list-book my-3">
                <div class="title-list-book text-center">
                    <h2 class="first-title fw-bold"> Popular Book</h2>
                    <p class="fw-medium">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
               
                <div class="list-book d-flex justify-content-center mt-5">
                    @for ($i = 0; $i < 7; $i++)
                        <div class="card p-0 rounded-4">
                            <img src="{{ asset('asset-template/img/front-pages/landing-page/cover-buku.jpeg') }}" height="300"  class="book-cover" alt="...">
                            <div class="card-body p-3 text-center">
                                <p class="fw-bold first-title fs-5">Perahu Kertas</p>
                                <p class="book-category">Drama, Adventure, Horror</p>
                                <div class="d-flex justify-content-between">
                                    <div class="justify-content-start">
                                        <i class="ti ti-star-filled"></i>
                                        <i class="ti ti-star-filled"></i>
                                        <i class="ti ti-star-filled"></i>
                                        <i class="ti ti-star-filled"></i>
                                        <i class="ti ti-star-filled"></i>
                                    </div>
                                    <div>
                                        <i class="ti ti-eye-filled"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        <!-- Feature -->
        <div class="bg-feature">
            <div class="container py-5">
                <div class="row py-3">
                    <div class="col-3 text-center">
                        <i class="fa-solid fa-book"></i>
                        <p class="feature-desc fw-semibold mt-4"> Lorem ipsum dolor sit amet consectetur adipisicing elit.  </p>
                    </div>
                    <div class="col-3 text-center">
                        <i class="fa-solid fa-book"></i>
                        <p class="feature-desc fw-semibold mt-4"> Lorem ipsum dolor sit amet consectetur adipisicing elit.  </p>
                    </div>
                    <div class="col-3 text-center">
                        <i class="fa-solid fa-book"></i>
                        <p class="feature-desc fw-semibold mt-4"> Lorem ipsum dolor sit amet consectetur adipisicing elit.  </p>
                    </div>
                    <div class="col-3 text-center">
                        <i class="fa-solid fa-book"></i>
                        <p class="feature-desc fw-semibold mt-4"> Lorem ipsum dolor sit amet consectetur adipisicing elit.  </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- FAQ -->
        <div class="container py-5">
            <div class="row">
                <div class="col-md-5">
                    <h2 class="fw-bold title-faq">Frequenly Questions Asked</h2>
                    <div class="accordion my-3" id="accordionExample">
                        <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Apa Itu Jawabana nighre?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body bg-body pt-3">
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquid, fuga. Rem, fuga qui architecto praesentium eos porro esse, ab doloremque debitis aspernatur voluptatem. Magnam est in voluptates fugit quis soluta!</p>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="accordion my-3" id="accordionExample">
                        <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Apa Itu Jawabana nighre?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body bg-body pt-3">
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquid, fuga. Rem, fuga qui architecto praesentium eos porro esse, ab doloremque debitis aspernatur voluptatem. Magnam est in voluptates fugit quis soluta!</p>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="accordion my-3" id="accordionExample">
                        <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Apa Itu Jawabana nighre?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body bg-body pt-3">
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquid, fuga. Rem, fuga qui architecto praesentium eos porro esse, ab doloremque debitis aspernatur voluptatem. Magnam est in voluptates fugit quis soluta!</p>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 offset-lg-1">
                    <img src="{{asset('asset-template/img/front-pages/landing-page/faq.svg')}}" alt="" width="500" srcset="">
                </div>
            </div>
        </div>
        <!-- Contact -->
        <div class="bg-contact pt-3 pb-5">
            <div class="container">
                <div class="text-center">
                <h2 class="first-title fw-bold"> Contact Us</h2>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-5">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.0037117161755!2d107.5450063748744!3d-7.008844792992539!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68ee9f1c88006d%3A0xbadb406ee9e678ba!2sSMKN%201%20Katapang!5e0!3m2!1sid!2sid!4v1707292344447!5m2!1sid!2sid" 
                            width="500" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="col-lg-5 offset-lg-1">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="email" class="form-label fw-semibold">{{ __('USERNAME') }}</label>
                                    <input type="text" class="form-control"
                                        id="username" name="email" placeholder="Username" required
                                        autocomplete="username" autofocus value="{{ old('username') }}" />
                                   
                                </div>
                                <div class="col-lg-6">
                                    <label for="email" class="form-label fw-semibold">{{ __('EMAIL') }}</label>
                                    <input type="text" class="form-control"
                                        id="username" name="email" placeholder="Email" required
                                        autocomplete="username" autofocus value="{{ old('username') }}" />
                                   
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-6">
                                    <label for="email" class="form-label fw-semibold">{{ __('PHONE') }}</label>
                                    <input type="text" class="form-control"
                                        id="username" name="email" placeholder="Phone" required
                                        autocomplete="username" autofocus value="{{ old('username') }}" />
                                </div>
                                <div class="col-lg-6">
                                    <label for="email" class="form-label fw-semibold">{{ __('SUBJECT') }}</label>
                                    <input type="text" class="form-control"
                                        id="username" name="email" placeholder="Subject" required
                                        autocomplete="username" autofocus value="{{ old('username') }}" />
                                </div>'
                            </div>
                            <div>
                                <label for="email" class="form-label fw-semibold">{{ __('MESSAGE') }}</label>
                                <textarea name="" id="" cols="59" rows="5" ></textarea>
                            </div>
                            <div class="mt-2 d-flex justify-content-end">
                                <button class="btn btn-primary"> Kirim Pesan</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
