<!DOCTYPE html>
<html lang="en">
<head>
<?php require "head.php";?> 
<link rel="stylesheet" href="css/login.css"> 
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
    <h1>LOGIN</h1>
    <form action="login_check.php" method="post" >
      <label for="">Username</label>
      <input type="text" name="username" required>
      <label for="">Password</label>
      <input type="password" id="password" name="password" required>
      <label>
        <input type="checkbox" onclick="showPassword()">  Show Password
      </label>
      <button class="btn-login" type="submit">LOGIN</button>
    </form>
  </div>
    

</section>
<script src="login.js"></script>
</body>
</html>