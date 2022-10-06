<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LuuLuuHomes.com</title>
    <link rel="stylesheet" href="./style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="./jquery.flipster.min.css" />
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <script src="https://kit.fontawesome.com/d0d48d242d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&display=swap" rel="stylesheet" />
</head>
<style>
nav ul li {
    margin-right: 60px !important;
}
</style>

<body>
    <?php 
    require ('mail.php');
  ?>
    <div class="header">
        <div class="container4">
            <div class="navbar">
                <div class="logo">
                    <a href="/index.html" style="display: flex"><i class="fa-solid fa-sink"
                            style="font-size: 23px; color: whitesmoke"></i>
                        <h3 style="
                  color: palegoldenrod;
                  font-weight: bold;
                  margin-top: -8px;
                ">
                            &nbsp;LUULUU HOMES
                        </h3>
                    </a>
                </div>
                <nav>
                    <ul id="menuitems">
                        <li><a href="/index.html">Home</a></li>
                        <li><a href="mainproduct.html">Products</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a class="active" href="contact.php">Contact</a></li>
                    </ul>
                </nav>
                <img src="assets/menu.png" class="menu-icon" onclick="menutoggle()" />
            </div>
        </div>
    </div>

    <!-- Contact -->
    <div class="row">
        <div class="col-md-12">
            <div class="site-heading text-center">
                <h2>Get In<span> &nbsp;Touch with us</span></h2>
            </div>
        </div>
    </div>
    <div class="contact">
        <div class="small-container90">
            <div class="row">
                <div class="col-2">
                    <div class="contact">
                        <h2 style="font-weight: bold">
                            Visit our branch or contact us today
                        </h2>
                        <h3 style="font-weight: bold">Head Office</h3>
                        <div>
                            <li>
                                <i class="fa fa-street-view"></i>
                                <p>1/90, P.T.Rajan Salai, Ashok Nagar, Chennai -600 083</p>
                            </li>
                            <li>
                                <i class="fa fa-envelope-open"></i>
                                <p>info@luluhomes.com</p>
                            </li>
                            <li>
                                <i class="fa fa-phone-square"></i>
                                <p>+91 9841032642</p>
                            </li>
                            <li>
                                <i class="fa fa-clock-o"></i>
                                <p>Monday to Saturday: 9.00 am to 8.00 pm</p>
                            </li>
                        </div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="map1">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15547.984154151685!2d80.20353393980021!3d13.035923908813604!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a5266de74ad88a3%3A0xd842d88783c1bd4!2sAshok%20Nagar%2C%20Chennai%2C%20Tamil%20Nadu!5e0!3m2!1sen!2sin!4v1655720638349!5m2!1sen!2sin"
                            width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact1">
        <div class="small-container90">
            <div class="row" style="margin-top: -60px;">
                <div class="col-md-12">
                    <div class="site-heading text-center">
                        <h2>Leave<span> &nbsp;a Message</span></h2>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: -70px;">
                <div class="col-1">
                    <form action="mail.php" method="POST">
                        <h2 style="font-weight: bold">We love to hear from you</h2>
                        <input type="text" name="yourname" required placeholder="Your Name*" />
                        <input type="text" name="phone" required placeholder="Phone Number*" />
                        <input type="email" name="email" required placeholder="E-mail*" />
                        <textarea name="yourmessage" id="" cols="30" rows="10" placeholder="Your Message*"
                            required></textarea>
                        <button class="btn" type="submit" name="submit">Submit</button>
                    </form>
                </div>
                <div class="col-1">
                    <div class="people">
                        <div>
                            <p>
                                <span>Magesh</span>CEO<br />
                                Phone:+919841032642 <br />Email:marketing@luluhomes.com
                            </p>
                            <hr />
                        </div>
                        <!-- <div>
                <p>
                  <span>Mani</span>Senior Engineer<br />Phone:0123456789<br />Email:Contact@example.com
                </p>
                <hr />
              </div>
              <div>
                <p>
                  <span>Pandi</span>Senior Engineer<br />Phone:0123456789<br />Email:Contact@example.com
                </p>
                <hr />
              </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <div class="footer">
        <div class="container2">
            <div class="row">
                <div class="footer-col-2">
                    <a href="index.html"><i class="fa-solid fa-sink"></i>
                        <h3>&nbsp;LUULUU HOMES</h3>
                    </a>
                    <p>The most exquisite choices come from our house</p>
                </div>
                <div class="footer-col-3">
                    <h3>Quick Links</h3>
                    <ul style="
              cursor: pointer;
              font-weight: bold;
              text-align: justify;
              margin-left: 80px;
            ">
                        <a href="/index.html">
                            <li style="margin: 10px">Home</li>
                        </a>
                        <a href="about.html">
                            <li style="margin: 10px">About</li>
                        </a>
                        <a href="products.html">
                            <li style="margin: 10px">Products</li>
                        </a>
                        <a href="contact.php">
                            <li style="margin: 10px">Contact US</li>
                        </a>
                </div>
                <div class="footer-col-4">
                    <h3>Follow Us</h3>
                    <ul style="cursor: pointer; margin-left: 60px">
                        <a href="#" style="display: flex"><i class="fa-brands fa-facebook" style="margin: 5px"></i>
                            <li style="margin: 5px">Facebook</li>
                        </a>
                        <a href="#" style="display: flex"><i class="fa-brands fa-square-twitter"
                                style="margin: 5px"></i>
                            <li style="margin: 5px">Twitter</li>
                        </a>
                        <a href="#" style="display: flex"><i class="fa-brands fa-square-instagram"
                                style="margin: 5px"></i>
                            <li style="margin: 5px">Instagram</li>
                        </a>
                        <a href="#" style="display: flex"><i class="fa-brands fa-youtube" style="margin: 5px"></i>
                            <li style="margin: 5px">Youtube</li>
                        </a>
                    </ul>
                </div>
            </div>
            <hr />
            <p class="copyright">©Copyright 2022 - LuuLuu Homes</p>
        </div>
    </div>

    <!-- Back to Top -->
    <a href="https://wa.me/9841032642" target="_blank" class="wat1"><img style="width: 60px" src="./assets/WhatsApp.png"
            alt="" /></a>

    <!-- js for toggle menu -->
    <script src="./main.js"></script>
    <script>
    var MenuItems = document.getElementById("menuitems");
    MenuItems.style.maxHeight = "0px";

    function menutoggle() {
        if (MenuItems.style.maxHeight == "0px") {
            MenuItems.style.maxHeight = "200px";
        } else {
            MenuItems.style.maxHeight = "0px";
        }
    }
    </script>
</body>

</html>