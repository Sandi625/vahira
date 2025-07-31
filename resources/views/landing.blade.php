<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vahira Gestalia</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<!-- header section starts  -->

<header class="header">

   <a href="#" class="logo">
  <img src="{{ asset('images/ini.jpg') }}" alt="Bintoro Travel Logo" style="height: 30px; vertical-align: middle; margin-right: 8px;">
  Bintoro Travel
</a>


 <nav class="navbar">
    <div id="nav-close" class="fas fa-times"></div>
    <a href="#home">home</a>
    <a href="#about">about</a>
    {{-- <a href="#shop">shop</a> --}}
    <a href="#packages">packages</a>
    <a href="#reviews">reviews</a>
    {{-- <a href="#blogs">blogs</a> --}}

    @guest
        <a href="{{ route('login') }}" style="font-weight: bold;">login</a>

    @endguest

    @auth
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; padding: 0;">logout</button>
        </form>
    @endauth
</nav>


    {{-- <div class="icons">
        <div id="menu-btn" class="fas fa-bars"></div>
        <a href="#" class="fas fa-shopping-cart"></a>
        <div id="search-btn" class="fas fa-search"></div>
    </div> --}}

</header>

<!-- header section ends -->

<!-- search form  -->

{{-- <div class="search-form">

    <div id="close-search" class="fas fa-times"></div>

    <form action="">
        <input type="search" name="" placeholder="search here..." id="search-box">
        <label for="search-box" class="fas fa-search"></label>
    </form>
</div> --}}

<!-- home section starts  -->

<section class="home" id="home">

    <div class="swiper home-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide">
                <div class="box" style="background: url(images/nusa.jpg) no-repeat;">
                    {{-- <div class="content">
                        <span>Pantai</span>
                        <h3>Nusa Penida</h3>
                        <p></p>
                        <a href="#" class="btn">get started</a> --}}
                    </div>
                </div>
            </div>

            {{-- <div class="swiper-slide">
                <div class="box second" style="background: url(images/baluran.jpg) no-repeat;">
                    <div class="content">
                        <span>Savana</span>
                        <h3>Baluran</h3>
                        <p></p>
                        <a href="#" class="btn">get started</a>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="swiper-slide">
                <div class="box" style="background: url(images/terakota.jpg) no-repeat;">
                    <div class="content">
                        <span>Desa</span>
                        <h3>Gandrung</h3>
                        <p></p>
                        <a href="#" class="btn">get started</a>
                    </div>
                </div>
            </div>

        </div> --}}

        {{-- <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div> --}}

    </div>

</section>

<!-- home section ends -->

<!-- category section starts  -->

{{-- <section class="category">

    <h1 class="heading">Destinasi</h1>

    <div class="box-container">

        <div class="box">
            <img src="images/ijen.jpg" alt="">
            <h3>baluran</h3>
            <p>.</p>
            <a href="#" class="btn">read more</a>
        </div>

        <div class="box">
            <img src="images/ijen.jpg" alt="">
            <h3>ijen</h3>
            <p></p>
            <a href="#" class="btn">read more</a>
        </div>

        <div class="box">
            <img src="images/pulaumerah.jpg" alt="">
            <h3>pulau merah</h3>
            <p></p>
            <a href="#" class="btn">read more</a>
        </div>

        <div class="box">
            <img src="images/djawatan.jpg" alt="">
            <h3>djawatan</h3>
            <p></p>
            <a href="#" class="btn">read more</a>
        </div>

    </div>

</section> --}}

<!-- category section ends -->

<!-- about section starts  -->

<section class="about" id="about">

    <div class="image">
        <img src="images/oke.jpg" alt="">
    </div>

    <div class="content">
        <h3>About Us</h3>
        <p> Bintoro Tour and travel & Pariwisata adalah perusahaan yang bergerak di bidang transportasi dan pariwisata sejak tahun 2010. Berbasis di Kalibaru, Kabupaten Banyuwangi, kami menyediakan layanan transportasi antar kota dan perjalanan wisata dengan fokus utama pada area Jawa-Bali. Dengan pengalaman lebih dari 14 tahun, kami berkomitmen untuk memberikan pelayanan terbaik yang aman, nyaman, dan berkualitas kepada setiap pelanggan.</p>

        <a href="#" class="btn">read more</a>
    </div>

</section>


</section>

<!-- shop section ends -->

<!-- packages section starts  -->

<section class="packages" id="packages">
    <h1 class="heading">popular packages</h1>

    <div class="box-container">
        @foreach ($pakets as $paket)
            @if ($paket->status === 'KOUTA_TERSEDIA' || $paket->status === 'BERANGKAT_TANPA_PENUH')
                <div class="box">
                    <div class="image">
                        <img src="{{ asset($paket->foto) }}" alt="Foto Paket" class="card-img-top">
                    </div>
                    <div class="content">
                        <h3>{{ $paket->nama_paket }}</h3>
                        <p>{{ Str::limit(strip_tags($paket->deskripsi), 100) }}</p>
                        <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($paket->harga, 0, ',', '.') }}</p>
                        <p class="card-text"><strong>Kuota Bangku:</strong> {{ $paket->kuota }}</p> {{-- ✅ Tampilkan kuota --}}
                        <p class="card-text">
                            <strong>Status:</strong>
                            @if ($paket->status === 'KOUTA_TERSEDIA')
                                <span class="text-success">Kuota Tersedia</span>
                            @elseif ($paket->status === 'BERANGKAT_TANPA_PENUH')
                                <span class="text-warning">Berangkat (Tidak Penuh)</span>
                            @endif
                        </p>

                        @auth
                            <a href="#" class="btn">explore now</a>
                        @else
                            <a href="{{ route('login') }}" class="btn">Pesan</a>
                        @endauth
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</section>









<!-- packages section ends -->

<!-- reviews section starts  -->

<section class="reviews" id="reviews">

    <h1 class="heading">client's reviews</h1>

    <div class="swiper review-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <p class="text"></p>
                <div class="user">
                    <img src="images/pic-1.png" alt="">
                    <div class="info">
                        <h3>Dennis Nzioki</h3>
                        <span>pelanggan</span>
                        <p> wah sangat cepat dan nyaman</p>
                    </div>
                </div>
            </div>

            <div class="swiper-slide slide">
                <p class="text"></p>
                <div class="user">
                    <img src="images/pic-2.png" alt="">
                    <div class="info">
                        <h3>Eston Max</h3>
                        <span>designer</span>
                        <p>sangat terjangkau</p>
                    </div>
                </div>
            </div>

            <div class="swiper-slide slide">
                <p class="text"></p>
                <div class="user">
                    <img src="images/pic-3.png" alt="">
                    <div class="info">
                        <h3>Terry Joan</h3>
                        <span>Research</span>
                    </div>
                </div>
            </div>

            <div class="swiper-slide slide">
                <p class="text"></p>
                <div class="user">
                    <img src="images/pic-4.png" alt="">
                    <div class="info">
                        <h3>Vivean Murithi</h3>
                        <span>Developer</span>
                    </div>
                </div>
            </div>

            <div class="swiper-slide slide">
                <p class="text"></p>
                <div class="user">
                    <img src="images/pic-5.png" alt="">
                    <div class="info">
                        <h3>Klaus </h3>
                        <span>developer</span>
                    </div>
                </div>
            </div>



        </div>

    </div>

</section>

<!-- reviews section ends -->

<!-- services section starts  -->

{{-- <section class="services">

    <h1 class="heading"> what we offer </h1>

    <div class="box-container">

        <div class="box">
            <img src="images/serv-1.png" alt="">
            <h3>complete guide</h3>
            <p></p>
            <a href="#" class="btn">read more</a>
        </div>

        <div class="box">
            <img src="images/serv-2.png" alt="">
            <h3>custom packages</h3>
            <p></p>
            <a href="#" class="btn">read more</a>
        </div>

        <div class="box">
            <img src="images/serv-3.png" alt="">
            <h3>family trips</h3>
            <p></p>
            <a href="#" class="btn">read more</a>
        </div>

        <div class="box">
            <img src="images/serv-4.png" alt="">
            <h3>train guides</h3>
            <p></p>
            <a href="#" class="btn">read more</a>
        </div>

        <div class="box">
            <img src="images/serv-5.png" alt="">
            <h3>adventure trail</h3>
            <p></p>
            <a href="#" class="btn">read more</a>
        </div>

        <div class="box">
            <img src="images/serv-6.png" alt="">
            <h3>various adventures</h3>
            <p></p>
            <a href="#" class="btn">read more</a>
        </div>

    </div>

</section> --}}

<!-- services section ends -->

<!-- blogs section starts  -->

{{-- <section class="blogs" id="blogs">

    <h1 class="heading"> our daily posts </h1>

    <div class="swiper blogs-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <img src="images/baluran.jpg" alt="">
                <div class="icons">
                    <a href="#"> <i class="fas fa-calendar"></i> 21st may, 2010 </a>
                    <a href="#"> <i class="fas fa-user"></i> by admin </a>
                </div>
                <h3>blog title goes here.</h3>
                <p></p>
                <a href="#" class="btn">read more</a>
            </div>

            <div class="swiper-slide slide">
                <img src="images/ijen.jpg" alt="">
                <div class="icons">
                    <a href="#"> <i class="fas fa-calendar"></i> 21st may, 2018 </a>
                    <a href="#"> <i class="fas fa-user"></i> by admin </a>
                </div>
                <h3>blog title goes here.</h3>
                <p></p>
                <a href="#" class="btn">read more</a>
            </div>

            <div class="swiper-slide slide">
                <img src="images/pulaumerah.jpg" alt="">
                <div class="icons">
                    <a href="#"> <i class="fas fa-calendar"></i> 21st may, 2019 </a>
                    <a href="#"> <i class="fas fa-user"></i> by admin </a>
                </div>
                <h3>blog title goes here.</h3>
                <p></p>
                <a href="#" class="btn">read more</a>
            </div>

            <div class="swiper-slide slide">
                <img src="images/djawatan.jpg" alt="">
                <div class="icons">
                    <a href="#"> <i class="fas fa-calendar"></i> 1st may, 2021 </a>
                    <a href="#"> <i class="fas fa-user"></i> by admin </a>
                </div>
                <h3>blog title goes here.</h3>
                <p></p>
                <a href="#" class="btn">read more</a>
            </div>

            <div class="swiper-slide slide">
                <img src="images/baluran.jpg" alt="">
                <div class="icons">
                    <a href="#"> <i class="fas fa-calendar"></i> 21st may, 2022 </a>
                    <a href="#"> <i class="fas fa-user"></i> by admin </a>
                </div>
                <h3>blog title goes here.</h3>
                <p></p>
                <a href="#" class="btn">read more</a>
            </div>

            <div class="swiper-slide slide">
                <img src="images/ijen.jpg" alt="">
                <div class="icons">
                    <a href="#"> <i class="fas fa-calendar"></i> 29st June, 2023 </a>
                    <a href="#"> <i class="fas fa-user"></i> by admin </a>
                </div>
                <h3>blog title goes here.</h3>
                <p></p>
                <a href="#" class="btn">read more</a>
            </div>

        </div>

    </div>

</section> --}}


<!-- blogs section ends -->

<!-- newsletter section  -->

{{-- <section class="newsletter">

    <div class="content">
        <h1 class="heading">subscirbe now</h1>
        <p></p>
        <form action="">
            <input type="email" name="" placeholder="enter your email" id="" class="email">
            <input type="submit" value="subscirbe" class="btn">
        </form>
    </div>

</section> --}}

{{-- <section class="clients">

    <div class="swiper clients-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide silde"><img src="images/client-logo-1.png" alt=""></div>
            <div class="swiper-slide silde"><img src="images/client-logo-2.png" alt=""></div>
            <div class="swiper-slide silde"><img src="images/client-logo-3.png" alt=""></div>
            <div class="swiper-slide silde"><img src="images/client-logo-4.png" alt=""></div>
        </div>
    </div>

</section> --}}

<!-- footer section starts  -->

<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>quick links</h3>
            <a href="#home">home</a>
            <a href="#about">about</a>
            {{-- <a href="#shop">shop</a> --}}
            <a href="#packages">packages</a>
            <a href="#reviews">reviews</a>
            {{-- <a href="#blogs">blogs</a> --}}
        </div>

        {{-- <div class="box">
            <h3>extra links</h3>
            <a href="#">my account</a>
            <a href="#">my order</a>
            <a href="#">my wishlist</a>
            <a href="#">ask questions</a>
            <a href="#">terms of use</a>
            <a href="#">privacy policy</a>
        </div> --}}

        <div class="box">
            <h3>contact info</h3>
            <a href="#"> <i class="fas fa-phone"></i> 085333764801 (owner) </a>
            <a href="#"> <i class="fas fa-phone"></i> 083140625906 (admin) </a>
            <a href="#"> <i class="fas fa-envelope"></i> tegarbwi07@gmail.com </a>
        </div>

        <div class="box">
            <h3>follow us</h3>
            <a href="#"> <i class="fab fa-facebook-f"></i> Bintoro Travel </a>
            <a href="#"> <i class="fab fa-instagram"></i> bintorotravel </a>
        </div>

    </div>

    <div class="credit">created by <span>BintoroTravel</span> | all rights reserved!</div>

</section>

<!-- footer section ends -->




<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
