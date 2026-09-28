<?php
$active = $active ?? "home";
?>
<nav class="navbar navbar-expand-sm bg-light navbar-light fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">MugStore</a>
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#collapsibleNavbar"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
        <li class="nav-item">
          <a class="nav-link<?php echo $active === "home" ? " active" : ""; ?>" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?php echo $active === "about" ? " active" : ""; ?>" href="aboutus.php">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?php echo $active === "products" ? " active" : ""; ?>" href="products.php">Our Products</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
