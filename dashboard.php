<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Frosty Scoops</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <header>
        <h1>🍦 Frosty Scoops</h1>
        <p>Welcome, <?php echo $_SESSION['user']; ?>! What's your scoop today?</p>

        <input type="text"
               id="searchBox"
               placeholder="Search flavours..."
               onkeyup="searchItems()"
               onfocus="focusField(this)"
               onblur="blurField(this)"
               class="search-box">

        <div class="top-buttons">
            <a href="cart.php">
                <button class="top-btn">🛒 View Cart</button>
            </a>
            <a href="logout.php">
                <button class="top-btn logout-btn">Logout</button>
            </a>
        </div>
    </header>

    <!-- SCOOPS -->
    <h2 class="category">🍨 Scoops</h2>
    <div class="menu-row">
        <div class="item" onmouseover="highlight(this)" onmouseout="removeHighlight(this)">
            <img src="https://saltandbaker.com/wp-content/uploads/2024/04/german-chocolate-ice-cream-recipe.jpg">
            <h3>Chocolate</h3>
            <p class="price">₹120</p>
            <button onclick="addToCart('Chocolate', 120)">Add To Cart</button>
            <p>Quantity: <span id="ChocolateQty">0</span></p>
        </div>

        <div class="item" onmouseover="highlight(this)" onmouseout="removeHighlight(this)">
            <img src="https://www.recipetineats.com/tachyon/2018/07/Strawberry-Ice-Cream-No-Churn_3b.jpg">
            <h3>Strawberry</h3>
            <p class="price">₹110</p>
            <button onclick="addToCart('Strawberry', 110)">Add To Cart</button>
            <p>Quantity: <span id="StrawberryQty">0</span></p>
        </div>

        <div class="item" onmouseover="highlight(this)" onmouseout="removeHighlight(this)">
            <img src="https://www.foodandwine.com/thmb/QnTrAIt3aY1g4ToQEk-jULmKMsQ=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/vanilla-ice-cream-FT-RECIPE0324-cebca493f53c4431a0049ea65bfb4796.jpg">
            <h3>Vanilla</h3>
            <p class="price">₹100</p>
            <button onclick="addToCart('Vanilla', 100)">Add To Cart</button>
            <p>Quantity: <span id="VanillaQty">0</span></p>
        </div>

        <div class="item" onmouseover="highlight(this)" onmouseout="removeHighlight(this)">
            <img src="https://bakewithshivesh.com/wp-content/uploads/2022/05/IMG_9492-scaled.jpg">
            <h3>Mango</h3>
            <p class="price">₹130</p>
            <button onclick="addToCart('Mango', 130)">Add To Cart</button>
            <p>Quantity: <span id="MangoQty">0</span></p>
        </div>
    </div>

    <!-- SUNDAES -->
    <h2 class="category">🍧 Sundaes</h2>
    <div class="menu-row">
        <div class="item" onmouseover="highlight(this)" onmouseout="removeHighlight(this)">
            <img src="https://simplydesserts.us/wp-content/uploads/2024/10/butterscotch-brownie-sundae-003.jpg">
            <h3>Butterscotch</h3>
            <p class="price">₹140</p>
            <button onclick="addToCart('Butterscotch', 140)">Add To Cart</button>
            <p>Quantity: <span id="ButterscotchQty">0</span></p>
        </div>

        <div class="item" onmouseover="highlight(this)" onmouseout="removeHighlight(this)">
            <img src="https://static01.nyt.com/images/2017/06/12/dining/00Icecream11/00Icecream11-jumbo.jpg">
            <h3>Hot Fudge Sundae</h3>
            <p class="price">₹160</p>
            <button onclick="addToCart('Hot Fudge Sundae', 160)">Add To Cart</button>
            <p>Quantity: <span id="HotFudgeSundaeQty">0</span></p>
        </div>

        <div class="item" onmouseover="highlight(this)" onmouseout="removeHighlight(this)">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSL_17YKxqtNPRDndvE-vcD5gIBaF9V81S9R04ut7xhruVgdgeXTrGspo8&s=10">
            <h3>Banana Split</h3>
            <p class="price">₹180</p>
            <button onclick="addToCart('Banana Split', 180)">Add To Cart</button>
            <p>Quantity: <span id="BananaSplitQty">0</span></p>
        </div>

        <div class="item" onmouseover="highlight(this)" onmouseout="removeHighlight(this)">
            <img src="https://www.keep-calm-and-eat-ice-cream.com/wp-content/uploads/2022/11/Choc-chip-mint-ice-cream-hero-2.jpg">
            <h3>Mint Choco Chip</h3>
            <p class="price">₹150</p>
            <button onclick="addToCart('Mint Choco Chip', 150)">Add To Cart</button>
            <p>Quantity: <span id="MintChocoChipQty">0</span></p>
        </div>
    </div>

    <!-- SHAKES & SPECIALS -->
    <h2 class="category">🥤 Shakes & Specials</h2>
    <div class="menu-row">
        <div class="item" onmouseover="highlight(this)" onmouseout="removeHighlight(this)">
            <img src="https://wholefoodsoulfoodkitchen.com/wp-content/uploads/2022/04/chocolate-milkshake-no-ice-cream-2.jpg">
            <h3>Choco Milkshake</h3>
            <p class="price">₹170</p>
            <button onclick="addToCart('Choco Milkshake', 170)">Add To Cart</button>
            <p>Quantity: <span id="ChocoMilkshakeQty">0</span></p>
        </div>

        <div class="item" onmouseover="highlight(this)" onmouseout="removeHighlight(this)">
            <img src="https://www.thehungrybites.com/wp-content/uploads/2023/06/Strawberry-milkshake-frappuccino-featured.jpg">
            <h3>Strawberry Shake</h3>
            <p class="price">₹160</p>
            <button onclick="addToCart('Strawberry Shake', 160)">Add To Cart</button>
            <p>Quantity: <span id="StrawberryShakeQty">0</span></p>
        </div>

        <div class="item" onmouseover="highlight(this)" onmouseout="removeHighlight(this)">
            <img src="https://tatyanaseverydayfood.com/wp-content/uploads/2024/02/Chocolate-Caramel-Waffle-Cones-Recipe-1.jpg">
            <h3>Waffle Cone</h3>
            <p class="price">₹90</p>
            <button onclick="addToCart('Waffle Cone', 90)">Add To Cart</button>
            <p>Quantity: <span id="WaffleConeQty">0</span></p>
        </div>

        <div class="item" onmouseover="highlight(this)" onmouseout="removeHighlight(this)">
            <img src="https://notoutofthebox.in/wp-content/uploads/2018/07/MangoSorbet-500x500.jpg">
            <h3>Mango Sorbet</h3>
            <p class="price">₹120</p>
            <button onclick="addToCart('Mango Sorbet', 120)">Add To Cart</button>
            <p>Quantity: <span id="MangoSorbetQty">0</span></p>
        </div>
    </div>

    <footer id="contact">
        <p>&copy; 2026 Frosty Scoops | Contact: frostyscoops@gmail.com | Phone: 9876543210</p>
        <p>Created by Ananya</p>
    </footer>
</body>
</html>
