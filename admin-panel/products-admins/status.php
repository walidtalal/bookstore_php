<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>

<?php

if(isset($_GET['id']) and isset($_GET['status'])) {

    $id = $_GET['id'];
    $status = $_GET['status'];

    if($status > 0 ) {
        $update = $conn->prepare("update products set status = 0 where id = :id");
        $update->execute([":id"=>$id,]);
        header("location: ".ADMINURL."/products-admins/show-products.php");
    } else {
        $update = $conn->prepare("update products set status = 1 where id = :id");
        $update->execute([":id"=>$id,]);
        header("location: ".ADMINURL."/products-admins/show-products.php");
    }

}