<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/kintondev.css?v=<?php echo time(); ?>">
    <title>Kinton Developer</title>
</head>
<body>
<div class="scrollUp" onclick="scrollToUp();"></div>
<!-- Navbar Bottom -->
<header class="nav-top-mg">
    <div class="logo">
        <a href="kintondev.php">
            Kinton Developer
        </a>
    </div>
</header>
<!-- Navbar Bottom -->
<!-- Team -->
<section class="teams">
<div class="team-wrapper">
      <div class="container-team">
        <div class="team">
            <div class="logo">
                <i class="fas fa-user-cog"></i>
            </div>
            <div class="title">
              <h3>Rayhan Rizki Putra</h3>
            </div>
            <div class="content">
              <p>12008115</p>
              <p>RPL X-3</p>
              <p>Wikrama 2</p>
            </div>
        </div>
        <div class="team">
            <div class="logo">
                <i class="fas fa-user-cog"></i>
            </div>
            <div class="title">
              <h3>Muhammad Syafwan Ardiansyah</h3>
            </div>
            <div class="content">
              <p>12008020</p>
              <p>RPL X-3</p>
              <p>Wikrama 4</p>
            </div>
        </div>
        <div class="team">
            <div class="logo">
                <i class="fas fa-user-cog"></i>
            </div>
            <div class="title">
              <h3>Miko Dwi Oktafian</h3>
            </div>
            <div class="content">
              <p>12007895</p>
              <p>RPL X-3</p>
              <p>Cisarua 5</p>
            </div>
        </div>
      </div>
    </div>
</section>
<!-- Team -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        // Sticky Navbar
        window.addEventListener("scroll", function(){
          var header = document.querySelector("header.nav-top-mg");
          header.classList.toggle("sticky", window.scrollY > 0);
        })

        // ScrollUp
        window.addEventListener('scroll', function(){
            var scroll = document.querySelector('.scrollUp');
            scroll.classList.toggle("active" , window.scrollY > 0)
        })

        function scrollToUp(){
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            })
        }
    </script>
</body>
</html>