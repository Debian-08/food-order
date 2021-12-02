<?php
include('includes/connection.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $quantity = $_POST['qty'];
    $name = $_POST['full-name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $product_id = $_POST['product_id'];
    $sql = "INSERT INTO buy (buy_quantity, product_id, buy_by, buy_contact,buy_email,buy_address) VALUES ('$quantity','$product_id','$name','$contact','$email','$address')";
    if ($conn->query($sql) === TRUE) {
        echo '<script type="text/javascript">
            alert("Order has been placed.");
           window.location = "index.php"
      </script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if($_SERVER['REQUEST_METHOD'] == 'GET' and isset($_GET['id'])){
    $id = $_GET['id'];
    $sqlString = "SELECT * FROM `items` WHERE `item_id` = '$id'";
    $result = $conn->query($sqlString);

    //Copy result into a associative array
    $order = $result->fetch_all(MYSQLI_ASSOC);
}else{
    echo '<script type="text/javascript">
           window.location = "index.php"
      </script>';
    //No order code. Rdirect to home pageor food page.
    exit("No order id");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a href="categories.html">Categories</a>
                    </li>
                    <li>
                        <a href="foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" class="order" method="POST">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <img src="<?php echo $order[0]['item_picture'];?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $order[0]['item_food'];?></h3>
                        <p class="food-price">$<?php echo $order[0]['item_price'];?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. kamal rana " class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. kamalrana@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>
                    <?php if (isset($_GET['id'])){?>
                            <input type="hidden" name="product_id" value="<?php echo $order[0]['item_id'];?>">
                    <?php }?>
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->

    <!-- footer Section Starts Here -->
    <section class="footer">
        <div class="container text-center">
            <p>All rights reserved. Designed By <a href="#">kamal rana </a></p>
        </div>
    </section>
    <!-- footer Section Ends Here -->

</body>
</html>