<?php
require __DIR__ . "/data.php";
$products = portfolio_products($conn);
$active = "products";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Our Products - MugStore</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <script src="bootstrap.js"></script>
  </head>
  <body>
    <?php include __DIR__ . "/partials/nav.php"; ?>

    <section class="py-5">
      <div class="container">
        <h2 class="fw-bold text-center mb-4">Featured Mugs</h2>
        <?php if (empty($products)) { ?>
          <p class="text-center mb-5">No products have been added yet.</p>
        <?php } else { ?>
          <div id="productsCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <?php foreach ($products as $index => $product) { ?>
                <button type="button" data-bs-target="#productsCarousel" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? "active" : ""; ?>" <?php echo $index === 0 ? 'aria-current="true"' : ""; ?> aria-label="Slide <?php echo $index + 1; ?>"></button>
              <?php } ?>
            </div>
            <div class="carousel-inner rounded">
              <?php foreach ($products as $index => $product) { ?>
                <div class="carousel-item<?php echo $index === 0 ? " active" : ""; ?>">
                  <img src="<?php echo htmlspecialchars(portfolio_image($product)); ?>" class="d-block w-100" alt="<?php echo htmlspecialchars($product["name"]); ?>">
                  <div class="carousel-caption">
                    <h5><?php echo htmlspecialchars($product["name"]); ?></h5>
                    <p><?php echo htmlspecialchars(portfolio_price($product["price"])); ?></p>
                  </div>
                </div>
              <?php } ?>
            </div>
            <?php if (count($products) > 1) { ?>
              <button class="carousel-control-prev" type="button" data-bs-target="#productsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#productsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            <?php } ?>
          </div>
        <?php } ?>

        <h2 class="fw-bold text-center mb-4">All Mugs</h2>
        <?php if (empty($products)) { ?>
          <p class="text-center mb-0">No products have been added yet.</p>
        <?php } else { ?>
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <?php foreach ($products as $product) { ?>
              <div class="col">
                <div class="card product-card h-100">
                  <img src="<?php echo htmlspecialchars(portfolio_image($product)); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product["name"]); ?>">
                  <div class="card-body text-center">
                    <h5 class="card-title"><?php echo htmlspecialchars($product["name"]); ?></h5>
                    <?php if (!empty($product["categories_name"])) { ?>
                      <p class="card-text mb-1"><?php echo htmlspecialchars($product["categories_name"]); ?></p>
                    <?php } ?>
                    <?php if (!empty($product["description"])) { ?>
                      <p class="card-text mb-1"><?php echo htmlspecialchars($product["description"]); ?></p>
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
