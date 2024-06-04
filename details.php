
<?php
// Include the database connection file
require_once 'connection.php';


if (isset($_GET['product_id'])) {

    $product_id = $_GET['product_id'];

    $product_sql = "SELECT * FROM products WHERE product_id = $product_id";
    $product_result = mysqli_query($con, $product_sql);

    $image_sql = "SELECT * FROM product_images WHERE product_id = $product_id";
    $image_result = mysqli_query($con, $image_sql);

    // Check if product details are fetched successfully
    if ($product_result && $image_result) {

        if (mysqli_num_rows($product_result) > 0) {

            $row = mysqli_fetch_assoc($product_result);
            ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>FitEquip</title>

                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>FitEquip</title>
                <!-- Bootstrap CSS -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
                    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                    crossorigin="anonymous"></script>

                <!-- Google Fonts -->
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
                    integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMg4f7+J3pbmOW5Zn1gDyD32dS5abyl3v9X+ZOn" crossorigin="anonymous">

                <!-- font-awesome -->



                <!-- bto code -->
                <script src="https://kit.fontawesome.com/3c7268061e.js" crossorigin="anonymous"></script>
                <!-- Custom CSS -->
                <link rel="stylesheet" href="home.css">
                <link rel="stylesheet" href="details.css">
            </head>

            <body>

                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="#">
                            <h5 style="color: #686D76;font-size: 30px;">FitEquip</h5>
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="home.html">Home</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">Products</a>
                                    <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                                        <li><a class="dropdown-item" href="#">Weight Lifting</a></li>
                                        <li><a class="dropdown-item" href="#">Football</a></li>
                                        <li><a class="dropdown-item" href="#">Basketball</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="about.html">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.html">Contact</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                                    <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                                        <li><a class="dropdown-item" href="#">Profile</a></li>
                                        <li><a class="dropdown-item" href="#">Log In</a></li>
                                        <li><a class="dropdown-item" href="#">Sign In</a></li>
                                    </ul>
                                </li>
                                <li><a href=""><i class="fas fa-shopping-cart" style="color: #DC5F00;font-size: 30px;"></i></a>
                                </li>

                            </ul>
                        </div>
                    </nav>
                </div>


                <!--  -->


                <!-- Single product details -->
                <div class="small-container single-product">
                    <div class="row">
                        <div class="col-2">
                            <!-- Loop through the result set to display images -->
                            <?php
                            while ($image_row = mysqli_fetch_assoc($image_result)) {
                                // Check if the image URL contains "imagesbskt/"
                                if (strpos($image_row['image_url'], 'imagesbskt/') !== false) {
                                    ?>
                                    <!-- Main product image -->
                                    <img src="<?php echo $image_row['image_url']; ?>" width="100%" id="productImg">
                                    <?php
                                }
                            }
                            ?>
                            <div class="small-img-row">
                                <?php
                                // Reset the pointer of $image_result
                                mysqli_data_seek($image_result, 0);
                                // Loop through the result set to display additional images
                                while ($image_row = mysqli_fetch_assoc($image_result)) {
                                    // Check if the image URL contains "imagesbskt/"
                                    if (strpos($image_row['image_url'], 'imagesbskt/') === false) {
                                        ?>
                                        <div class="small-img-col">
                                            <!-- Display additional images -->
                                            <img src="<?php echo $image_row['image_url']; ?>" class="small-img">
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div class="col-2">
                            <!-- Product details -->
                            <h2 style="color:#373A40" class="product-name"><?php echo $row['product_name']; ?></h2>
                            <h4><?php echo $row['product_price']; ?>$</h4>
                            <!-- <input type="number" value="1">
                            <button class="btn">Add To Cart</button> -->
                            <h3><i class="fas fa-info-circle"></i> Product Details</h3>
                            <p style="color: #686D76;"><?php echo $row['product_details']; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Footer Section -->
                <!-- Footer Section -->
                <div class="footer">
                    <div class="container">
                        <div class="row">
                            <div class="footer-col-2">
                                <h4 id="footh4">FitEquip</h4>
                                <p style="color: #DC5F00;">Our Purpose Is To Sustainably Make The Pleasure and Benefits of Sports
                                    Accessible to the
                                    Many.</p>
                            </div>
                            <div class="footer-col-4">
                                <h3 style="color:#EEEEEE">Follow us</h3>
                                <ul style="color: #DC5F00;">
                                    <li style="color: #DC5F00;"><i class="fab fa-facebook"></i> Facebook</li>
                                    <li style="color: #DC5F00;"></li> <i class="fab fa-twitter"></i> Twitter</li>
                                    <li style="color: #DC5F00;"></li> <i class="fab fa-instagram"></i> Instagram</li>
                                    <li style="color: #DC5F00;"></li><i class="fab fa-youtube"></i> YouTube</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    var productImg = document.getElementById("productImg");
                    var SmallImg = document.getElementsByClassName("small-img");
                    var quantityInput = document.querySelector('input[type="number"]');

                    SmallImg[0].onclick = function () {
                        productImg.src = SmallImg[0].src;
                    }
                    SmallImg[1].onclick = function () {
                        productImg.src = SmallImg[1].src;
                    }
                    SmallImg[2].onclick = function () {
                        productImg.src = SmallImg[2].src;
                    }
                    SmallImg[3].onclick = function () {
                        productImg.src = SmallImg[3].src;
                    }

                    // Prevent user from entering a quantity below 1
                    quantityInput.addEventListener('change', function () {
                        if (quantityInput.value < 1) {
                            quantityInput.value = 0;
                        }
                    });
                </script>
            </body>

            </html>
            <?php
        } else {
            // If no product found with the provided ID, display a message
            echo "Product not found.";
        }
    } else {
        // If there's an error in fetching product details, display an error message
        echo "Error fetching product details.";
    }
}
?>
