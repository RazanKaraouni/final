<?php
require __DIR__ . "/data.php";
$featured = array_slice(portfolio_products($conn), 0, 3);
$active = "home";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MugStore Portfolio</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <script src="bootstrap.js"></script>
  </head>
  <body>
    <?php include __DIR__ . "/partials/nav.php"; ?>

    <section class="hero-section d-flex align-items-center">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7">
            <h1 class="fw-bold">MugStore</h1>
            <p class="mt-3">
              Explore the newest, stylish, and elegant mugs.
            </p>
            <div class="mt-4">
              <a href="aboutus.php" class="btn btn-pink btn-lg">About Us</a>
              <a href="products.php" class="btn btn-pink btn-lg">Our Products</a>
            </div>
          </div>
          <div class="col-lg-5">
            <?php if (!empty($featured)) { ?>
              <img
                src="<?php echo htmlspecialchars(portfolio_image($featured[0])); ?>"
                alt="<?php echo htmlspecialchars($featured[0]["name"]); ?>"
                class="img-fluid rounded"
              />
            <?php } else { ?>
              <img src="assets/mug.jpg" alt="mugs" class="img-fluid rounded" />
            <?php } ?>
          </div>
        </div>
      </div>
    </section>

    <section class="py-5">
      <div class="container">
        <h2 class="fw-bold text-center mb-4">Featured Mugs</h2>
        <?php if (empty($featured)) { ?>
          <p class="text-center mb-0">No products have been added yet.</p>
        <?php } else { ?>
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <?php foreach ($featured as $product) { ?>
              <div class="col">
                <div class="card product-card h-100">
                  <img src="<?php echo htmlspecialchars(portfolio_image($product)); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product["name"]); ?>">
                  <div class="card-body text-center">
                    <h5 class="card-title"><?php echo htmlspecialchars($product["name"]); ?></h5>
                    <?php if (!empty($product["categories_name"])) { ?>
                      <p class="card-text mb-1"><?php echo htmlspecialchars($product["categories_name"]); ?></p>
                    <?php } ?>
                    <p class="card-text"><?php echo htmlspecialchars(portfolio_price($product["price"])); ?></p>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        <?php } ?>
      </div>
    </section>

    <?php include __DIR__ . "/partials/footer.php"; ?>
  </body>
</html>
