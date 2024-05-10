<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Baca Buku {{ $buku->judul }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .scaling-squares-spinner,
        .scaling-squares-spinner * {
            box-sizing: border-box;
        }

        .scaling-squares-spinner {
            height: 65px;
            width: 65px;
            position: relative;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            animation: scaling-squares-animation 1250ms;
            animation-iteration-count: infinite;
            transform: rotate(0deg);
        }

        .scaling-squares-spinner .square {
            height: calc(65px * 0.25 / 1.3);
            width: calc(65px * 0.25 / 1.3);
            margin-right: auto;
            margin-left: auto;
            border: calc(65px * 0.04 / 1.3) solid #ff1d5e;
            position: absolute;
            animation-duration: 1250ms;
            animation-iteration-count: infinite;
        }

        .scaling-squares-spinner .square:nth-child(1) {
            animation-name: scaling-squares-spinner-animation-child-1;
        }

        .scaling-squares-spinner .square:nth-child(2) {
            animation-name: scaling-squares-spinner-animation-child-2;
        }

        .scaling-squares-spinner .square:nth-child(3) {
            animation-name: scaling-squares-spinner-animation-child-3;
        }

        .scaling-squares-spinner .square:nth-child(4) {
            animation-name: scaling-squares-spinner-animation-child-4;
        }


        @keyframes scaling-squares-animation {

            50% {
                transform: rotate(90deg);
            }

            100% {
                transform: rotate(180deg);
            }
        }

        @keyframes scaling-squares-spinner-animation-child-1 {
            50% {
                transform: translate(150%, 150%) scale(2, 2);
            }
        }

        @keyframes scaling-squares-spinner-animation-child-2 {
            50% {
                transform: translate(-150%, 150%) scale(2, 2);
            }
        }

        @keyframes scaling-squares-spinner-animation-child-3 {
            50% {
                transform: translate(-150%, -150%) scale(2, 2);
            }
        }

        @keyframes scaling-squares-spinner-animation-child-4 {
            50% {
                transform: translate(150%, -150%) scale(2, 2);
            }
        }

        .footer-alert {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #f44336;
            /* Red background color */
            color: white;
            text-align: center;
            padding: 15px;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.2);
            /* Drop shadow */
            animation: slideInUp 0.5s forwards;
            /* Animation */
            z-index: 1000;
            /* Ensure it's above other elements */
        }

        /* Accept and decline button styles */
        .footer-alert button {
            margin: 0 10px;
            padding: 8px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            outline: none;
            transition: background-color 0.3s;
        }

        .footer-alert button:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Animation keyframes */
        @keyframes slideInUp {
            from {
                transform: translateY(100%);
            }

            to {
                transform: translateY(0);
            }
        }

        @keyframes slideOutDown {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(100%);
            }
        }
    </style>
</head>

<body style="background-color: black">
    <div class="position-absolute top-50 start-50 translate-middle" id="loader">
        <div class="scaling-squares-spinner" :style="spinnerStyle">
            <div class="square"></div>
            <div class="square"></div>
            <div class="square"></div>
            <div class="square"></div>
        </div>
    </div>

    <div class="container">
        <center>
            <div class="pdf-viewer"></div>
        </center>

    </div>
    <input type="hidden" name="" id="member" value="{{ $checkMember }}">
    @if ($checkMember == 0)
        {{-- <script>
            Swal.fire({
                title: "Yout Not A Member!",
                text: "You're not right now a part. The book will be displayed on half the whole pages, on the off chance that you need to open all the pages, if it's not too much trouble enroll as a part by clicking Enroll ",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Enroll!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Swal.fire({
                    //     title: "Deleted!",
                    //     text: "Your file has been deleted.",
                    //     icon: "success"
                    // });
                    window.location.href = '{{ route('profile.membership') }}';
                }
            });
        </script> --}}
        <div class="footer-alert" id="footerAlert">
            <p>You're not right now a part. The book will be displayed on half the whole pages, on the off chance that
                you
                need to open all the pages, if it's not too much trouble enroll as a part by clicking Enroll </p>
            <button onclick="enroll()">Enroll</button>
            <button onclick="decline()">Decline</button>
        </div>
    @endif


    @if (session('suksesDaftar'))
        <script>
            swal.fire({
                icon: 'success',
                text: 'Berhasil Daftar Member',
            })
        </script>
    @endif

    <script src="{{ asset('js/pdf.worker.js') }}"></script>
    <script src="{{ asset('js/pdf.min.js') }}"></script>
    <script>
        function decline() {
            var footerAlert = document.getElementById("footerAlert");
            footerAlert.style.animation = "slideOutDown 0.5s forwards"; // Apply slide-out animation
            setTimeout(function() {
                footerAlert.style.display = "none"; // Hide the footer after animation completes
            }, 500); // Set timeout to match animation duration
        }
        function enroll(){
            window.location.href = '{{ route('profile.membership') }}';
        }
    </script>
    <script>
        // PDF BACA
        var pdfUrl = "{{ asset('uploads/buku/' . $buku->buku) }}";
        const member = document.getElementById("member").value;
        var pdfViewer = document.querySelector('.pdf-viewer');

        function showLoader() {
            var loader = document.getElementById('loader');
            loader.style.display = 'block';
        }

        // Hide loader function
        function hideLoader() {
            var loader = document.getElementById('loader');
            loader.style.display = 'none';
        }

        pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
            if (member == 0) {
                var pageCount = Math.ceil(pdf.numPages / 3);
            } else {
                var pageCount = pdf.numPages;
            }
            console.log(pageCount);

            var scale = 1.2;
            var numVisiblePages = 5;
            var renderedPages = {};

            function renderPage(pageNum) {
                if (!renderedPages[pageNum]) {
                    showLoader(); // Show loader before rendering

                    pdf.getPage(pageNum).then(function(page) {
                        var viewport = page.getViewport({
                            scale: scale
                        });
                        var canvas = document.createElement('canvas');
                        var context = canvas.getContext('2d');
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;

                        var renderContext = {
                            canvasContext: context,
                            viewport: viewport
                        };

                        page.render(renderContext).promise.then(function() {
                            var pdfPage = document.createElement('div');
                            pdfPage.classList.add('pdf-page');
                            pdfPage.appendChild(canvas);
                            pdfViewer.appendChild(pdfPage);

                            renderedPages[pageNum] = true;
                            hideLoader(); // Hide loader after rendering
                        });
                    });
                }
            }

            for (var i = 1; i <= numVisiblePages; i++) {
                renderPage(i);
            } // scroll Macam Web Manga Ini
            window.addEventListener('scroll', function() {
                var scrollTop = window.scrollY;
                var
                    scrollHeight = document.body.scrollHeight;
                var clientHeight = window.innerHeight;
                var scrollPercentage = (scrollTop /
                    (scrollHeight - clientHeight)) * 100;
                if (scrollPercentage > 70) {
                    var nextPage = Object.keys(renderedPages).length + 1;
                    if (nextPage <= pageCount) {
                        renderPage(nextPage);
                    }
                }
            });
        });
    </script>
</body>

</html>
