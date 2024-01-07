<?php
include("../db_con.php");

//update about information
if (isset($_POST['update_about'])) {
    $about = $_POST['about_info'];
    $slogan = $_POST['slogan'];
    $query = "UPDATE about_info SET about = '$about', slogan='$slogan'";
    $stmt = $conn->query($query);
    if ($stmt == true) {
        $sm = "About Information Updated Successfully";
        header("Location:../makefo-admin/index.php?id=dashboard&success=$sm");
        exit;
    } else {
        $err = "About Information Update Failed";
        header("Location:../makefo-admin/index.php?id=dashboard&error=$err");
        exit;
    }
}

//update contact Info 
if (isset($_POST['update_contact'])) {
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $query = "UPDATE about_info SET phone = '$phone', email = '$email'";
    $stmt = $conn->query($query);
    if ($stmt == true) {
        $sm = "Contact Information Updated Successfully";
        header("Location:../makefo-admin/index.php?id=dashboard&success=$sm");
        exit;
    } else {
        $err = "Contact Information Update Failed";
        header("Location:../makefo-admin/index.php?id=dashboard&error=$err");
        exit;
    }
}

//update Service
if (isset($_POST['update_service'])) {
    $service_id = $_POST['service_id'];
    $service_name = $_POST['service_name'];
    $service_desc = $_POST['service_desc'];

    if ($service_id && $service_name && $service_desc) {
        $query = "UPDATE service SET service_name='$service_name', description = '$service_desc' WHERE id = '$service_id'";
        $stmt = $conn->query($query);

        if ($stmt == true) {
            $sm = "Service Updated Successfully";
            header("Location:../makefo-admin/index.php?id=dashboard&success=$sm");
            exit;
        } else {
            $err = "Service Update Failed";
            header("Location:../makefo-admin/index.php?id=dashboard&error=$err");
            exit;
        }
    } else {
        $err = "Service Update Failed";
        header("Location:../makefo-admin/index.php?id=dashboard&error=$err");
        exit;
    }

}


//add category
if (isset($_POST['add_category'])) {
    $link = $_POST['link'];
    $bstyp = $_POST['businessType'];
    $cname = $_POST['cat_name'];
    $cdesc = $_POST['cat_desc'];

    $cImage = $_FILES['cat_img']['name'];
    $destination = "../assets/images/category/$cImage";

    if ($cImage) {
        $catImageName = $_FILES['cat_img']['name'];
        $catImageTmpName = $_FILES['cat_img']['tmp_name'];
        move_uploaded_file($catImageTmpName, $destination);
    }
    $query = "INSERT INTO category(category_name, category_image, category_description, business_type) VALUES('$cname','$cImage','$cdesc','$bstyp')";
    $stmt = $conn->query($query);

    if ($stmt == true) {
        $sm = "Category was Added Successfully";
        header("Location:../makefo-admin/index.php?page=$link&id=$bstyp&success=$sm");
        exit;
    } else {
        $err = "Category Addition Failed! Try again";
        header("Location:../makefo-admin/index.php?id=$link&id=$bstyp&error=$err");
        exit;
    }

}

//update category
if (isset($_POST['edit_category'])) {
    $link = $_POST['link'];
    $bstyp = $_POST['businessType'];
    $id = $_POST['cat_id'];
    $cname = $_POST['cat_name'];
    $cdesc = $_POST['cat_desc'];

    $cImage = $_FILES['cat_img']['name'];
    $destination = "../assets/images/category/$cImage";

    if ($cImage !== "") {
        $cImage = $_FILES['cat_img']['name'];
        $catImageTmpName = $_FILES['cat_img']['tmp_name'];
        move_uploaded_file($catImageTmpName, $destination);
    } else {
        $cImage = $_POST['cat_img'];
    }

    $query = "UPDATE category SET category_name='$cname', category_image='$cImage', category_description='$cdesc' WHERE id='$id'";
    $stmt = $conn->query($query);
    if ($stmt == true) {
        $sm = "Category Updated Successfully";
        header("location:../makefo-admin/index.php?page=$link&id=$bstyp&success=$sm");
        exit;
    } else {
        $err = "Category Update Failed";
        header("Location:../makefo-admin/index.php?page=$link&id=$bstyp&error=$err");
        exit;
    }
}

// delete Category 
if (isset($_POST['deleteCategory'])) {
    $catId = $_POST['cat_id'];
    $link = $_POST['link'];
    $bstyp = $_POST['businessType'];

    $sbct = "SELECT id FROM subcategory WHERE category_id='$catId'";
    $res = $conn->query($sbct);
    $sbctId = $res->fetch();

    $sbId = $sbctId['id'];
    if ($sbId) {
        $dpdt = "DELETE FROM product WHERE subcategory_id='$sbId'";
        $dpt = $conn->query($dpdt);

        if ($dpt) {
            $dltSb = "DELETE FROM subcategory WHERE category_id='$catId'";
            $sbd = $conn->query($dltSb);
        }
    }

    $deleteCat = "DELETE FROM category WHERE id ='$catId'";
    $stmt = $conn->query($deleteCat);


    if ($stmt == true) {
        $sm = "Category was Deleted Successfully";
        header("Location:../makefo-admin/index.php?page=$link&id=$bstyp&success=$sm");
        exit;
    } else {
        $err = "Category Deletion Failed! Try again";
        header("Location:../makefo-admin/index.php?id=$link&id=$bstyp&error=$err");
        exit;
    }
}


//add sub-category
if (isset($_POST['add_sub-category'])) {
    $page = $_POST['link'];
    $cat = $_POST['cat'];
    $subcname = $_POST['subcat_name'];
    $subcdesc = $_POST['subcat_desc'];

    $ent = $_POST['ent'];

    $subcImage = $_FILES['subcat_img']['name'];
    $destination = "../assets/images/subcategory/$subcImage";

    if ($subcImage) {
        $subcatImageName = $_FILES['subcat_img']['name'];
        $subcatImageTmpName = $_FILES['subcat_img']['tmp_name'];
        move_uploaded_file($subcatImageTmpName, $destination);
    }
    $query = "INSERT INTO subcategory(subcategory_name, subcategory_image, subcategory_description, category_id, business_type) VALUES('$subcname','$subcImage','$subcdesc','$cat','$ent')";
    $stmt = $conn->query($query);

    if ($stmt == true) {
        $sm = "Sub-category was Added Successfully";
        header("Location:../makefo-admin/index.php?page=$page&id=$cat&success=$sm");
        exit;
    } else {
        $err = "Sub-category Addition Failed! Try again";
        header("Location:../makefo-admin/index.php?id=$page&id=$cat&error=$err");
        exit;
    }

}

//update subcategory

if (isset($_POST['edit_subcategory'])) {
    $page = $_POST['link'];
    $cat = $_POST['cat'];
    $id = $_POST['subcat_id'];
    $subcname = $_POST['subcat_name'];
    $subcdesc = $_POST['subcat_desc'];

    $subcImage = $_FILES['subcat_img']['name'];
    $destination = "../assets/images/subcategory/$subcImage";

    if ($subcImage !== "") {
        $subcImage = $_FILES['subcat_img']['name'];
        $subcatImageTmpName = $_FILES['subcat_img']['tmp_name'];
        move_uploaded_file($subcatImageTmpName, $destination);
    } else {
        $subcImage = $_POST['subcat_img'];
    }

    $query = "UPDATE subcategory SET subcategory_name='$subcname', subcategory_image='$subcImage', subcategory_description='$subcdesc' WHERE id='$id'";
    $stmt = $conn->query($query);
    if ($stmt == true) {
        $sm = "Sub-category was Updated Successfully";
        header("Location:../makefo-admin/index.php?page=$page&id=$cat&success=$sm");
        exit;
    } else {
        $err = "Sub-category Update Failed! Try again";
        header("Location:../makefo-admin/index.php?id=$page&id=$cat&error=$err");
        exit;
    }
}

// delete sub Category 
if (isset($_POST['deleteSubcategory'])) {
    $subcatId = $_POST['subcat_id'];
    $page = $_POST['link'];
    $cat = $_POST['cat'];
    $deleteCat = "DELETE FROM subcategory WHERE id ='$subcatId'";
    $stmt = $conn->query($deleteCat);

    $dlPdt = "DELETE FROM product WHERE subcategory_id='$subcatId'";
    $pdl = $conn->query($dlPdt);

    if ($stmt == true) {
        $sm = "Sub-category was deleted Successfully";
        header("Location:../makefo-admin/index.php?page=$page&id=$cat&success=$sm");
        exit;
    } else {
        $err = "Sub-category Deletion Failed! Try again";
        header("Location:../makefo-admin/index.php?id=$page&id=$cat&error=$err");
        exit;
    }
}



//add product 
if (isset($_POST['add_product'])) {

    $page = $_POST['link'];
    $ent = $_POST['ent'];
    $subcat_id = $_POST['subcat'];
    $cat = $_POST['catId'];

    $pdt_name = $_POST['pdt_name'];
    $pdt_desc = $_POST['pdt_desc'];

    $pdt_image = $_FILES['pdt_image']['name'];
    $destination = "../assets/images/product/$pdt_image";

    if ($ent == 'engineering') {
        $partNum = $_POST['prt_num'];
    } else {
        $partNum = 'None';
    }

    if ($pdt_image !== "") {
        $pdt_image = $_FILES['pdt_image']['name'];
        $pdtImageTmpName = $_FILES['pdt_image']['tmp_name'];
        move_uploaded_file($pdtImageTmpName, $destination);
    } else {
        $pdt_image = $_POST['pdt_image'];
    }

    $query = "INSERT INTO product(part_num, product_name, product_image, product_description, category_id, subcategory_id, bussiness_type, product_status) VALUES('$partNum', '$pdt_name','$pdt_image','$pdt_desc','$cat','$subcat_id','$ent','0')";
    $stmt = $conn->query($query);
    if ($stmt == true) {
        $sm = "Product was added successfully";
        header("location:../makefo-admin/index.php?page=$page&id=$subcat_id&success=$sm");
        exit;

    } else {
        $err = "Product was not Added Try Again!!!";
        header("location:../makefo-admin/index.php?page=$page&id=$subcat_id&error=$err");
        exit;
    }

}

//update product 
if (isset($_POST['edit_product'])) {
    $page = $_POST['link'];
    $ent = $_POST['ent'];
    $subcat_id = $_POST['subcat'];

    if ($ent == 'engineering') {
        $partNum = $_POST['prt_num'];
    } else {
        $partNum = 'None';
    }

    $pdt_name = $_POST['pdt_name'];
    $pdt_id = $_POST['pdt_id'];
    $pdt_desc = $_POST['pdt_desc'];

    $pdt_image = $_FILES['pdt_image']['name'];
    $destination = "../assets/images/product/$pdt_image";


    if ($pdt_image !== "") {
        $pdt_image = $_FILES['pdt_image']['name'];
        $pdtImageTmpName = $_FILES['pdt_image']['tmp_name'];
        move_uploaded_file($pdtImageTmpName, $destination);
    } else {
        $pdt_image = $_POST['pdt_image'];
    }

    $query = "UPDATE product SET part_num='$partNum', product_name='$pdt_name',product_image='$pdt_image', product_description = '$pdt_desc' WHERE id='$pdt_id'";
    $stmt = $conn->query($query);
    if ($stmt == true) {
        $sm = "Product was Updated successfully";
        header("location:../makefo-admin/index.php?page=$page&id=$subcat_id&success=$sm");
        exit;

    } else {
        $err = "Product was not Updated Try Again!!!";
        header("location:../makefo-admin/index.php?page=$page&id=$subcat_id&error=$err");
        exit;
    }

}

//delete product

if (isset($_POST['deleteProduct'])) {
    $pdtId = $_POST['pdt_id'];
    $page = $_POST['link'];
    $subcat_id = $_POST['subcat'];

    $deletePdt = "DELETE FROM product WHERE id ='$pdtId'";
    $stmt = $conn->query($deletePdt);
    if ($stmt == true) {
        $sm = "Product Deleted successfully";
        header("location:../makefo-admin/index.php?page=$page&id=$subcat_id&success=$sm");
        exit;

    } else {
        $err = "Product was not Deleted Try Again!!!";
        header("location:../makefo-admin/index.php?page=$page&id=$subcat_id&error=$err");
        exit;
    }

}


//update username
if (isset($_POST['update_username'])) {
    $uname = $_POST['uname'];
    $link = $_POST['link'];
    $u_id = $_POST['userId'];

    $query = "UPDATE account SET username='$uname' WHERE id='$u_id'";
    $stmt = $conn->query($query);
    if ($stmt == true) {
        $sm = "Username was Updated successfully";
        header("location:../makefo-admin/index.php?id=$link&success=$sm");
        exit;

    } else {
        $err = "Username Update Failed. Try Again!!!";
        header("location:../makefo-admin/index.php?id=$link&error=$err");
        exit;
    }


}

//update Password
if (isset($_POST['update_password'])) {
    $link = $_POST['link'];
    $u_id = $_POST['userId'];
    $str_pass = $_POST['str_pass'];

    $old_pass = $_POST['o_pass'];
    $new_pass = $_POST['n_pass'];
    $cfm_pass = $_POST['cfm_pass'];

    $h_pass = password_hash($new_pass, PASSWORD_BCRYPT);
    if (password_verify($old_pass, $str_pass)) {
        if ($new_pass == $cfm_pass) {
            $query = "UPDATE account SET password='$h_pass' WHERE id='$u_id'";
            $stmt = $conn->query($query);
            if ($stmt == true) {
                $sm = "Password was Updated Successfully";
                header("location:../makefo-admin/index.php?id=$link&success=$sm");
                exit;

            } else {
                $err = "Some thing went Wrong";
                header("location:../makefo-admin/index.php?id=$link&error=$err");
                exit;

            }

        } else {
            $err = "New Password didn't Match";
            header("location:../makefo-admin/index.php?id=$link&error=$err");
            exit;
        }

    } else {
        $err = "Old Password Is Incorrect";
        header("location:../makefo-admin/index.php?id=$link&error=$err");
        exit;
    }

}


//delete message
if (isset($_POST['deleteMsg'])) {
    $msgId = $_POST['msg_id'];
    $deleteMsg = "DELETE FROM message WHERE id ='$msgId'";
    $stmt = $conn->query($deleteMsg);
    if ($stmt == true) {
        $sm = "Message was Deleted Successfully";
        header("location:../makefo-admin/index.php?id=messages&success=$sm");
        exit;
    } else {
        $err = "Message was Not Deleted ";
        header("location:../makefo-admin/index.php?id=messages&error=$err");
        exit;
    }
}

//delete comment
if (isset($_POST['deleteComment'])) {
    $commId = $_POST['comm_id'];
    $deleteComm = "DELETE FROM comment WHERE id ='$commId'";
    $stmt = $conn->query($deleteComm);
    if ($stmt == true) {
        $sm = "Comment was Deleted Successfully";
        header("location:../makefo-admin/index.php?id=comments&success=$sm");
    } else {
        $err = "Comment was Not Deleted";
        header("location:../makefo-admin/index.php?id=comments&error=$err");
    }

}




// ----------------------------------------front submissions-------------------------------


//leave message
if (isset($_POST['send_message'])) {

    $link = $_POST['link'];
    $page=$_POST['page'];

    $senderName = $_POST['sender_name'];
    $senderPhone = $_POST['sender_phone'];
    $msg = $_POST['msg'];


    $query = "INSERT INTO message(sender_name, sender_phone, msg_content, status, importance) VALUES('$senderName', '$senderPhone', '$msg', 'unread', '0')";
    $stmt = $conn->query($query);

    if ($stmt == true) {
        $sm = "Message Sent";
        header("location:../index.php?success=$sm");
    } else {
        $err = "Message Not Sent";
        header("location:../index.php?error=$err");
    }
}

//comment 
if (isset($_POST['comment'])) {
    $link = $_POST['link'];
    $product_id = $_POST['productId'];
    $phone = $_POST['phone'];
    $comment = $_POST['comment_msg'];

    $query = "INSERT INTO comment(commentor_phone, comment_context, product_id,status,like_comment) VALUES('$phone','$comment', '$product_id','new','0')";
    $stmt = $conn->query($query);

    if ($stmt == true) {
        $sm = "Comment Submited";
        header("location:../index.php?success=$sm");
    } else {
        $err = "Comment Not Sent";
        header("location:../index.php?error=$err");
    }


}
?>