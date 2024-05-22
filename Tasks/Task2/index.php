<?php
include 'connect.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DropHills Bikes</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <div class="main" id="main">
        <div class="main-text">
            <h1>Ride with Drop Hills bikes: Unveil Your Adventure</h1>
            <span>Ride with Passion, Discover with Precision</span>
        </div>
        <div class="search-container">
            <form action="/fetch.php" method="post">
                <input type="text" placeholder="Name" name="name">
                <input type="text" placeholder="Brand" name="brand">
                <input type="text" placeholder="CC" name="cc">
                <button type="submit">Submit</button>
            </form>
        </div>
        <div class="image-container">
            <div class="slides fade">
                <img src="/assets/images/image1.jpg" class="slide-image">
            </div>
            <div class="slides fade">
                <img src="/assets/images/image2.jpg" class="slide-image">
            </div>
            <div class="slides fade">
                <img src="/assets/images/image3.jpg" class="slide-image">
            </div>
        </div>
        <div style="text-align: center;">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
        <div class="box"></div>

        <div class="nav-container">
            <div class="text">
                <h1>DropHill Bikes</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="#main">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="login.php">Login</a>|<a href="register.php">Register</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="list-section">
        <h2>All bikes list</h2>
        <div class="list-content">
            <div class="grid">
                <?php
                $selectsql = "SELECT * FROM bike_list";
                $select_result = $conn->query($selectsql);
                if ($select_result->num_rows > 0) {
                    while ($rows = $select_result->fetch_assoc()) {
                        echo '<div class="item">';
                        echo '<img src="uploads/' . $rows['image'] . '" alt="Bike Image">';
                        echo '<div class="item-content">';
                        echo '<h3>' . $rows['name'] . '</h3>';
                        echo '<h3>' . $rows['brand'] . '</h3>';
                        echo '<h3>' . $rows['cc'] . '</h3>';
                        echo '<h3>' . 'Rs. ' . $rows['price'] . '</h3>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>
    <div class="about-container" id="about">
        <h2>About:</h2>
        <div class="content">
            <div class="left">
                <img src="/assets/images/Logo.png" alt="DropHills Bike logo">
            </div>
            <div class="right">
                <h2>DropHills Bikes</h2>
                <p>
                    Welcome to DropHills Bikes, your premier destination for exploring, discovering, and connecting with the finest selection of bicycles. At DropHills, we are passionate about bikes and dedicated to bringing you the best in cycling experiences, whether you are an avid cyclist or just starting out.
                    DropHills Bikes is a trusted platform where bike enthusiasts and novices alike can find detailed information on a wide variety of bicycles. Our mission is to create a vibrant community centered around a shared love for cycling. With our extensive range of bikes and user-friendly features, we make it easy for you to find the perfect ride.
                </p>
            </div>
        </div>
    </div>
    <div class="contact-container" id="contact">
        <h2>Contact Us:</h2>
        <div class="content">
            <div class="left">
                <div>
                    <span>📌</span>
                    <h3>Office Address</h3>
                    <span>Imadol</span>
                    <span>Lalitpur,Nepal</span>
                </div>
                <div>
                    <span>📞</span>
                    <h3>Call us</h3>
                    <span>+977-1-5201060</span>
                </div>
                <div>
                    <span>📨</span>
                    <h3>Email Address</h3>
                    <span>drophills@gmail.com</span>
                </div>
            </div>
            <div class="right">
                <form action="/contact.php" method="post">
                    <input type="text" name="name" placeholder="Name">
                    <input type="text" name="email" placeholder="Email">
                    <input type="text" name="number" placeholder="Phone Number">
                    <textarea name="message" id="message" placeholder="Message"></textarea>
                    <button type="submit" name="contact">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="line"></div>
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3533.7736008529064!2d85.33483571132072!3d27.662475476109186!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1968aa1fa39b%3A0xba0e785615c88f19!2sDropHills%20Web!5e0!3m2!1sen!2snp!4v1716206029168!5m2!1sen!2snp" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <footer>
        <p>Copyright &copy; 2024 Hawana Tamang All rights reserved.</p>
    </footer>

</body>
<script src="/assets/js/script.js"></script>

</html>