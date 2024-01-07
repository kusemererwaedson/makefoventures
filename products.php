<?php
session_start();

include("db_con.php");
include("makefo_data/get_data.php");

$page = $_REQUEST['page'] ?? "";


$link = $_REQUEST['link'];
$cat_id = $_REQUEST['brand'];
$category = getCategoryById($cat_id, $conn);

$about_info = getAbout($conn);
$services = getServices($conn);
$categories = getCategories($conn);
$subcategories = getSubcategories($conn);
$products = getProducts($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Makefo ventures</title>
    <link rel="stylesheet" href="assets/css/f_style.css">
    <script src="assets/js/swal.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <?php if (isset($_GET['success'])) { ?>
        <script>
            setTimeout(function () {
                swal("Success", "<?= $_GET['success'] ?>", "success");
            },
                100);
        </script>

    <?php } ?>

    <?php if (isset($_GET['error'])) { ?>
        <script>
            setTimeout(function () {
                swal("Failed", "<?= $_GET['error'] ?>", "error");
            },
                100);
        </script>

    <?php } ?>
    <div class="container-fluid ">
        <section class="header">
            <nav class="navbar navbar-expand-md navbar-light p-2 bg_web fixed-top">
                <a href="index.php" class="navbar-brand">
                    <h1>MAKEFO </h1>
                </a>

                <div class="nav-links" id="navLinks">
                    <i class="fa fa-times" onclick="hideMenu()"></i>
                    <ul class="nav navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="index.php">HOME</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php#about">ABOUT</a></li>
                        <li class="dropdown nav-item">
                            <?php printf("<a class='nav-link' href='index.php?page=enterprise&link=engineering' data-toggle='dropdow' role='button'
                                aria-haspopup='tru' aria-expanded='false'>ENGINEERING SOLUTIONS</a>", $link) ?>

                            <ul class="dropdown-menu mx-auto ml-auto" style="width: 60vw">
                                <div class="row">
                                    <h5 class="text-center">Different Brands</h5>
                                    <?php
                                    $counter = 0;
                                    foreach ($categories as $cat) {
                                        if ($cat['business_type'] == 'engineering') {
                                            if ($counter < 3) {
                                                ?>

                                                <div class="col-md-4">
                                                    <li>
                                                        <?php
                                                        $catName = $cat['category_name'];
                                                        $catId = $cat['id'];
                                                        $catImg = $cat['category_image'];
                                                        printf("<a href='products.php?link=engineering&brand=%s'>
                                                            %s<br>
                                                            <img src='assets/images/category/%s'
                                                                class='img-fluid' alt=''>
                                                        </a>", $catId, $catName, $catImg);
                                                        ?>
                                                    </li>
                                                </div>
                                                <?php $counter++;
                                            } else {
                                                break;
                                            }
                                        }
                                    } ?>

                                </div>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <?php printf("<a href='index.php?page=enterprise&link=greenlife' class=' nav-link' role='button' aria-haspopup='true'
                                aria-expanded='false'>GREEN LIFE</a>", $link) ?>

                        </li>

                        <li class="dropdown nav-item">
                            <?php printf("<a class='nav-link' href='index.php?page=enterprise&link=beauty' role='button' aria-haspopup='true'
                                aria-expanded='false'>BEAUTY & WELLBEING</a>", $link); ?>
                            <ul class="dropdown-menu mx-auto ml-auto" style="width: 60vw">
                                <div class="row">
                                    <h5 class="text-center">Different Brands</h5>
                                    <?php
                                    $counter = 0;
                                    foreach ($categories as $cat) {
                                        if ($cat['business_type'] == 'beauty') {
                                            if ($counter < 3) {
                                                ?>

                                                <div class="col-md-4">
                                                    <li>
                                                        <?php
                                                        $catName = $cat['category_name'];
                                                        $catId = $cat['id'];
                                                        $catImg = $cat['category_image'];
                                                        printf("<a href='products.php?link=beauty&brand=%s'>
                                                            %s<br>
                                                            <img src='assets/images/category/%s'
                                                                class='img-fluid' alt=''>
                                                        </a>", $catId, $catName, $catImg);
                                                        ?>
                                                    </li>
                                                </div>
                                                <?php $counter++;
                                            } else {
                                                break;
                                            }
                                        }
                                    } ?>

                                </div>
                            </ul>
                        </li>



                        <li class='nav-item'>
                            <?php printf("<a class='nav-link' href='index.php?page=enterprise&link=tour'>TOUR & ACCOMMODATION</a>", $link) ?>
                        </li>

                        <li class="nav-item"><a class="nav-link" href="#contact">CONTACT</a></li>

                        <button class="btn bg-secondary float-end text-white" data-bs-target="#leave_msg"
                            data-bs-toggle="modal">Leave a message</button>

                    </ul>
                </div>
                <i class="fa fa-bars" onclick="showMenu()"></i>
            </nav>
        </section>
    </div>


    <div class="container-fluid">

        <div class="mt-5 pt-3">
            <div class="row bg-light p-5">
                <div class="col-md-12">
                    <h1>
                        <?= $category['category_name'] ?>
                        <?php if ($link == 'beauty') {
                            echo "Products";
                        } elseif ($link == 'engineering') {
                            echo "Parts";
                        } elseif ($link == 'greenlife' || $link == 'tour') {
                            echo "Services";
                        } ?>
                    </h1>
                </div>
            </div>
        </div>

        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-3">
                    <h4>Categories</h4>
                    <hr>
                    <?php foreach ($subcategories as $subcategory) {
                        $subcatName = $subcategory['subcategory_name'];
                        $sctId = $subcategory['id'];

                        if ($subcategory['category_id'] == $cat_id) {

                            printf("<a href='products.php?link=%s&brand=%s&page=%s' class='nav-link p-2'>$subcatName</a>", $link, $cat_id, $sctId);
                        }
                    } ?>
                </div>


                <div class="col-md-9">
                    <h4 class="text-center">Looking For Something</h4>

                    <?php if ($page == ''): ?>
                        <input type="search" class="form-control mx-auto  p-2 my-3" name="searchKeyword"
                            id="customSearchInpt" onkeyup="searchCusTable()" placeholder="Search for anything">
                        <div class="d-flex flex-wrap justify-content-between mt-3" id="customsCatgoryContainer">
                            <?php foreach ($products as $index => $product): ?>
                                <?php if ($product['category_id'] == $cat_id): ?>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <div class="card-title text-center">
                                                <h5 class="p-2">
                                                    <?= $product['product_name'] ?>
                                                </h5>
                                                <img src="assets/images/product/<?= $product['product_image'] ?>" height="200px"
                                                    width="100%" alt="" class="card-image">
                                                <?php $prtNum = $product['part_num'];
                                                if ($product['bussiness_type'] == 'engineering') {
                                                    echo "<p>Part Number: $prtNum</p>";
                                                } ?>

                                                <button class="btn bg-secondary my-2 text-white form-control"
                                                    data-bs-target="#product<?= $index ?>" data-bs-toggle="modal">View
                                                    Product</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <?php $subCtId = $_REQUEST['page']; ?>
                        <input type="search" class="form-control mx-auto  p-2 my-3" name="searchKeyword"
                            id="customSearchInpt" onkeyup="searchCusTable()" placeholder="Search for anything">
                        <div class="d-flex flex-wrap justify-content-between mt-3" id="customsCatgoryContainer">
                            <?php foreach ($products as $index => $product): ?>
                                <?php if ($product['subcategory_id'] == $subCtId): ?>
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <div class="card-title text-center">
                                                <h5 class="p-2">
                                                    
                                                    <?= $product['product_name'] ?>
                                                </h5>
                                                <img src="assets/images/product/<?= $product['product_image'] ?>" height="200px"
                                                    width="100%" alt="" class="card-image">
                                                <?php $prtNum = $product['part_num'];
                                                if ($product['bussiness_type'] == 'engineering') {
                                                    echo "<p>Part Number: $prtNum</p>";
                                                } ?>

                                                <button class="btn bg-secondary my-2 text-white form-control"
                                                    data-bs-target="#product<?= $index ?>" data-bs-toggle="modal">View
                                                    Product</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </div>

            </div>
        </div>
    </div>







    <!-- ------------leave msg popup------------------------- -->
    <div class="modal fade" id="leave_msg" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Send message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="makefo_data/add_data.php" class="form-horizontal" method="POST">
                        <input type="hidden" name="link" value="<?= $link ?>" id="">
                        <input type="hidden" name="page" value="<?= $page ?>" id="">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" name="sender_name" class="form-control" placeholder="Enter Your Name"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Phone" class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-12">
                                <input type="text" name="sender_phone" class="form-control"
                                    placeholder="Enter Phone Number" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Message</label>
                            <div class="col-sm-12">
                                <textarea name="msg" id="" cols="30" class="form-control" rows="5"
                                    placeholder="Your message..." required></textarea>
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" name="send_message"
                                class="btn bg-secondary text-white w-25">Send</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

    <!-- ------------product popup------------------------- -->
    <?php foreach ($products as $index => $product) { ?>
        <div class="modal fade" id="product<?= $index ?>" data-bs-backdrop="stati" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <?= $product['product_name'] ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row d-flex">
                            <img src="assets/images/product/<?= $product['product_image'] ?>" alt="" class="img-fluid">
                            <?php $prtNum = $product['part_num'];
                            if ($product['bussiness_type'] == 'engineering') {
                                echo "<p>Part Number: $prtNum</p>";
                            } ?>
                            <p>
                                <b>Product Description</b> <br>
                                <?= $product['product_description'] ?>
                            </p>
                        </div>

                        <h5 class="text-center">Leave a comment</h5>
                        <form action="makefo_data/add_data.php" class="form-horizontal" method="POST">
                            <input type="hidden" name="link" value="<?= $id ?>">
                            <input type="hidden" value="<?= $product['id'] ?>" name="productId" id="">
                            <input type="text" class="form-control my-2" placeholder="Phone Number" name="phone" id=""
                                required>
                            <textarea name="comment_msg" placeholder="Your comment" class="form-control my-2" id=""
                                cols="30" rows="5" required></textarea>

                            <button type="submit" name="comment" class="btn bg-secondary text-white">Comment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>


    <!-- ======= Contact Section ======= -->
    <section id="contact">
        <div class="container-fluid" data-aos="fade-up">

            <div class="section-header">
                <h3>Contact Us</h3>
            </div>

            <div class="row">

                <div class="col-lg-6">
                    <div class="map mb-4 mb-lg-0">


                    <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15958.951698989158!2d32.7130856!3d0.363729!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x177db9e9002b3eb7%3A0x90ad4ecfeb7423a2!2sLE%20CIEL!5e0!3m2!1sen!2sug!4v1700584905845!5m2!1sen!2sug"
                            style="border:0; width: 100%; height: 340px;" allowfullscreen allowfullscreen=""
                            loading="lazy"></iframe>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-5 info">
                            <i class="fas fa-location"></i>
                            <p>LE CIEL off Namilyango Rd, Seeta <br>Tell: 0393943366</p>
                        </div>
                        <div class="col-md-4 info">
                            <i class="fas fa-envelope"></i>
                            <p>
                                <?= $about_info['email'] ?>
                            </p>
                        </div>
                        <div class="col-md-3 info">
                            <i class="fas fa-phone"></i>
                            <p>
                                <?= $about_info['phone'] ?>
                            </p>
                        </div>
                    </div>

                    <div class="form">
                        <form action="makefo_data/add_data.php" method="post" role="form" class="php-email-form">
                            <input type="hidden" name="link" value="<?= $id ?>">
                            <input type="hidden" value="<?= $product['id'] ?>" name="productId" id="">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <input type="text" name="sender_name" class="form-control" id="name"
                                        placeholder="Your Name" required>
                                </div>
                                <div class="form-group col-lg-6 mt-3 mt-lg-0">
                                    <input type="text" class="form-control" name="sender_phone" id="email"
                                        placeholder="Your Phone Number" required>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <textarea class="form-control" name="msg" rows="5" placeholder="Message"
                                    required></textarea>
                            </div>
                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>
                            <div class="text-center"><button type="submit" name="send_message" title="Send Message">Send
                                    Message</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- End Contact Section -->

    <footer>
        <div class="container footer_container">
            <div class="footer_1">
                <a href="#" class="footer_logo nav-link">
                    <h4>MAKEFO VENTURES</h4>
                </a>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil, exercitationem!</p>
            </div>

            <div class="footer_2">
                <h4>Permalinks</h4>
                <ul class="peermalinks">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="engineeringsolutions.php">Engineering Solutions</a></li>
                    <li><a href="beauty&wellbeing.php">Beauty & Wellbeing</a></li>
                    <li><a href="greenlife.php">Green Life</a></li>
                    <li><a href="tour&accommodation.php">Tour & Accommodation</a></li>
                </ul>
            </div>

            <div class="footer_3">
                <h4>Privacy</h4>
                <ul class="privacy">
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms and conditions</a></li>
                    <li><a href="#">Refund Policy</a></li>
                </ul>
            </div>

            <div class="footer_4">
                <h4>Contact Us</h4>
                <div>
                    <p class="footer_socials"><i class="fa fa-phone"></i>
                        <?= $about_info['phone'] ?>
                    </p>
                    <a href="https://wa.me/<?= $about_info['phone'] ?>" class="nav-link">
                        <p class="footer_socials"><i class="fab fa-whatsapp"></i>Whatsapp</p>
                    </a>
                    <a href="mailto:makefo@gmail.com" class="nav-link">
                        <p class="footer_socials"><i class="fas fa-envelope"></i>
                            <?= $about_info['email'] ?>
                        </p>
                    </a>


                </div>

                <ul class="footer_socials">
                    <li><a href="#"><i class="fa-brands fa-square-facebook"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                </ul>
            </div>

        </div>
        <div class="footer_copyright">
            <small>Copyright &copy;2023 makefo ventures</small>
        </div>
    </footer>

    <script>
        var navLinks = document.getElementById("navLinks");

        function showMenu() {
            navLinks.style.right = "0";
        }

        function hideMenu() {
            navLinks.style.right = "-200px";
        }
    </script>

    <script src="assets/js/app.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>


    <script>
        function searchCusTable() {
            var input, filter, categories, category, i, txtValue;
            input = document.getElementById("customSearchInpt");
            filter = input.value.toLowerCase();
            categories = document.getElementById("customsCatgoryContainer").getElementsByClassName("col-md-4");

            for (i = 0; i < categories.length; i++) {
                category = categories[i];
                txtValue = category.textContent || category.innerText;

                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    category.style.display = "";
                } else {
                    category.style.display = "none";
                }
            }
        }
    </script>








</body>

</html>