<?php
$active = "about";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Us - MugStore</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <script src="bootstrap.js"></script>
  </head>
  <body>
    <?php include __DIR__ . "/partials/nav.php"; ?>

    <section class="py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 mb-4 mb-lg-0">
            <h2 class="fw-bold">Who We Are</h2>
            <p>
              MugStore started as a small idea. It is a small
              online shop that sells handmade ceramic mugs.
            </p>
            <p>
              We are still growing, but our goal has always stayed
              the same: give you cozy, stylish mugs for everyday coffee and tea.
            </p>
            <a href="products.php" class="btn btn-pink btn-lg mt-2">Our Products</a>
          </div>
          <div class="col-lg-6">
            <img
              src="assets/mug4.jpg"
              alt="Handmade ceramic mugs"
              class="img-fluid rounded"
            />
          </div>
        </div>
      </div>
    </section>

    <?php include __DIR__ . "/partials/footer.php"; ?>
  </body>
</html>
