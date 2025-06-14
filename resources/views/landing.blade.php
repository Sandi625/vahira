<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geoscope</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<!-- header section starts  -->

<header class="header">

    <a href="#" class="logo"> <i class="fas fa-hiking"></i> Bintaro Travel. </a>

 <nav class="navbar">
    <div id="nav-close" class="fas fa-times"></div>
    <a href="#home">home</a>
    <a href="#about">about</a>
    <a href="#shop">shop</a>
    <a href="#packages">packages</a>
    <a href="#reviews">reviews</a>
    <a href="#blogs">blogs</a>

    @guest
        <a href="{{ route('login') }}">login</a>
    @endguest

    @auth
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; padding: 0;">logout</button>
        </form>
    @endauth
</nav>


    <div class="icons">
        <div id="menu-btn" class="fas fa-bars"></div>
        <a href="#" class="fas fa-shopping-cart"></a>
        <div id="search-btn" class="fas fa-search"></div>
    </div>

</header>

<!-- header section ends -->

<!-- search form  -->

<div class="search-form">

    <div id="close-search" class="fas fa-times"></div>

    <form action="">
        <input type="search" name="" placeholder="search here..." id="search-box">
        <label for="search-box" class="fas fa-search"></label>
    </form>
</div>

<!-- home section starts  -->

<section class="home" id="home">

    <div class="swiper home-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide">
                <div class="box" style="background: url(images/nusa.jpg) no-repeat;">
                    <div class="content">
                        <span>Pantai</span>
                        <h3>Nusa Penida</h3>
                        <p></p>
                        <a href="#" class="btn">get started</a>
                    </div>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="box second" style="background: url(images/baluran.jpg) no-repeat;">
                    <div class="content">
                        <span>Savana</span>
                        <h3>Baluran</h3>
                        <p></p>
                        <a href="#" class="btn">get started</a>
                    </div>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="box" style="background: url(images/terakota.jpg) no-repeat;">
                    <div class="content">
                        <span>Desa</span>
                        <h3>Gandrung</h3>
                        <p></p>
                        <a href="#" class="btn">get started</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

    </div>

</section>

<!-- home section ends -->

<!-- category section starts  -->

<section class="category">

    <h1 class="heading">Destinasi</h1>

    <div class="box-container">

        <div class="box">
            <img src="images/baluran.jpg" alt="">
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

</section>

<!-- category section ends -->

<!-- about section starts  -->

<section class="about" id="about">

    <div class="image">
        <img src="images/8qq.jpg" alt="">
    </div>

    <div class="content">
        <h3>memorable outdoor experiences</h3>

        <a href="#" class="btn">read more</a>
    </div>

</section>

<!-- about section ends -->

<!-- shop section starts  -->

<section class="shop" id="shop">

    <h1 class="heading">featured products</h1>

    <div class="swiper product-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <div class="image">
                    <img src="images/product-1.jpg" alt="">
                    <div class="icons">
                        <a href="#" class="fas fa-shopping-cart"></a>
                        <a href="#" class="fas fa-eye"></a>
                        <a href="#" class="fas fa-share"></a>
                    </div>
                </div>
                <div class="content">
                    <h3>survival kits</h3>
                    <div class="price"> $5.00 - $25.00 </div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="image">
                    <img src="images/product-2.jpg" alt="">
                    <div class="icons">
                        <a href="#" class="fas fa-shopping-cart"></a>
                        <a href="#" class="fas fa-eye"></a>
                        <a href="#" class="fas fa-share"></a>
                    </div>
                </div>
                <div class="content">
                    <h3>survival kits</h3>
                    <div class="price"> $5.00 - $25.00 </div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="image">
                    <img src="images/product-3.jpg" alt="">
                    <div class="icons">
                        <a href="#" class="fas fa-shopping-cart"></a>
                        <a href="#" class="fas fa-eye"></a>
                        <a href="#" class="fas fa-share"></a>
                    </div>
                </div>
                <div class="content">
                    <h3>survival kits</h3>
                    <div class="price"> $5.00 - $25.00 </div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="image">
                    <img src="images/product-4.jpg" alt="">
                    <div class="icons">
                        <a href="#" class="fas fa-shopping-cart"></a>
                        <a href="#" class="fas fa-eye"></a>
                        <a href="#" class="fas fa-share"></a>
                    </div>
                </div>
                <div class="content">
                    <h3>survival kits</h3>
                    <div class="price"> $5.00 - $25.00 </div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="image">
                    <img src="images/product-5.jpg" alt="">
                    <div class="icons">
                        <a href="#" class="fas fa-shopping-cart"></a>
                        <a href="#" class="fas fa-eye"></a>
                        <a href="#" class="fas fa-share"></a>
                    </div>
                </div>
                <div class="content">
                    <h3>survival kits</h3>
                    <div class="price"> $5.00 - $25.00 </div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="image">
                    <img src="images/product-6.jpg" alt="">
                    <div class="icons">
                        <a href="#" class="fas fa-shopping-cart"></a>
                        <a href="#" class="fas fa-eye"></a>
                        <a href="#" class="fas fa-share"></a>
                    </div>
                </div>
                <div class="content">
                    <h3>survival kits</h3>
                    <div class="price"> $5.00 - $25.00 </div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>

        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

    </div>

</section>

<!-- shop section ends -->

<!-- packages section starts  -->

<section class="packages" id="packages">

    <h1 class="heading">popular packages</h1>

    <div class="box-container">
        @foreach ($pakets as $paket)
            <div class="box">
                <div class="image">
                    <img src="{{ asset($paket->foto) }}" alt="Foto Paket" class="card-img-top">
                </div>
                <div class="content">
                    <h3>{{ $paket->judul }}</h3>
                    <p>{{ Str::limit(strip_tags($paket->deskripsi), 100) }}</p>
                    <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($paket->harga, 0, ',', '.') }}</p>

                    @auth
                        <a href="#" class="btn">explore now</a>
                    @else
                        <a href="{{ route('login') }}" class="btn">Pesan</a>
                    @endauth
                </div>
            </div>
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
                        <span>designer</span>
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

<section class="services">

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

</section>

<!-- services section ends -->

<!-- blogs section starts  -->

<section class="blogs" id="blogs">

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

</section>


<!-- blogs section ends -->

<!-- newsletter section  -->

<section class="newsletter">

    <div class="content">
        <h1 class="heading">subscirbe now</h1>
        <p></p>
        <form action="">
            <input type="email" name="" placeholder="enter your email" id="" class="email">
            <input type="submit" value="subscirbe" class="btn">
        </form>
    </div>

</section>

<section class="clients">

    <div class="swiper clients-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide silde"><img src="images/client-logo-1.png" alt=""></div>
            <div class="swiper-slide silde"><img src="images/client-logo-2.png" alt=""></div>
            <div class="swiper-slide silde"><img src="images/client-logo-3.png" alt=""></div>
            <div class="swiper-slide silde"><img src="images/client-logo-4.png" alt=""></div>
        </div>
    </div>

</section>

<!-- footer section starts  -->

<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>quick links</h3>
            <a href="#home">home</a>
            <a href="#about">about</a>
            <a href="#shop">shop</a>
            <a href="#packages">packages</a>
            <a href="#reviews">reviews</a>
            <a href="#blogs">blogs</a>
        </div>

        <div class="box">
            <h3>extra links</h3>
            <a href="#">my account</a>
            <a href="#">my order</a>
            <a href="#">my wishlist</a>
            <a href="#">ask questions</a>
            <a href="#">terms of use</a>
            <a href="#">privacy policy</a>
        </div>

        <div class="box">
            <h3>contact info</h3>
            <a href="#"> <i class="fas fa-phone"></i> +123-456-7890 </a>
            <a href="#"> <i class="fas fa-phone"></i> +111-222-3333 </a>
            <a href="#"> <i class="fas fa-envelope"></i> Group4@gmail.com </a>
            <a href="#"> <i class="fas fa-map"></i> Madaraka Kenya - 400104 </a>
        </div>

        <div class="box">
            <h3>follow us</h3>
            <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
            <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
            <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
            <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
            <a href="#"> <i class="fab fa-github"></i> github </a>
        </div>

    </div>

    <div class="credit">created by <span>Vahira</span> | all rights reserved!</div>

</section>

<!-- footer section ends -->












<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
