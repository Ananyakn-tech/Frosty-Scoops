// 1. onfocus – highlight search box
function focusField(x) {
    x.style.border = "3px solid #a8e4ff";
}

// 2. onblur – remove search highlight
function blurField(x) {
    x.style.border = "";
}

// 3. onkeyup – search/filter items
function searchItems() {
    let input = document.getElementById("searchBox").value.toLowerCase();
    let items = document.getElementsByClassName("item");

    for (let i = 0; i < items.length; i++) {
        let text = items[i].innerText.toLowerCase();
        items[i].style.display = text.includes(input) ? "block" : "none";
    }
}

// 4. onclick – add to cart (AJAX fetch)
function addToCart(item, price) {
    fetch("add_to_cart.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "item=" + encodeURIComponent(item) + "&price=" + price
    })
    .then(response => response.text())
    .then(data => {
        alert("🍦 " + item + " added to cart!");
        updateQuantity(item);
    });
}

// 5. update quantity display on dashboard
function updateQuantity(item) {
    fetch("get_quantity.php?item=" + encodeURIComponent(item))
    .then(response => response.text())
    .then(quantity => {
        let id = item.replace(/\s/g, '');
        let el = document.getElementById(id + "Qty");
        if (el) el.innerHTML = quantity;
    });
}

// 6. onmouseover – highlight card
function highlight(x) {
    x.style.transform = "scale(1.05)";
    x.style.boxShadow = "0px 0px 20px #a8e4ff";
    x.style.transition = "0.2s";
}

// 7. onmouseout – remove highlight
function removeHighlight(x) {
    x.style.transform = "scale(1)";
    x.style.boxShadow = "none";
}

// 8. onchange – show payment fields dynamically
function showPaymentFields() {
    let payment = document.getElementById("paymentMethod").value;

    document.getElementById("upiField").style.display = "none";
    document.getElementById("cardField").style.display = "none";

    if (payment === "UPI") {
        document.getElementById("upiField").style.display = "block";
    }
    if (payment === "Card") {
        document.getElementById("cardField").style.display = "block";
    }
}

// 9. onsubmit – validate Register form
function validateRegister() {
    let valid = true;

    document.querySelectorAll(".error").forEach(function(el) {
        el.innerHTML = "";
    });

    let name     = document.getElementById("name").value.trim();
    let email    = document.getElementById("email").value.trim();
    let phone    = document.getElementById("phone").value.trim();
    let address  = document.getElementById("address").value.trim();
    let pincode  = document.getElementById("pincode").value.trim();
    let username = document.getElementById("username").value.trim();
    let password = document.getElementById("password").value;
    let confirm  = document.getElementById("confirm").value;

    let emailPattern   = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    let phonePattern   = /^[0-9]{10}$/;
    let pincodePattern = /^[0-9]{6}$/;

    if (name === "") {
        document.getElementById("nameError").innerHTML = "Name is required";
        valid = false;
    }

    if (email === "") {
        document.getElementById("emailError").innerHTML = "Email is required";
        valid = false;
    } else if (!email.match(emailPattern)) {
        document.getElementById("emailError").innerHTML = "Invalid email format";
        valid = false;
    }

    if (!phone.match(phonePattern)) {
        document.getElementById("phoneError").innerHTML = "Enter valid 10 digit phone number";
        valid = false;
    }

    if (address.length < 10) {
        document.getElementById("addressError").innerHTML = "Enter a proper address";
        valid = false;
    }

    if (!pincode.match(pincodePattern)) {
        document.getElementById("pincodeError").innerHTML = "Invalid pincode (must be 6 digits)";
        valid = false;
    }

    if (username.length < 4) {
        document.getElementById("usernameError").innerHTML = "Minimum 4 characters required";
        valid = false;
    }

    if (password.length < 6) {
        document.getElementById("passwordError").innerHTML = "Password must be at least 6 characters";
        valid = false;
    }

    if (confirm !== password) {
        document.getElementById("confirmError").innerHTML = "Passwords do not match";
        valid = false;
    }

    return valid;
}

// 10. onsubmit – validate Login form
function validateLogin() {
    let valid = true;

    document.getElementById("loginUsernameError").innerHTML = "";
    document.getElementById("loginPasswordError").innerHTML = "";

    let username = document.getElementById("username").value.trim();
    let password = document.getElementById("password").value.trim();

    if (username === "") {
        document.getElementById("loginUsernameError").innerHTML = "Username is required";
        valid = false;
    }

    if (password === "") {
        document.getElementById("loginPasswordError").innerHTML = "Password is required";
        valid = false;
    }

    return valid;
}

// 11. onsubmit – validate Payment form
function validatePayment() {
    let payment = document.getElementById("paymentMethod").value;
    let valid = true;

    document.getElementById("upiError").innerHTML = "";
    document.getElementById("cardError").innerHTML = "";
    document.getElementById("cvvError").innerHTML = "";

    if (payment === "") {
        alert("Please select a payment method");
        return false;
    }

    if (payment === "UPI") {
        let upi = document.getElementById("upiId").value.trim();
        let upiPattern = /^[a-zA-Z0-9._-]{2,}@[a-zA-Z]{2,}$/;
        if (!upiPattern.test(upi)) {
            document.getElementById("upiError").innerHTML = "Enter a valid UPI ID (e.g. name@upi)";
            valid = false;
        }
    }

    if (payment === "Card") {
        let card = document.getElementById("cardNumber").value.trim();
        let cvv  = document.getElementById("cvv").value.trim();
        let cardPattern = /^[0-9]{16}$/;
        let cvvPattern  = /^[0-9]{3}$/;

        if (!cardPattern.test(card)) {
            document.getElementById("cardError").innerHTML = "Card number must be 16 digits";
            valid = false;
        }
        if (!cvvPattern.test(cvv)) {
            document.getElementById("cvvError").innerHTML = "CVV must be 3 digits";
            valid = false;
        }
    }

    return valid;
}
