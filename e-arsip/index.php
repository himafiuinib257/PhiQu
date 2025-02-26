<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Login E-Arsip By PhiQu.web</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/floating-labels/">

    

    <!-- Bootstrap core CSS -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">



    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            padding-bottom: 20px;
        }
        .btn-hubungi {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 12px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s;
            text-decoration: none;
        }
        .btn-hubungi:hover {
            background-color: #0056b3;
        }

    </style>

    
    <!-- Custom styles for this template -->
    <link href="assets/css/floating-labels.css" rel="stylesheet">
  </head>
  <body>
    
<form class="form-signin" method="post" action="cek_login.php">
  <div class="text-center mb-4">
    <img class="mb-4" src="assets/PhiQu.png" alt="" width="100" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Login E-Arsip</h1>
    <p>By PhiQu.web</p>
    <p>Untuk tampilan yang lebih pas disarankan memakai PC atau Laptop</p>
  </div>

  <div class="form-label-group">
    <input type="text" id="username" name="username" class="form-control" placeholder="username" required autofocus>
    <label for="username">Username</label>
  </div>

  <div class="form-label-group">
    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
    <label for="password">Password</label>
  </div>

  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  <p class="mt-5 mb-3 text-muted text-center">&copy; Infokom HIMAFI-UINIB 2025-2026</p>
</form>

<a href="https://wa.me/6285880541399?text=Halo,%20saya%20ingin%20membuatkan%20akun%20e-arsip" class="btn-hubungi">Hubungi Admin</a>
    
  </body>
</html>
