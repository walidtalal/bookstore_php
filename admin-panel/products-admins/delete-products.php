<?php
require "../layouts/header.php";
require "../../config/config.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $select = $conn->prepare("SELECT * FROM products WHERE id = :id");
    $select->execute([
        ":id" => $id,
    ]);

    $product = $select->fetch(PDO::FETCH_OBJ);

    if ($product) {
        // Delete image
        unlink("images/" . $product->image);

        // Delete file
        unlink("books/" . $product->file);

        // Delete record from database
        $delete = $conn->prepare("DELETE FROM products WHERE id = :id");
        $delete->execute([
            ":id" => $id,
        ]);

        header("location: " . ADMINURL . "/products-admins/show-products.php");
    } else {
        echo "<script>alert('Product not found')</script>";
        header("location: " . ADMINURL . "/products-admins/show-products.php");
    }

} else {
    header("location: http://localhost/bookstore/404.php");
}
?>
