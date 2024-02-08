<?php require "../layouts/header.php" ?>
<?php require "../../config/config.php"; ?>
<?php

if(!isset($_SESSION['adminname'])) {
    header("location: ".ADMINURL."/admins/login-admins.php");
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $select = $conn->prepare('select * from categories where id = :id');
    $select->execute([
        ":id"=>$id,
    ]);

    $images = $select->fetch(PDO::FETCH_OBJ);
    unlink("images/".$images->image."");

    $delete = $conn->prepare("DELETE FROM categories WHERE id = :id");
    $delete->execute([
        ":id" => $id,
    ]);

    header("location: ".ADMINURL."/categories-admins/show-categories.php");

}else {
    header("location: http://localhost/bookstore/404.php");
}
