<!DOCTYPE html>
<html lang="en">
<head>
<?php require "head.php";?> 
<link rel="stylesheet" href="css/book_now.css"> 
</head>
<body>

<style>
    #section_hero.hero{
        min-height: 100vh;
    }

    .hero-content-area h3{
        margin-bottom: 25px;
    }
</style>

<?php include_once "navbar.php"; ?>
<section id="section_hero" class="hero">
  <div class="background-image" style="background-image: 
    linear-gradient(
      rgba(0,0,0,0.5),
      rgba(0,0,0,0.5)
    ),
    url(img/samantha-gades-711115-unsplash.jpg);"></div>

  <div class="hero-content-area">
    <h1>There Was a Problem!</h1>
    <h3>We are sorry, your order cannot be created</h3>
    <a href="index.php">back to home</a>
  </div>
    

</section>
</body>
</html>