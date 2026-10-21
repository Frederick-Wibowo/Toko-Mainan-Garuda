<?php
session_start();
require 'koneksi.php';

$pesan = ""; // Variabel untuk menampilkan pesan sukses/gagal

// ===== PROSES SIGN UP =====
if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email_daftar'];
    // Enkripsi password menggunakan fungsi bawaan PHP agar aman di database
    $password = password_hash($_POST['password_daftar'], PASSWORD_DEFAULT);

    // Cek apakah email sudah pernah didaftarkan
    $cek_email = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
    if (mysqli_num_rows($cek_email) > 0) {
        $pesan = "<div class='alert alert-danger text-center small'>Email sudah terdaftar! Gunakan email lain.</div>";
    } else {
        $query = "INSERT INTO users (nama_lengkap, no_telepon, alamat, email, password) 
                  VALUES ('$nama', '$telepon', '$alamat', '$email', '$password')";
        if (mysqli_query($conn, $query)) {
            $pesan = "<div class='alert alert-success text-center small'>Pendaftaran berhasil! Silakan Sign In.</div>";
        } else {
            $pesan = "<div class='alert alert-danger text-center small'>Gagal mendaftar: " . mysqli_error($conn) . "</div>";
        }
    }
}

// ===== PROSES SIGN IN =====
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($query) === 1) {
        $user = mysqli_fetch_assoc($query);
        // Cek kecocokan password yang diketik dengan yang ada di database
        if (password_verify($password, $user['password'])) {
            // Jika cocok, simpan data ke dalam Session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nama'] = $user['nama_lengkap'];
            
            // Pindahkan pengguna ke halaman beranda
            header("Location: home.php");
            exit;
        } else {
            $pesan = "<div class='alert alert-danger text-center small'>Password salah!</div>";
        }
    } else {
        $pesan = "<div class='alert alert-danger text-center small'>Email tidak ditemukan!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Toko Mainan Garuda</title>
    
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-tan: #c49a6c;
            --secondary-slate: #4a5c6a;
            --bg-light: #faf9f6;
            --font-main: 'Outfit', sans-serif;
        }

        body {
            font-family: var(--font-main);
            background-color: var(--bg-light);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .auth-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            width: 100%;
            max-width: 450px;
            padding: 40px;
            border: none;
            margin: 30px 0; /* Memberi jarak jika form signup terlalu panjang */
        }

        .btn-custom {
            background-color: var(--primary-tan);
            color: white;
            border-radius: 10px;
            padding: 12px;
            font-weight: 500;
            border: none;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background-color: #b3885b;
            color: white;
        }

        /* Styling untuk Tabs */
        .nav-tabs {
            border-bottom: 2px solid #eaeaea;
            margin-bottom: 30px;
        }
        .nav-tabs .nav-link {
            border: none;
            color: #999;
            font-weight: 500;
            padding-bottom: 15px;
            background: transparent;
        }
        .nav-tabs .nav-link.active {
            color: var(--primary-tan);
            border-bottom: 3px solid var(--primary-tan);
        }
        
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #eaeaea;
        }
        .form-control:focus {
            border-color: var(--primary-tan);
            box-shadow: 0 0 0 0.25rem rgba(196, 154, 108, 0.25);
        }

        /* Mengubah warna teks placeholder menjadi abu-abu */
        .form-control::placeholder {
            color: #999999; 
            opacity: 1; 
        }
    </style>
</head>
<body>

    <div class="container d-flex justify-content-center">
        <div class="auth-card">
            
            <!-- Logo Header -->
            <div class="text-center mb-4">
                <a href="home.php">
                    <!-- Pastikan path gambar logo sesuai dengan folder Anda -->
                    <img src="Images/logo.jpg" alt="Logo Garuda" style="height: 60px; object-fit: contain;">
                </a>
            </div>

            <!-- Menampilkan Pesan Error/Sukses -->
            <?= $pesan; ?>

            <!-- Nav Tabs -->
            <ul class="nav nav-tabs nav-fill" id="authTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="signin-tab" data-bs-toggle="tab" data-bs-target="#signin" type="button" role="tab">Sign In</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="signup-tab" data-bs-toggle="tab" data-bs-target="#signup" type="button" role="tab">Sign Up</button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="authTabContent">
                
                <!-- Form Sign In -->
                <div class="tab-pane fade show active" id="signin" role="tabpanel">
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label class="form-label text-muted small">Email Address</label>
                            <input type="email" class="form-control" name="email" placeholder="contoh@email.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Masukkan password" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label text-muted small" for="rememberMe">Remember me</label>
                            </div>
                            <a href="#" class="text-decoration-none small" style="color: var(--primary-tan);">Forgot password?</a>
                        </div>
                        <button type="submit" name="login" class="btn btn-custom w-100">Sign In</button>
                    </form>
                </div>

                <!-- Form Sign Up -->
                <div class="tab-pane fade" id="signup" role="tabpanel">
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label class="form-label text-muted small">Full Name</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama lengkap" required>
                        </div>
                        
                        <!-- Kolom Nomor Telepon -->
                        <div class="mb-3">
                            <label class="form-label text-muted small">Phone Number</label>
                            <input type="tel" class="form-control" name="telepon" placeholder="Contoh: 08123456789" required>
                        </div>

                        <!-- Kolom Alamat -->
                        <div class="mb-3">
                            <label class="form-label text-muted small">Address</label>
                            <textarea class="form-control" name="alamat" rows="2" placeholder="Masukkan alamat lengkap" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small">Email Address</label>
                            <input type="email" class="form-control" name="email_daftar" placeholder="contoh@email.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small">Password</label>
                            <input type="password" class="form-control" name="password_daftar" placeholder="Buat password" required>
                        </div>
                        <button type="submit" name="register" class="btn btn-custom w-100 mt-2">Create Account</button>
                    </form>
                </div>

            </div>
            
            <!-- Tombol Kembali ke Home -->
            <div class="text-center mt-4">
                <a href="home.php" class="text-muted small text-decoration-none">< Kembali ke Beranda</a>
            </div>

        </div>
    </div>

    <!-- Bootstrap Script untuk fungsionalitas Tabs -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>