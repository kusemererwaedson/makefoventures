<?php
session_start();

$sessionId = $_SESSION['id'] ?? '';
$id = $_REQUEST['id'] ?? 'dashboard';
$action = $_REQUEST['action'] ?? '';
$page = $_REQUEST['page'] ?? '';


include("../db_con.php");
include("../makefo_data/get_data.php");
$user = getUser($conn);
$about_info = getAbout($conn);
$services = getServices($conn);
$messages = getMessages($conn);
$comments = getComments($conn);
$categories = getCategories($conn);
$subcategories = getSubcategories($conn);
$products = getProducts($conn);

if (!$sessionId ) {
    header("location:login.php");
    die();
}

ob_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Makefo Ventures</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="../assets/js/swal.js"></script>
</head>

<body>
    <?php if (isset($_GET['success'])) { ?>
    <script>
    setTimeout(function() {
            swal("Success", "<?= $_GET['success'] ?>", "success");
        },
        100);
    </script>

    <?php } ?>

    <?php if (isset($_GET['error'])) { ?>
    <script>
    setTimeout(function() {
            swal("Failed", "<?= $_GET['error'] ?>", "error");
        },
        100);
    </script>

    <?php } ?>


    <div class="sidebar bg_blue">
        <h3 class="text-center">Makefo Ventures</h3>
        <hr>
        <ul class="">

            <li>
                <a href="index.php?id=dashboard"><i class="fa-solid fa-gauge"></i> Dashboard</a>
            </li>


            <li>
                <a href="index.php?id=messages"><i class="fa-solid fa-envelope"></i> Messages</a>
            </li>


            <li>
                <a href="index.php?id=comments"><i class="fa-solid fa-comment"></i> Comments</a>
            </li>

            <li>
                <?php printf("<a href='index.php?&page=main&id=engineering'><i class='fa-solid fa-wrench'></i>Engineering
                    Solutions</a>", $id) ?>
            </li>
            <li>

            <li>
                <?php printf("<a href='index.php?page=main&id=beauty'><i class='fa-solid fa-user'></i>Beauty &
                    Wellbeing</a>", $id) ?>
            </li>
            <li>

            <li>
                <?php printf("<a href='index.php?page=main&id=greenlife'><i class='fa-solid fa-calendar-days'></i> Green Life</a>", $id) ?>
            </li>
            <li>

            <li>
                <?php printf("<a href='index.php?page=main&id=tour'><i class='fa fa-house'></i> Tour & Accommodation</a>", $id) ?>
            </li>

            <li>
                <a href="index.php?id=settings"><i class="fa-solid fa-gears"></i>Settings</a>
            </li>



        </ul>

    </div>



    <!-- --------------------------------topbar------------------------------------------------- -->
    <div>
        <div class="topbar ">
            <div class="p-3 bg_white">
                <p class="text-end text_blue"><a href="logout.php" class="nav-link">Logout</a></p>
            </div>
        </div>


        <!-- ----------------------------------------------------------------------------------------------------------------------------------- -->

        <div class="main-body  p-5">
            <div class="container">
                <!-- ---------------------------------dashboard ------------------------------------- -->
                <?php if ($id == 'dashboard') {

                    ?>

                <div class="main my-5">
                    <div class="row justify-content-between">
                        <div class="col-md-4 my-3">
                            <div class="bg-warning text-white text-center p-4">
                                <h1>
                                    <?php
                                            $query = "SELECT COUNT(*) totalMsg FROM message WHERE status='unread';";
                                            $stmt = $conn->query($query);
                                            $totalMsg = $stmt->fetch(PDO::FETCH_ASSOC);

                                            echo $totalMsg['totalMsg'];
                                            ?>
                                </h1>

                                <h3>Unread Messages</h3>
                            </div>
                        </div>

                        <div class="col-md-4 my-3">
                            <div class=" bg-success text-white text-center p-4">
                                <h1>
                                    <?php
                                            $query = "SELECT COUNT(*) totalComment FROM comment WHERE status='new';";
                                            $stmt = $conn->query($query);
                                            $totalComment = $stmt->fetch(PDO::FETCH_ASSOC);

                                            echo $totalComment['totalComment'];
                                            ?>
                                </h1>
                                <h3>Comments</h3>
                            </div>
                        </div>
                        <div class="col-md-4 my-3">
                            <div class=" text-center bg-primary text-white p-4">
                                <h1>
                                    <?php
                                            $query = "SELECT COUNT(*) totalProduct FROM product";
                                            $stmt = $conn->query($query);
                                            $totalProduct = $stmt->fetch(PDO::FETCH_ASSOC);

                                            echo $totalProduct['totalProduct'];
                                            ?>
                                </h1>
                                <h3>Products</h3>
                            </div>
                        </div>



                    </div>
                </div>

                <div class="about my-3">

                    <h4>About Makefo</h4>
                    <form action="../makefo_data/add_data.php" method="POST">
                        <textarea name="about_info" id="" class="form-control my-2" cols="30" value="" placeholder=""
                            rows="10"><?= $about_info['about']; ?></textarea>

                            <label for=""><h4>Slogan</h4></label>
                            <input type="text" name="slogan" class="form-control my-1" value="<?=$about_info['slogan']?>"id="">

                        <button name="update_about" class="my-3 p-2 btn btn-primary">Update About</button>
                    </form>
                </div>

                <div class="services my-3 ">
                    <h4>Services by Makefo</h4>
                    <div class="container-fluid">
                        <div class="row ">
                            <?php foreach ($services as $index => $service) { ?>
                            <div class="col-md-3 p-2 bg-light">

                                <h5 class="text-center ">
                                    <?= $service['service_name'] ?>
                                </h5>
                                <p>
                                    <?= $service['description'] ?>
                                </p>

                                <div class="text-center">
                                    <?php printf("<a href='index.php?action=edit_service&id=%s' class='my-3 btn btn-primary '>Edit Service</a>", $service['id']) ?>

                                </div>
                            </div>

                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="contact mt-5 container-fluid">

                    <h4>Edit Contact Information</h4>
                    <form action="../makefo_data/add_data.php" method="POST" class="form-group ">
                        <input type="text" value="<?= $about_info['phone'] ?>" class="form-control p-2 my-3"
                            name="phone" id="">

                        <input type="text" value="<?= $about_info['email'] ?>" class="form-control p-2 my-3"
                            name="email" id="">

                        <button name="update_contact" class="  my-3 btn btn-primary">Update</button>
                    </form>

                </div>
                <hr>
                <p class="text-center p-3">copy@&copy;2023 makefo.com</p>

                <?php
                } ?>

                <!-- --------------------edit service------------------- -->
                <?php if ($action == 'edit_service') {
                    $service_id = $_REQUEST['id'];
                    $service = getServiceById($service_id, $conn);
                    ?>

                <h5 class="text-center">Edit Service</h5>
                <div class="card mx-auto p-3">
                    <form action="../makefo_data/add_data.php" method="POST">
                        <input type="hidden" name="service_id" value="<?= $service['id'] ?>">
                        <input type="text" name="service_name" class="form-control p-3 fs-1 my-2"
                            value="<?= $service['service_name'] ?>">
                        <textarea name="service_desc" id="" class="form-control p-3 my-5 fs-2"
                            rows="5"><?= $service['description'] ?></textarea>

                        <button type="submit" name="update_service" class="btn btn-primary">Update</button>
                    </form>
                </div>

                <?php } ?>


                <!-- ----------------------------------------messages section--------------------------- -->
                <?php if ($id == 'messages') {
                    ?>
                <div>
                    <h3 class="text-center">Messages</h3>
                    <h4>Unread messages</h4>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Sender Name</th>
                                <th>Sender Phone</th>
                                <th>Date Sent</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($messages as $index => $msg) {
                                        if ($msg['status'] == 'unread') {
                                            ?>
                            <tr>
                                <td>
                                    <?= $msg['sender_name'] ?>
                                </td>
                                <td>
                                    <?= $msg['sender_phone'] ?>
                                </td>
                                <td>
                                    <?= $msg['date_sent'] ?>
                                </td>
                                <td>
                                    <?php printf("<a href='index.php?action=viewMessage&id=%s' class='btn'><i class='text-success fa fa-eye'></i></a>", $msg['id']) ?>

                                    <?php if ($msg['importance'] == '0') { ?>
                                    <button class='btn text-danger' data-bs-toggle='modal'
                                        data-bs-target='#deleteMsg<?= $index ?>'><i class='fas fa-trash'></i></button>

                                    <?php } ?>
                                </td>
                            </tr>


                            <?php }
                                    }
                                    ?>
                        </tbody>
                    </table>

                </div>

                <div class="mt-5 pt-5">
                    <h4>Read messages</h4>
                    <input type="search" class="form-control p-2 my-3" name="searchKeyword" id="searchInput"
                        onkeyup="searchTable()" placeholder="Search for a message">

                    <table class="table table-bordered table-hover table-striped" id="tableData">
                        <thead>
                            <tr>
                                <th>Sender Name</th>
                                <th>Sender Phone</th>
                                <th>Date Sent</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($messages as $index => $msg) {
                                        if ($msg['status'] == 'read') {
                                            ?>
                            <tr>
                                <td>
                                    <?= $msg['sender_name'] ?>
                                </td>
                                <td>
                                    <?= $msg['sender_phone'] ?>
                                </td>
                                <td>
                                    <?= $msg['date_sent'] ?>
                                </td>
                                <td>
                                    <?php printf("<a href='index.php?action=viewMessage&id=%s' class='btn'><i class='text-success fa fa-eye'></i></a>", $msg['id']) ?>

                                    <?php if ($msg['importance'] == '0') { ?>
                                    <button class='btn text-danger' data-bs-toggle='modal'
                                        data-bs-target='#deleteMsg<?= $index ?>'><i class='fas fa-trash'></i></button>

                                    <?php } ?>
                                </td>
                            </tr>
                            <?php }
                                    }
                                    ?>
                        </tbody>
                    </table>

                </div>
                <?php } ?>

                <!-- ------------------view message ------------ -->
                <?php if ('viewMessage' == $action) {
                    $msg_id = $_REQUEST['id'];

                    $msg = getMessageById($msg_id, $conn);
                    $query = "UPDATE message SET status='read' WHERE id='$msg_id'";
                    $stmt = $conn->query($query);

                    ?>
                <h3 class="text-center">Message</h3>
                <div class="card mx-auto w-75 p-4">
                    <h5>Sender: <span>
                            <?= $msg['sender_name'] ?>
                        </span></h5>
                    <h5>Phone: <span>
                            <?= $msg['sender_phone'] ?>
                        </span></h5>
                    <h5>Date Sent: <span>
                            <?= $msg['date_sent'] ?>
                        </span></h5>


                    <?php
                            if ($msg['importance'] == '0') {
                                printf("<a class='text-end nav-link' href='index.php?action=achieveMsg&id=%s'><i class='fas fa-star'></i>Achieve</a>", $msg['id']);
                            } else {
                                printf("<a class='text-end nav-link text-warning' href='index.php?action=achieveMsg&id=%s'><i class='fas fa-star'></i>UnAchieve</a>", $msg['id']);
                            }
                            ?>
                    <hr>
                    <h5>
                        <?= $msg['msg_content'] ?>
                    </h5>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <a href="index.php?id=messages" class="btn btn-primary float-end">Back to
                                Messages</a>
                        </div>
                    </div>

                </div>
                <?php } ?>
                <!-- ------------------------achieve Message ----------->
                <?php if ('achieveMsg' == $action) {
                    $msg_id = $_REQUEST['id'];
                    $msg = getMessageById($msg_id, $conn);
                    $imp = $msg['importance'];
                    if ($imp == '0') {
                        $sql = "UPDATE message SET importance='1' WHERE id='$msg_id'";
                        $stmt = $conn->query($sql);
                        $sm = "Message was Achieved";
                    } elseif ($imp == '1') {
                        $sql = "UPDATE message SET importance='0' WHERE id='$msg_id'";
                        $stmt = $conn->query($sql);
                        $sm = "Message was Unachieved";
                    }
                    if ($stmt == true) {

                        header("location:index.php?id=messages&success=$sm");
                    } else {
                        $err = "Something went wrong";
                        header("location:index.php?id=messages&error=$err");
                    }

                } ?>

                <!-- ------------------------delete Message------------ -->
                <?php foreach ($messages as $index => $msg) { ?>
                <!-- -------delete message popup -------- -->
                <div class="modal fade" id="deleteMsg<?= $index ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <p>Are you sure you want to Delete this Message </p>
                                <form action="../makefo_data/add_data.php" method="POST">
                                    <input name="msg_id" type="text" value="<?= $msg['id'] ?>" hidden>
                                    <div class="text-center p-3">
                                        <button type="button" class="btn m-4 bg_blue"
                                            data-bs-dismiss="modal">No</button>
                                        <button type="submit" name="deleteMsg" class="btn btn-danger"
                                            id="confirmButton">Yes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <!-- --------------------------------------------comments section--------------------------------------------------------- -->
                <?php if ($id == 'comments') {

                    ?>
                <div class="col-lg-12">
                    <h4>Comments</h4>
                    <div class="card card-outline card-primary">

                        <div class="card-header">
                            <input type="search" class="form-control p-2 my-3" name="searchKeyword" id="searchInput"
                                onkeyup="searchTable()" placeholder="Search for a Comment">
                        </div>
                        <div class="card-body">

                            <table class="table table-hover table-bordered table-compact" id="tableData">
                                <colgroup>
                                    <col width="25%">
                                    <col width="25%">
                                    <col width="30%">
                                    <col width="15%">

                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>Sender Phone</th>
                                        <th> Product Commented</th>
                                        <th>Comment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($comments as $index => $comment) {
                                                $pdtId = $comment['product_id'];
                                                $product = getProductById($pdtId, $conn)

                                                    ?>
                                    <tr>
                                        <td><b>
                                                <?= $comment['commentor_phone'] ?>
                                            </b></td>

                                        <td class='text-center'>
                                            <img src="../assets/images/product/<?= $product['product_image'] ?>" alt=""
                                                width="150px" height="150px"
                                                style="object-fit:scale-down;object-position:center center"
                                                class="img-thumbnail">

                                        </td>

                                        <td><small class="truncate">
                                                <?= $comment['comment_context'] ?>
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                            if ($comment['like_comment'] == '0') {
                                                                printf("<a href='index.php?action=like-comment&id=%s&link=%s' class='btn '><i class='fa text-primary fa-heart'></i></a>", $comment['id'], $id);
                                                            } else {
                                                                printf("<a href='index.php?action=like-comment&id=%s&link=%s' class='btn  '><i class='text-danger fa fa-heart'></i></a>", $comment['id'], $id);
                                                            } ?>
                                            <?php if ($comment['like_comment'] == '0') {
                                                                ?>
                                            <button class='btn text-danger' data-bs-toggle='modal'
                                                data-bs-target='#deleteComm<?= $index ?>'><i
                                                    class='fas fa-trash'></i></button>
                                            <?php
                                                            } ?>
                                        </td>
                                    </tr>
                                    <?php }

                                            ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <?php
                } ?>
                <!-- -----------------------------like comment-------------------- -->

                <?php if ('like-comment' == $action) {
                    $comm_id = $_REQUEST['id'];
                    $comm = getCommentById($comm_id, $conn);
                    $imp = $comm['like_comment'];
                    if ($imp == '0') {
                        $sql = "UPDATE comment SET like_comment='1' WHERE id='$comm_id'";
                        $stmt = $conn->query($sql);
                        $sm = "Liked A Comment";
                    } elseif ($imp == '1') {
                        $sql = "UPDATE comment SET like_comment='0' WHERE id='$comm_id'";
                        $stmt = $conn->query($sql);
                        $sm = "Unliked A Comment";
                    }
                    if ($stmt == true) {

                        header("location:index.php?id=comments&success=$sm");
                    } else {
                        $err = "Something went wrong";
                        header("location:index.php?id=comments&error=$err");
                    }

                } ?>

                <!-- ------------------deleteComment------------------------------ -->

                <?php foreach ($comments as $index => $comment) { ?>
                <!-- -------delete comment popup -------- -->
                <div class="modal fade" id="deleteComm<?= $index ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <p>Are you sure you want to Delete this Comment </p>
                                <form action="../makefo_data/add_data.php" method="POST">
                                    <input name="comm_id" type="text" value="<?= $comment['id'] ?>" hidden>
                                    <div class="text-center p-3">
                                        <button type="button" class="btn m-4 bg_blue"
                                            data-bs-dismiss="modal">No</button>
                                        <button type="submit" name="deleteComment" class="btn btn-danger"
                                            id="confirmButton">Yes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>


                <!-- ---------------------------------------------main page--------------------------- -->
                <?php if ($page == 'main') {
                    $ent = $_REQUEST['id'];

                    ?>
                <div class="row justify-content-between my-2">
                    <h3 class="text-center p-3">
                        <?php if ($ent == 'engineering') {
                                    echo "Engineering Solutions";
                                } elseif ($ent == 'beauty') {
                                    echo "Beauty And Wellbeing";
                                } elseif ($ent == 'greenlife') {
                                    echo "Green Life";
                                } elseif ($ent == 'tour') {
                                    echo "Tour And Accommodation";
                                }
                                ?>
                    </h3>

                    <div class="col-md-3 ">
                        <div class="text-center text-white  bg-warning p-4">
                            <h3>
                                <?php
                                        $query = "SELECT COUNT(*) totalCategories FROM category WHERE business_type='$ent';";
                                        $stmt = $conn->query($query);
                                        $totalCategories = $stmt->fetch(PDO::FETCH_ASSOC);

                                        echo $totalCategories['totalCategories'];
                                        ?>
                            </h3>
                            <h5>categories</h5>
                        </div>


                    </div>

                    <div class="col-md-3 ">
                        <div class="text-center text-white  bg-success p-4">
                            <h3>
                                <?php
                                        $query = "SELECT COUNT(*) totalSubcategories FROM subcategory WHERE business_type='$ent';";
                                        $stmt = $conn->query($query);
                                        $totalSubcategories = $stmt->fetch(PDO::FETCH_ASSOC);
                                        echo $totalSubcategories['totalSubcategories'];
                                        ?>
                            </h3>
                            <h5>Sub Categories</h5>
                        </div>


                    </div>

                    <div class="col-md-3 ">
                        <div class="text-center text-white  bg-primary p-4">
                            <h3>
                                <?php
                                        $query = "SELECT COUNT(*) totalProducts FROM product WHERE bussiness_type='$ent';";
                                        $stmt = $conn->query($query);
                                        $totalProducts = $stmt->fetch(PDO::FETCH_ASSOC);

                                        echo $totalProducts['totalProducts'];
                                        ?>
                            </h3>
                            <h5>Products</h5>
                        </div>


                    </div>
                    <?php printf("<a href='index.php?page=categories&id=%s' class='btn btn-secondary p-2 my-2'>Go To Categories, Then Select A Sub-category To Add a product</a>", $id) ?>

                </div>
                <?php
                } ?>


                <!----------------------------------------------------category page---------------------- -->
                <?php if ($page == 'categories') {
                    $ent = $_REQUEST['id'];

                    ?>
                <h3 class="text-center">Categories</h3>
                <button data-bs-target="#add_category" data-bs-toggle="modal" class="btn btn-secondary my-3">Add
                    New Category</button>

                <!-- ------------add category popup------------------------- -->
                <div class="modal fade" id="add_category" data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="../makefo_data/add_data.php" class="form-horizontal" method="POST"
                                    enctype="multipart/form-data">
                                    <input type="hidden" name="businessType" value="<?= $ent ?>" id="">
                                    <input type="hidden" name="link" value="<?= $page ?>" id="">

                                    <div class="form-group">
                                        <label for="">Category Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="cat_name" class="form-control my-2"
                                                placeholder="Enter Category Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Category Image</label>
                                        <input type="file" name="cat_img" class="form-control my-3" accept="image/*"
                                            id="cat_img" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Category Description</label>
                                        <textarea name="cat_desc" class="form-control my-3" id="" cols="30" rows="5"
                                            placeholder="category Decription" required></textarea>

                                    </div>

                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button name="add_category" class="btn text-white bg-primary">Add
                                            category</button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer"><small>Makefo Ventures</small></div>
                        </div>
                    </div>
                </div>

                <input type="search" class="form-control p-2 my-3" name="searchKeyword" id="customSearchInput"
                    onkeyup="searchCustomTable()" placeholder="Search for a Category">

                <div class="row" id="customCategoryContainer">
                    <?php foreach ($categories as $index => $category) {

                                if ($category['business_type'] == $ent) { ?>
                    <div class="col-md-3 p-2 my-3">
                        <div class="card p-1">
                            <div class="card-title">
                                <h5 class="text-center p-3">
                                    <?= $category['category_name'] ?>
                                </h5>
                                <img src="../assets/images/category/<?= $category['category_image'] ?>" alt=""
                                    height="120px" class="card-img">
                                <div class="card-body">
                                    <div class="text-center">
                                        <?php printf("<a href='index.php?page=view-category&id=%s' class='btn text-white btn-primary'>Sub-categories</a>", $category['id']) ?>
                                    </div>
                                    <div class="d-flex justify-content-between">

                                        <button class='btn text-warning' data-bs-target="#edit_category<?= $index ?>"
                                            data-bs-toggle="modal"><i class="fa  fa-pen"></i></button>

                                        <button class='btn text-danger' data-bs-toggle='modal'
                                            data-bs-target='#deleteCat<?= $index ?>'><i
                                                class='fas fa-trash'></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                                }

                                ?>
                    <!-- ----------------------------edit category----------------------------- -->
                    <div class="modal fade" id="edit_category<?= $index ?>" data-bs-backdrop="static"
                        data-bs-keyboard="false">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="../makefo_data/add_data.php" class="form-horizontal" method="POST"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="cat_id" value="<?= $category['id'] ?>" id="">
                                        <input type="hidden" name="businessType" value="<?= $ent ?>" id="">
                                        <input type="hidden" name="link" value="<?= $page ?>" id="">

                                        <div class="form-group">
                                            <label for="">Category Name</label>
                                            <div class="col-sm-12">
                                                <input type="text" name="cat_name" class="form-control my-2"
                                                    placeholder="Enter Category Name"
                                                    value="<?= $category['category_name'] ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Category Description </label>
                                            <textarea name="cat_desc" class="form-control my-3" cols="30"
                                                rows="5"><?= $category['category_description'] ?></textarea>

                                        </div>
                                        <div class="form-group">

                                            <label for="">Category Image<i class="fas fa-pen text-center"
                                                    id="chooseImage"></i></label>
                                            <input name="cat_img" type="file" id="fileInput"
                                                value="<?= $category['category_image'] ?>" accept="image/*"
                                                class="form-control my-3">
                                            <img src="../assets/images/category/<?= $category['category_image'] ?>"
                                                class="form-control w-100 " height="170px" alt="Current category Image"
                                                id="profileImage" id="chooseImage">
                                            <input type="text" name="cat_img" value="<?= $category['category_image'] ?>"
                                                hidden>

                                        </div>


                                        <div class="col-sm-offset-2 col-sm-10 mt-2">
                                            <button name="edit_category" class="btn bg-primary text-white">Update
                                                category</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer"><small>Makefo Ventures</small></div>
                            </div>
                        </div>
                    </div>

                    <!-- -------delete category popup -------- -->
                    <div class="modal fade" id="deleteCat<?= $index ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body text-center">
                                    <p>Are you sure you want to Delete this Category </p>
                                    <form action="../makefo_data/add_data.php" method="POST">
                                        <input type="hidden" name="businessType" value="<?= $ent ?>" id="">
                                        <input type="hidden" name="link" value="<?= $page ?>" id="">
                                        <input name="cat_id" type="text" value="<?= $category['id'] ?>" hidden>
                                        <div class="text-center p-3">
                                            <button type="button" class="btn m-4 bg_blue"
                                                data-bs-dismiss="modal">No</button>
                                            <button type="submit" name="deleteCategory" class="btn btn-danger"
                                                id="confirmButton">Yes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php

                            } ?>
                </div>
                <?php
                } ?>

                <?php if ($page == "view-category") {
                    $cat_id = $_REQUEST['id'];
                    $category = getCategoryById($cat_id, $conn);
                    $ent = $category['business_type'];
                    ?>
                <h3 class="text-center">
                    <?= $category['category_name'] ?>
                </h3>
                <p class="text-center">
                    <?= $category['category_description'] ?>
                </p>

                <div class="container mt-2">
                    <div class="row">
                        <div class="col text-center">
                            <img src="../assets/images/category/<?= $category['category_image'] ?>"
                                class="img-flui mx-auto" width="85%" height="200px" alt="Centered Image">
                        </div>
                    </div>
                </div>

                <h4 class="mt-3 text-center">Sub Categories</h4>
                <button data-bs-target="#add_sub-category" data-bs-toggle="modal" class="btn btn-secondary my-3">Add
                    New Sub-Category</button>

                <!-- ------------add sub-category popup------------------------- -->
                <div class="modal fade" id="add_sub-category" data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Sub-Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="../makefo_data/add_data.php" class="form-horizontal" method="POST"
                                    enctype="multipart/form-data">
                                    <input type="hidden" name="cat" value="<?= $cat_id ?>" id="">
                                    <input type="hidden" name="link" value="<?= $page ?>" id="">
                                    <input type="hidden" name="ent" value="<?= $ent ?>" id="">

                                    <div class="form-group">
                                        <label for="">Sub-category Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="subcat_name" class="form-control my-2"
                                                placeholder="Enter Sub-category Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Sub-category Image</label>
                                        <input type="file" name="subcat_img" class="form-control my-3" accept="image/*"
                                            id="subcat_img" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Sub-category Description</label>
                                        <textarea name="subcat_desc" class="form-control my-3" id="" cols="30" rows="5"
                                            placeholder="Sub-category Decription" required></textarea>

                                    </div>

                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" name="add_sub-category"
                                            class="btn text-white bg-primary">Add
                                            Sub-category</button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer"><small>Makefo Ventures</small></div>
                        </div>
                    </div>
                </div>


                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <div class="card-tools">
                            <input type="search" class="form-control p-2 my-3" name="searchKeyword" id="searchInput"
                                onkeyup="searchTable()" placeholder="Search for a Sub-category">
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered table-compact" id="tableData">
                            <colgroup>
                                <col width="20%">
                                <col width="25%">
                                <col width="25%">
                                <col width="35%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-center">Sub-Category</th>
                                    <th>Sub-category Image</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($subcategories as $index => $subcategory) {
                                            if ($subcategory['category_id'] == $cat_id) { ?>
                                <tr>
                                    <td>
                                        <?= $subcategory['subcategory_name'] ?>
                                    </td>
                                    <td>
                                        <img src="../assets/images/subcategory/<?= $subcategory['subcategory_image'] ?>"
                                            alt="" height='90' width='90'>
                                    </td>
                                    </td>
                                    <td>
                                        <?= $subcategory['subcategory_description'] ?>
                                    </td>
                                    <td>
                                        <?php printf("<a href='index.php?page=products&id=%s' class='btn text-white btn-primary'>Products</a>", $subcategory['id']) ?>


                                        <button class='text-warning btn '
                                            data-bs-target="#edit_subcategory<?= $index ?>" data-bs-toggle="modal"><i
                                                class="fa fa-pen"></i></button>

                                        <button class='btn text-danger' data-bs-toggle='modal'
                                            data-bs-target='#deleteSubcat<?= $index ?>'><i
                                                class='fas fa-trash'></i></button>
                                    </td>
                                </tr>
                                <?php }

                                            ?>
                                <!-- ----------------------------edit subcategory----------------------------- -->
                                <div class="modal fade" id="edit_subcategory<?= $index ?>" data-bs-backdrop="static"
                                    data-bs-keyboard="false">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Sub-category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../makefo_data/add_data.php" class="form-horizontal"
                                                    method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="subcat_id"
                                                        value="<?= $subcategory['id'] ?>" id="">

                                                    <input type="hidden" name="cat" value="<?= $cat_id ?>" id="">
                                                    <input type="hidden" name="link" value="<?= $page ?>" id="">

                                                    <div class="form-group">
                                                        <label for="">Sub-category Name</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" name="subcat_name"
                                                                class="form-control my-2"
                                                                placeholder="Enter Category Name"
                                                                value="<?= $subcategory['subcategory_name'] ?>"
                                                                required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Sub-category Description </label>
                                                        <textarea name="subcat_desc" class="form-control my-3" cols="30"
                                                            rows="5"><?= $subcategory['subcategory_description'] ?></textarea>

                                                    </div>
                                                    <div class="form-group">

                                                        <label for="">Sub-category Image<i
                                                                class="fas fa-pen text-center"
                                                                id="chooseImage"></i></label>
                                                        <input name="subcat_img" type="file" id="fileInput"
                                                            value="<?= $subcategory['subcategory_image'] ?>"
                                                            accept="image/*" class="form-control my-3"
                                                            placeholder="Chose another Image">

                                                        <img src="../assets/images/subcategory/<?= $subcategory['subcategory_image'] ?>"
                                                            class="form-control w-100 " height="170px"
                                                            alt="Current subcategory Image" id="profileImage"
                                                            id="chooseImage">
                                                        <input type="text" name="subcat_img"
                                                            value="<?= $subcategory['subcategory_image'] ?>" hidden>

                                                    </div>


                                                    <div class="col-sm-offset-2 col-sm-10 mt-2">
                                                        <button name="edit_subcategory"
                                                            class="btn bg-primary text-white">Update
                                                            Sub-category</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer"><small>Makefo Ventures</small></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- -------delete subcategory popup -------- -->
                                <div class="modal fade" id="deleteSubcat<?= $index ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <p>Are you sure you want to Delete this Sub-category </p>
                                                <form action="../makefo_data/add_data.php" method="POST">
                                                    <input type="hidden" name="cat" value="<?= $cat_id ?>" id="">
                                                    <input type="hidden" name="link" value="<?= $page ?>" id="">

                                                    <input name="subcat_id" type="text"
                                                        value="<?= $subcategory['id'] ?>" hidden>
                                                    <div class="text-center p-3">
                                                        <button type="button" class="btn m-4 bg_blue"
                                                            data-bs-dismiss="modal">No</button>
                                                        <button type="submit" name="deleteSubcategory"
                                                            class="btn btn-danger" id="confirmButton">Yes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                        } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <?php
                } ?>

            <?php if ($page == 'products') {
                $subcat_id = $_REQUEST['id'];
                $subcategory = getSubcategoryById($subcat_id, $conn);

                $cat_id = $subcategory['category_id'];
                $cat = getCategoryById($cat_id, $conn);
                $entps = $cat['business_type'];

                ?>
            <h3 class="text-center p-3">
                <?= $subcategory['subcategory_name'] ?>
            </h3>

            <button data-bs-target="#add_product" data-bs-toggle="modal" class="btn btn-secondary my-3">Add
                New Product</button>

            <div class="col-sm-offset-2 col-sm-12 ">
                <!-- ------------add product popup------------------------- -->
                <div class="modal fade" id="add_product" data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="../makefo_data/add_data.php" class="form-horizontal" method="POST"
                                    enctype="multipart/form-data">
                                    <input type="hidden" name="ent" value="<?= $entps ?>" id="">
                                    <input type="hidden" name="link" value="<?= $page ?>" id="">
                                    <input type="hidden" name="subcat" value="<?= $subcat_id ?>" id="">
                                    <input type="hidden" name="catId" value="<?=$subcategory['category_id']?>" id="">

                                    <?php if ($entps == 'engineering') {
                                                echo "<div class='form-group'>
                                                <label for=''>Part Number</label>
                                                <div class='col-sm-12'>
                                                    <input type='text' name='prt_num' class='form-control my-2'
                                                        placeholder='Enter Part Number' required>
                                                </div>
                                            </div>";
                                            } ?>

                                    <div class="form-group">
                                        <label for="">Product Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="pdt_name" class="form-control my-2"
                                                placeholder="Enter Product Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Product Image</label>
                                        <input type="file" name="pdt_image" class="form-control my-3" accept="image/*"
                                            id="pdt_img" required>


                                    </div>

                                    <div class="form-group">
                                        <label for="">Product Description</label>
                                        <textarea name="pdt_desc" class="form-control my-3" id="" cols="30" rows="5"
                                            placeholder="Product Decription" required></textarea>

                                    </div>

                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" name="add_product" class="btn text-white bg-primary">Add
                                            Product</button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer"><small>Makefo Ventures</small></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <div class="card-tools">

                                <input type="search" class="form-control p-2 my-3" name="searchKeyword" id="searchInput"
                                    onkeyup="searchTable()" placeholder="Search for a Product">
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-bordered table-compact" id="tableData">
                                <colgroup>
                                    <col width="15%">
                                    <col width="25%">
                                    <col width="20%">
                                    <col width="20%">
                                    <?php if ($entps == 'engineering') {
                                                echo "<col width='30%'>";
                                            } ?>


                                </colgroup>
                                <thead>
                                    <tr>
                                        <?php if ($entps == 'engineering') {
                                                    echo "<th>Part Number</th>";
                                                } ?>
                                        <th>Product Image</th>
                                        <th>Product Name</th>

                                        <th>Product Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $index => $product) {
                                                $prt_num = $product['part_num'];
                                                if ($product['subcategory_id'] == $subcat_id) {

                                                    ?>

                                    <tr>
                                        <?php if ($entps == 'engineering') {
                                                                    echo "<td>$prt_num</td>";
                                                                } ?>
                                        <td class='text-center'>
                                            <img src="../assets/images/product/<?= $product['product_image'] ?>" alt=""
                                                width="150px" height="150px"
                                                style="object-fit:scale-down;object-position:center center"
                                                class="img-thumbnail">
                                        </td>
                                        <td><b>
                                                <?= $product['product_name'] ?>
                                            </b></td>
                                        <td><small class="truncate">
                                                <?= $product['product_description'] ?>
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            <button class='text-warning btn '
                                                data-bs-target="#edit_product<?= $index ?>" data-bs-toggle="modal"><i
                                                    class="fa fa-pen"></i></button>

                                            <button class='btn text-danger' data-bs-toggle='modal'
                                                data-bs-target='#deleteProduct<?= $index ?>'><i
                                                    class='fas fa-trash'></i></button>
                                        </td>
                                    </tr>
                                    <?php }
                                                ?>
                                    <!------------------------- edit product---------- -->
                                    <div class="modal fade" id="edit_product<?= $index ?>" data-bs-backdrop="static"
                                        data-bs-keyboard="false">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Product</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="../makefo_data/add_data.php" class="form-horizontal"
                                                        method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" name="ent" value="<?= $entps ?>" id="">
                                                        <input type="hidden" name="link" value="<?= $page ?>" id="">
                                                        <input type="hidden" name="pdt_id" value="<?= $product['id'] ?>"
                                                            id="">
                                                        <input type="hidden" name="subcat" value="<?= $subcat_id ?>"
                                                            id="">

                                                        <?php if ($entps == 'engineering') {
                                                                            $prt_num = $product['part_num'];
                                                                            echo "<div class='form-group'>
                                                <label for=''>Part Number</label>
                                                <div class='col-sm-12'>
                                                    <input type='text' name='prt_num' class='form-control my-2'
                                                        placeholder='Enter Part Number' value='$prt_num' required>
                                                </div>
                                            </div>";
                                                                        } ?>

                                                        <div class="form-group">
                                                            <label for="">Product Name</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" name="pdt_name"
                                                                    class="form-control my-2"
                                                                    placeholder="Enter Product Name" required
                                                                    value="<?= $product['product_name'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">

                                                            <label for="">Product Image<i class="fas fa-pen text-center"
                                                                    id="chooseImage"></i></label>
                                                            <input name="pdt_image" type="file" id="fileInput"
                                                                value="<?= $product['product_image'] ?>"
                                                                accept="image/*" class="form-control my-3"
                                                                placeholder="Chose another Image">

                                                            <img src="../assets/images/subcategory/<?= $product['product_image'] ?>"
                                                                class="form-control w-100 " height="170px"
                                                                alt="Current product Image" id="profileImage"
                                                                id="chooseImage">
                                                            <input type="text" name="pdt_image"
                                                                value="<?= $product['product_image'] ?>" hidden>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Product Description</label>
                                                            <textarea name="pdt_desc" class="form-control my-3" id=""
                                                                cols="30" rows="5" placeholder="Product Decription"
                                                                required><?= $product['product_description'] ?></textarea>

                                                        </div>

                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="edit_product"
                                                                class="btn text-white bg-primary">Update
                                                                Product</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer"><small>Makefo Ventures</small></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- --------------------delete product ---------------- -->
                                    <div class="modal fade" id="deleteProduct<?= $index ?>" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body text-center">
                                                    <p>Are you sure you want to Delete this Product</p>
                                                    <form action="../makefo_data/add_data.php" method="POST">
                                                        <input type="hidden" name="ent" value="<?= $entps ?>" id="">
                                                        <input type="hidden" name="link" value="<?= $page ?>" id="">
                                                        <input type="hidden" name="subcat" value="<?= $subcat_id ?>"
                                                            id="">

                                                        <input name="pdt_id" type="text" value="<?= $product['id'] ?>"
                                                            hidden>
                                                        <div class="text-center p-3">
                                                            <button type="button" class="btn m-4 bg_blue"
                                                                data-bs-dismiss="modal">No</button>
                                                            <button type="submit" name="deleteProduct"
                                                                class="btn btn-danger" id="confirmButton">Yes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                            }
                                            ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php }
            ?>


                <!-- -----------------------------------------------------settings------------------------------------------------- -->

                <?php if ($id == 'settings') {

                 ?>
                <div class="card p-4 mx-auto w-50">
                    <form action="../makefo_data/add_data.php" method="POST" class="w3-center">
                        <input type="hidden" name="userId" value="<?= $user['id'] ?>" id="">
                        <input type="hidden" name="link" value="<?= $id ?>" id="">
                        <h4>Change Username</h4>

                        <input class="form-control my-2" name="uname" value="<?= $user['username'] ?>" type="text"
                            placeholder="Change Username" required>
                        <div class="text-center">
                            <button name="update_username" class="btn btn-primary my-2 ">Change</button>
                        </div>
                    </form>

                    <form action="../makefo_data/add_data.php" method="POST">
                        <input type="hidden" name="userId" value="<?= $user['id'] ?>" id="">
                        <input type="hidden" name="link" value="<?= $id ?>" id="">
                        <input type="hidden" name="str_pass" value="<?= $user['password'] ?>" id="">
                        <h4>Change Password</h4>
                        <input class="form-control my-2 " name="o_pass" type="password" placeholder="Enter Old Password"
                            required><br>
                        <input class="form-control my-2 " name="n_pass" type="password" placeholder="Enter New Password"
                            required><br>
                        <input class="form-control my-2 " name="cfm_pass" type="password"
                            placeholder="Confirm New password" required>
                        <div class="text-center">
                            <button name="update_password" class="btn btn-primary my-2">Change Password</button>
                           
                        </div>
                    </form>
                </div>


                <?php
             } ?>





            </div>
        </div>

        <script src="../assets/js/app.js"></script>

        <script>
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toLowerCase();
            table = document.getElementById("tableData");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                for (var j = 0; j < td.length; j++) {
                    var cell = td[j];
                    if (cell) {
                        txtValue = cell.textContent || cell.innerText;
                        if (txtValue.toLowerCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";

                            break;
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }

        }
        </script>

        <script>
        function searchCustomTable() {
            var input, filter, categories, category, i, txtValue;
            input = document.getElementById("customSearchInput");
            filter = input.value.toLowerCase();
            categories = document.getElementById("customCategoryContainer").getElementsByClassName("col-md-3");

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

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
            integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
        </script>
</body>

</html>