<?php include "config.php"; session_start();?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from preview.colorlib.com/theme/shopmax/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 06 May 2023 19:00:05 GMT -->

<head>
  <title>ShopMax &mdash; Colorlib e-Commerce Template</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
  <link rel="stylesheet" href="front/fonts/icomoon/style.css">
  <link rel="stylesheet" href="front/css/bootstrap.min.css">
  <link rel="stylesheet" href="front/css/magnific-popup.css">
  <link rel="stylesheet" href="front/css/jquery-ui.css">
  <link rel="stylesheet" href="front/css/owl.carousel.min.css">
  <link rel="stylesheet" href="front/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="front/css/aos.css">
  <link rel="stylesheet" href="front/css/style.css">
  <script nonce="33500a31-01e6-4820-b5ce-7272b1b347b9">(function (w, d) { !function (dk, dl, dm, dn) { dk[dm] = dk[dm] || {}; dk[dm].executed = []; dk.zaraz = { deferred: [], listeners: [] }; dk.zaraz.q = []; dk.zaraz._f = function (dp) { return function () { var dq = Array.prototype.slice.call(arguments); dk.zaraz.q.push({ m: dp, a: dq }) } }; for (const dr of ["track", "set", "debug"]) dk.zaraz[dr] = dk.zaraz._f(dr); dk.zaraz.init = () => { var ds = dl.getElementsByTagName(dn)[0], dt = dl.createElement(dn), du = dl.getElementsByTagName("title")[0]; du && (dk[dm].t = dl.getElementsByTagName("title")[0].text); dk[dm].x = Math.random(); dk[dm].w = dk.screen.width; dk[dm].h = dk.screen.height; dk[dm].j = dk.innerHeight; dk[dm].e = dk.innerWidth; dk[dm].l = dk.location.href; dk[dm].r = dl.referrer; dk[dm].k = dk.screen.colorDepth; dk[dm].n = dl.characterSet; dk[dm].o = (new Date).getTimezoneOffset(); if (dk.dataLayer) for (const dy of Object.entries(Object.entries(dataLayer).reduce(((dz, dA) => ({ ...dz[1], ...dA[1] }))))) zaraz.set(dy[0], dy[1], { scope: "page" }); dk[dm].q = []; for (; dk.zaraz.q.length;) { const dB = dk.zaraz.q.shift(); dk[dm].q.push(dB) } dt.defer = !0; for (const dC of [localStorage, sessionStorage]) Object.keys(dC || {}).filter((dE => dE.startsWith("_zaraz_"))).forEach((dD => { try { dk[dm]["z_" + dD.slice(7)] = JSON.parse(dC.getItem(dD)) } catch { dk[dm]["z_" + dD.slice(7)] = dC.getItem(dD) } })); dt.referrerPolicy = "origin"; dt.src = "../../cdn-cgi/zaraz/sd0d9.js?z=" + btoa(encodeURIComponent(JSON.stringify(dk[dm]))); ds.parentNode.insertBefore(dt, ds) };["complete", "interactive"].includes(dl.readyState) ? zaraz.init() : dk.addEventListener("DOMContentLoaded", zaraz.init) }(w, d, "zarazData", "script"); })(window, document);</script>
</head>

<body>
  <div class="site-wrap">
    <div class="site-navbar bg-white py-2">
      <div class="search-wrap">
        <div class="container">
          <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
          <form action="#" method="post">
            <input type="text" class="form-control" placeholder="Search keyword and hit enter...">
          </form>
        </div>
      </div>
      <div class="container">
        <div class="d-flex align-items-center justify-content-between">
          <div class="logo">
            <div class="site-logo">
              <a href="index.html" class="js-logo-clone">Bazar.PK</a>
            </div>
          </div>
          <div class="main-nav d-none d-lg-block">
            <nav class="site-navigation text-right text-md-center" role="navigation">
              <ul class="site-menu js-clone-nav d-none d-lg-block">
                <li class=" active">
                  <a href="index.php">Home</a>
                  <!-- <ul class="dropdown">
                    <li><a href="#">Menu One</a></li>
                    <li><a href="#">Menu Two</a></li>
                    <li><a href="#">Menu Three</a></li>
                    <li class="has-children">
                      <a href="#">Sub Menu</a>
                      <ul class="dropdown">
                        <li><a href="#">Menu One</a></li>
                        <li><a href="#">Menu Two</a></li>
                        <li><a href="#">Menu Three</a></li>
                      </ul>
                    </li>
                  </ul> -->
                </li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="#">Catalogue</a></li>
                <li><a href="#">New Arrivals</a></li>
                <li><a href="contact.html">Contact</a></li>
              </ul>
            </nav>
          </div>
          <div class="icons">
            
            <a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a>
            <a href="#" class="icons-btn d-inline-block"><span class="icon-heart-o"></span></a>
            <a href="cart.php" class="icons-btn d-inline-block bag">
              <span class="icon-shopping-bag"></span>
              <span class="number">2</span>
            </a>

            <?php
              if(isset($_SESSION['email'])){
                $name= substr($_SESSION['email'], 0, 5);
                echo "
                <div class='dropdown  d-inline-block bag' style='margin-left:20px'>
                  <span class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton2' data-toggle='dropdown' aria-expanded='false'>
                    $name <img src='Photos/User/$_SESSION[image]' style='width:25px;height:25px' class='d-inline-block rounded-circle'/>  
                  </span>
                  <ul class='dropdown-menu dropdown-menu-dark' aria-labelledby='dropdownMenuButton2'>
                    <li><a class='dropdown-item active' href='#'>Action</a></li>
                    <li><a class='dropdown-item' href='#'>Another action</a></li>
                    <li><a class='dropdown-item' href='#'>Something else here</a></li>
                    <li><hr class='dropdown-divider'></li>
                    <li><a href='logOut.php' class='dropdown-item' style='margin-left:10px'><span>LogOut</span></a> </li>
                  </ul>
                </div>
                ";
              }
              else{
                echo "
                <a href='Registor.php' class='icons-btn d-inline-block'><span class='icon-user'></span> </a>
                <a href='Login.php' class='icons-btn d-inline-block'><span class='icon-user-circle-o'></span></a>
                
                ";
              }
            ?>


            <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span
                class="icon-menu"></span></a>
          </div>
        </div>
      </div>
    </div>
