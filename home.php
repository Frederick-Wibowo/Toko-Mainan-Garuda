<?php
session_start();
require 'koneksi.php';

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Logo - Toko Mainan Garuda</title>
    
    <!-- Google Fonts: Outfit (Sangat mirip dengan font bawaan Odoo) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-tan: #c49a6c;
            --secondary-slate: #4a5c6a;
            --text-dark: #333333;
            --bg-light: #faf9f6;
            --font-main: 'Outfit', sans-serif;
        }

        body {
            font-family: var(--font-main);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* --- NAVBAR --- */
        .navbar {
            padding: 15px 0;
            background-color: #fff;
            border-bottom: 1px solid #eaeaea;
        }
        .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            margin: 0 10px;
        }
        .btn-contact {
            background-color: var(--primary-tan);
            color: white !important;
            border-radius: 50px;
            padding: 8px 24px;
            font-weight: 500;
            border: none;
            transition: 0.3s;
        }
        .btn-contact:hover {
            background-color: #b3885b;
        }

        /* --- HERO SECTION --- */
        .hero-section {
            height: 80vh;
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('https://image s.unsplash.com/photo-1596461404969-9ce20c71c717?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            display: flex;
            align-items: center;
        }
        .hero-title {
            color: white;
            font-size: 4.5rem;
            font-weight: 600;
            line-height: 1.1;
            margin-bottom: 20px;
        }
        .hero-text {
            color: white;
            font-size: 1.1rem;
            margin-bottom: 30px;
            max-width: 500px;
        }
        .btn-hero {
            background-color: var(--primary-tan);
            color: #000;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s;
        }
        .btn-hero:hover {
            background-color: #b3885b;
            color: #000;
        }

        /* --- PARTY GAMES SECTION --- */
        .section-light {
            background-color: var(--bg-light);
            padding: 100px 0;
            position: relative;
        }
        .blob-img-1 {
            width: 100%;
            height: 400px;
            object-fit: cover;
            /* Border radius organik mirip gambar 2 */
            border-radius: 50% 20% 40% 10% / 40% 40% 60% 50%;
        }
        .dotted-divider {
            border-top: 3px dotted #ccc;
            width: 150px;
            margin: 15px 0 25px 0;
        }
        .btn-slate {
            background-color: var(--secondary-slate);
            color: white;
            border-radius: 50px;
            padding: 10px 25px;
            text-decoration: none;
            font-weight: 500;
            display: inline-block;
        }
        .btn-slate:hover {
            background-color: #384652;
            color: white;
        }

        /* --- THREE COLUMNS STORY --- */
        .blob-img-small {
            width: 250px;
            height: 200px;
            object-fit: cover;
            margin-bottom: 20px;
        }
        .blob-1 { border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%; }
        .blob-2 { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; border: 3px solid #6ab0b3; padding: 5px; } /* Mirip aksen hijau tosca di gambar 3 */
        .blob-3 { border-radius: 50% 50% 20% 80% / 25% 80% 20% 75%; }
        
        .story-title {
            font-size: 1.2rem;
            font-weight: 500;
            position: relative;
            display: inline-block;
        }
        .story-title::after {
            content: '';
            position: absolute;
            width: 100%;
            border-bottom: 3px dotted #ccc;
            bottom: -10px;
            left: 0;
        }

        /* --- FINEST SELECTION CARDS --- */
        .selection-title {
            font-weight: 600;
            margin-bottom: 40px;
            text-align: center;
        }
        .card-dashed {
            width: 160px;
            height: 160px;
            border: 2px dashed var(--secondary-slate);
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: white;
            transition: 0.3s;
            cursor: pointer;
        }
        .card-dashed:hover {
            background: var(--bg-light);
            transform: translateY(-5px);
        }
        .card-dashed i {
            font-size: 3rem;
            color: var(--primary-tan);
            margin-bottom: 15px;
        }
        .card-dashed span {
            font-weight: 500;
            color: var(--text-dark);
        }

        /* --- GEOMETRIC CTA SECTION --- */
        .cta-section {
            background-color: var(--bg-light);
            padding: 150px 0;
            position: relative;
            text-align: center;
            overflow: hidden;
        }
        .cta-title {
            font-size: 3rem;
            font-weight: 500;
            line-height: 1.2;
            margin-bottom: 15px;
            position: relative;
            z-index: 2;
        }
        .cta-text {
            color: #666;
            margin-bottom: 40px;
            position: relative;
            z-index: 2;
        }
        .btn-cta {
            background-color: var(--primary-tan);
            color: var(--text-dark);
            border-radius: 10px; /* Di gambar 5, tombol ini sedikit lebih kotak */
            padding: 12px 35px;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            position: relative;
            z-index: 2;
        }

        /* Ornamen Geometris Latar Belakang */
        .geo-shape {
            position: absolute;
            z-index: 1;
        }
        .triangle-1 { width: 0; height: 0; border-left: 40px solid transparent; border-right: 40px solid transparent; border-bottom: 70px solid var(--primary-tan); transform: rotate(30deg); top: 20%; left: 15%; opacity: 0.9; }
        .triangle-2 { width: 0; height: 0; border-left: 30px solid transparent; border-right: 30px solid transparent; border-bottom: 50px solid transparent; border-bottom-color: var(--bg-light); border: 4px solid var(--text-dark); top: 70%; right: 20%; transform: rotate(-40deg); }
        .circle-1 { width: 40px; height: 40px; border: 4px solid var(--text-dark); border-radius: 50%; top: 15%; left: 35%; }
        .circle-2 { width: 60px; height: 60px; background-color: var(--secondary-slate); border-radius: 50%; top: 25%; right: 20%; }
        .circle-3 { width: 30px; height: 30px; background-color: var(--primary-tan); border-radius: 50%; bottom: 15%; left: 25%; }
        .square-1 { width: 50px; height: 50px; background-color: var(--primary-tan); transform: rotate(45deg); top: 15%; right: 10%; }
    </style>
</head>
<body>

    <!-- 1. NAVBAR -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid px-4 px-md-5">
            <!-- Ikon Logo Placeholder -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="Images/logo.jpg" alt="Logo Toko Mainan Garuda" style="height: 60px; width: auto; object-fit: contain;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Shop</a></li>
                    <li class="nav-item ms-2"><a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fa-solid fa-magnifying-glass"></i></a></li>
                    <li class="nav-item ms-3 me-3"><span class="text-dark"><i class="fa-solid fa-phone me-1"></i>+62 896-1972-9582</span></li>
                    <li class="nav-item me-3"><a class="nav-link" href="login.php">Sign in</a></li>
                    <li class="nav-item"><a class="btn btn-contact" href="#">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- 2. HERO SECTION -->
    <section class="hero-section">
        <div class="container px-4 px-md-5">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="hero-title">A little place<br>of wonder</h1>
                    <p class="hero-text">Our goal is to create a safe and welcoming space where kids can play, learn, and grow.</p>
                    <a href="#" class="btn-hero">Play Today &nbsp; ></a>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. PARTY GAMES SECTION -->
    <section class="section-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center mb-4 mb-md-0">
                    <!-- Ganti src ini dengan gambar asli Anda nantinya -->
                    <img src="https://images.unsplash.com/photo-1596461404969-9ce20c71c717?auto=format&fit=crop&w=800&q=80" alt="Kids playing" class="blob-img-1 shadow-sm">
                </div>
                <div class="col-md-5 offset-md-1">
                    <h2 class="fw-normal" style="font-size: 3rem;">Party Games</h2>
                    <div class="dotted-divider"></div>
                    <p class="text-muted mb-4" style="font-size: 1.1rem; line-height: 1.8;">
                        Our team is composed of experienced toy experts.<br><br>
                        They offer educational toys, creative games, and age-appropriate fun for every child.
                    </p>
                    <a href="#" class="btn-slate">Shop now</a>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. OUR STORY (THREE COLUMNS) -->
    <section class="py-5 bg-white">
        <div class="container py-5 text-center">
            <div class="row g-5 justify-content-center">
                <!-- Col 1 -->
                <div class="col-md-4">
                    <img src="https://images.unsplash.com/photo-1587654780291-39c9404d746b?auto=format&fit=crop&w=400&q=80" class="blob-img-small blob-1" alt="Block">
                    <br>
                    <h5 class="story-title mt-3">Our story</h5>
                </div>
                <!-- Col 2 -->
                <div class="col-md-4">
                    <img src="https://images.unsplash.com/photo-1618842676088-c4d48a6a7c9d?auto=format&fit=crop&w=400&q=80" class="blob-img-small blob-2" alt="Boxes">
                    <br>
                    <h5 class="story-title mt-3">For every family</h5>
                </div>
                <!-- Col 3 -->
                <div class="col-md-4">
                    <img src="https://images.unsplash.com/photo-1558066556-3532c589cbdb?auto=format&fit=crop&w=400&q=80" class="blob-img-small blob-3" alt="Bunny">
                    <br>
                    <h5 class="story-title mt-3">Friendly service</h5>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. FINEST SELECTION (DASHED CARDS) -->
    <section class="py-5 bg-white">
        <div class="container pb-5">
            <h2 class="selection-title fs-2">Our finest selection</h2>
            
            <div class="d-flex flex-wrap justify-content-center gap-4 mt-5">
                <!-- Card 1 -->
                <div class="card-dashed">
                    <i class="fa-solid fa-horse-head"></i>
                    <span>About us</span>
                </div>
                <!-- Card 2 -->
                <div class="card-dashed">
                    <i class="fa-solid fa-person-breastfeeding"></i>
                    <span>Our team</span>
                </div>
                <!-- Card 3 -->
                <div class="card-dashed">
                    <i class="fa-brands fa-fort-awesome"></i>
                    <span>Playroom</span>
                </div>
                <!-- Card 4 -->
                <div class="card-dashed">
                    <i class="fa-solid fa-volleyball"></i>
                    <span>Events</span>
                </div>
                <!-- Card 5 -->
                <div class="card-dashed">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Shop Now</span>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. GEOMETRIC CTA SECTION -->
    <section class="cta-section">
        <!-- Ornamen Geometris Latar -->
        <div class="geo-shape triangle-1"></div>
        <div class="geo-shape triangle-2"></div>
        <div class="geo-shape circle-1"></div>
        <div class="geo-shape circle-2"></div>
        <div class="geo-shape circle-3"></div>
        <div class="geo-shape square-1"></div>
        
        <div class="container position-relative">
            <h2 class="cta-title">2,000 families<br>found the perfect toy at our store.</h2>
            <p class="cta-text">Find the perfect toy and shop with confidence every day</p>
            <a href="#" class="btn-cta">Contact Us</a>
        </div>
    </section>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>