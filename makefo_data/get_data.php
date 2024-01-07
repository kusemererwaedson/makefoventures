<?php
//get user
function getUser($conn){
    $query = "SELECT * FROM account";
    $stmt = $conn->query($query);
      $user = $stmt->fetch();
   
    if($stmt==true){
       return $user;
    }else{
        return 0;
    }
}

//get about information
function getAbout($conn){
    $query = "SELECT * FROM about_info";
    $stmt = $conn->query($query);
      $row = $stmt->fetch();
   
    if($stmt==true){
       return $row;
    }else{
        return 0;
    }
}

//get all services
function getServices($conn){
    $query = "SELECT * FROM service";
    $stmt = $conn->query($query);
    $services = $stmt->fetchAll();
   
    if($stmt==true){
       return $services;
    }else{
        return 0;
    }
}

//get service by id
function getServiceById($service_id, $conn){
  $sql = "SELECT * FROM service WHERE id=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$service_id]);

  if($stmt->rowCount()==1){
      $service = $stmt->fetch();
      return $service;
  }else{
      return 0;
  }

}

//get messages
function getMessages($conn){
    $query = "SELECT * FROM message ORDER BY id DESC";
    $stmt = $conn->query($query);
    $messages = $stmt->fetchAll();
    if($stmt==true){
        return $messages;
    }else{
        return 0;
    }
}

//get message by id
function getMessageById($msg_id, $conn){
    $sql = "SELECT * FROM message WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$msg_id]);
  
    if($stmt->rowCount()==1){
        $msg = $stmt->fetch();
        return $msg;
    }else{
        return 0;
    }
  
  }

  //get comments
  function getComments($conn){
    $query = "SELECT * FROM comment ORDER BY id DESC";
    $stmt = $conn->query($query);
    $comments = $stmt->fetchAll();
   
    if($stmt==true){
       return $comments;
    }else{
        return 0;
    }
}

//get comment by id
function getCommentById($comm_id, $conn){
    $sql = "SELECT * FROM comment WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$comm_id]);
  
    if($stmt->rowCount()==1){
        $comm = $stmt->fetch();
        return $comm;
    }else{
        return 0;
    }
  
  }


  //get all categories
function getCategories($conn){
    $query = "SELECT * FROM category ORDER BY id DESC";
    $stmt = $conn->query($query);
    $categories = $stmt->fetchAll();
   
    if($stmt==true){
       return $categories;
    }else{
        return 0;
    }
}

//get category by id
function getCategoryById($category_id, $conn){
    $sql = "SELECT * FROM category WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$category_id]);
  
    if($stmt->rowCount()==1){
        $category = $stmt->fetch();
        return $category;
    }else{
        return 0;
    }
  
  }

//get all subcategories
function getSubcategories($conn){
    $query = "SELECT * FROM subcategory ORDER BY id DESC";
    $stmt = $conn->query($query);
    $subcategories = $stmt->fetchAll();
   
    if($stmt==true){
       return $subcategories;
    }else{
        return 0;
    }
}

function getSubcategoryById($subcategory_id, $conn){
    $sql = "SELECT * FROM subcategory WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$subcategory_id]);
  
    if($stmt->rowCount()==1){
        $subcategory = $stmt->fetch();
        return $subcategory;
    }else{
        return 0;
    }
  
  }

//get all products
function getProducts($conn){
    $query = "SELECT * FROM product ORDER BY id DESC";
    $stmt = $conn->query($query);
    $products = $stmt->fetchAll();
   
    if($stmt==true){
       return $products;
    }else{
        return 0;
    }
}

//get product by id
function getProductById($product_id, $conn){
    $sql = "SELECT * FROM product WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$product_id]);
  
    if($stmt->rowCount()==1){
        $product = $stmt->fetch();
        return $product;
    }else{
        return 0;
    }
  
  }


?>