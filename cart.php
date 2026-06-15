<?php
session_start();
include("db.php");

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['user'];

// REMOVE ITEM
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM cart WHERE id='$id'");
}

// INCREASE QUANTITY
if (isset($_GET['increase'])) {
    $id = $_GET['increase'];
    mysqli_query($conn, "UPDATE cart SET quantity = quantity + 1 WHERE id='$id'");
}

// DECREASE QUANTITY
if (isset($_GET['decrease'])) {
    $id = $_GET['decrease'];
    mysqli_query($conn, "UPDATE cart SET quantity = quantity - 1 WHERE id='$id' AND quantity > 1");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cart – Frosty Scoops</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>🛒 Your Cart</h1>
        <div class="top-buttons">
            <a href="dashboard.php">
                <button class="top-btn">← Continue Shopping</button>
            </a>
        </div>
    </header>

    <div class="cart-container">
        <?php
        $total = 0;
        $query = mysqli_query($conn, "SELECT * FROM cart WHERE username='$username'");

        $imageMap = [
            "Chocolate"         => "https://saltandbaker.com/wp-content/uploads/2024/04/german-chocolate-ice-cream-recipe.jpg",
            "Strawberry"        => "https://www.recipetineats.com/tachyon/2018/07/Strawberry-Ice-Cream-No-Churn_3b.jpg",
            "Vanilla"           => "https://www.foodandwine.com/thmb/QnTrAIt3aY1g4ToQEk-jULmKMsQ=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/vanilla-ice-cream-FT-RECIPE0324-cebca493f53c4431a0049ea65bfb4796.jpg",
            "Mango"             => "https://bakewithshivesh.com/wp-content/uploads/2022/05/IMG_9492-scaled.jpg",
            "Butterscotch"      => "https://vaya.in/recipes/wp-content/uploads/2019/03/Butterscotch-Ice-Cream.jpg",
            "Hot Fudge Sundae"  => "https://www.thespruceeats.com/thmb/A9aMQAV9VhsJWCjUyFkFsL_FgJM=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/hot-fudge-sundae-recipe-4843792-hero-01-80765ef0e4464f7f87f5f840e85c26e6.jpg",
            "Banana Split"      => "https://www.allrecipes.com/thmb/qALBYNHxv4bEI2yXlmhOGS-JJHI=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/229413-banana-split-DDMFS-4x3-b8bda67e91f04b88b14fd6c409fa8c55.jpg",
            "Mint Choco Chip"   => "https://handletheheat.com/wp-content/uploads/2015/07/MINT-CHOCOLATE-CHIP-ICE-CREAM-RECIPE-BLOG-500x500.jpg",
            "Choco Milkshake"   => "https://www.recipetineats.com/tachyon/2020/04/Thick-Chocolate-Milkshake_3.jpg",
            "Strawberry Shake"  => "https://preppykitchen.com/wp-content/uploads/2022/05/Strawberry-Milkshake-Recipe-Card.jpg",
            "Waffle Cone"       => "https://www.liveeatlearn.com/wp-content/uploads/2022/08/waffle-cone-ice-cream-9-scaled.jpg",
            "Mango Sorbet"      => "https://www.inspiredtaste.net/wp-content/uploads/2022/09/Mango-Sorbet-Recipe-2-1200.jpg"
        ];

        $rowCount = mysqli_num_rows($query);

        if ($rowCount == 0) {
            echo "<p class='empty-cart'>Your cart is empty! <a href='dashboard.php'>Browse our flavours</a></p>";
        }

        while ($row = mysqli_fetch_assoc($query)) {
            $subtotal = $row['price'] * $row['quantity'];
            $total += $subtotal;
        ?>
        <div class="cart-card">
            <img src="<?php echo $imageMap[$row['item_name']]; ?>">
            <h3><?php echo $row['item_name']; ?></h3>
            <p class="price">₹<?php echo $row['price']; ?></p>
            <p>Quantity: <b><?php echo $row['quantity']; ?></b></p>
            <p>Subtotal: <b>₹<?php echo $subtotal; ?></b></p>
            <div class="cart-buttons">
                <a href="cart.php?increase=<?php echo $row['id']; ?>">
                    <button class="small-btn plus-btn">+</button>
                </a>
                <a href="cart.php?decrease=<?php echo $row['id']; ?>">
                    <button class="small-btn minus-btn">−</button>
                </a>
                <a href="cart.php?remove=<?php echo $row['id']; ?>">
                    <button class="small-btn remove-btn">Remove</button>
                </a>
            </div>
        </div>
        <?php } ?>
    </div>

    <?php if ($rowCount > 0) { ?>
    <div class="bill-box">
        <h2>Total: ₹<?php echo $total; ?></h2>
        <a href="checkout.php">
            <button class="checkout-btn">Proceed To Checkout</button>
        </a>
    </div>
    <?php } ?>

    <footer>
        <p>&copy; 2026 Frosty Scoops | Created by Ananya</p>
    </footer>
</body>
</html>
