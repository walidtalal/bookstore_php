<?php //require  "includes/header.php"; ?>
<?php //require  "config/config.php"; ?>
<?php
//
//$select = $conn->query("SELECT * FROM cart WHERE user_id='$_SESSION[user_id]'");
//$select->execute();
//$allProdcuts = $select->fetchAll(PDO::FETCH_OBJ);
////$files = array('readme.txt', 'test.html', 'image.gif');
//$zipname = 'bookstore.zip';
//$zip = new ZipArchive;
//$zip->open($zipname, ZipArchive::CREATE);
//foreach ($allProdcuts as $file) {
//    $zip->addFile("books/" . $file->pro_file);
//}
//$zip->close();
//
//header('Content-Type: application/zip');
//header('Content-disposition: attachment; filename='.$zipname);
////header('Content-Length: ' . filesize($zipname));
//readfile($zipname);
//
//$select = $conn->query("Delete from cart where user_id='$_SESSION[user_id]'");
//$select->execute();
//header("location: index.php");


require "includes/header.php";
require "config/config.php";

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Retrieve cart items for the user
    $select = $conn->prepare("SELECT * FROM cart WHERE user_id = :user_id");
    $select->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $select->execute();
    $allProducts = $select->fetchAll(PDO::FETCH_OBJ);

    // Create a zip file and add each product file to it
    $zipname = 'bookstore.zip';
    $zip = new ZipArchive;
    $zip->open($zipname, ZipArchive::CREATE);

    foreach ($allProducts as $product) {
        $zip->addFile("books/" . $product->pro_file);
    }

    $zip->close();

    // Set headers for downloading the zip file
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename=' . $zipname);
    header('Content-Length: ' . filesize($zipname));

    // Output the zip file
    readfile($zipname);

    // Delete items from the cart after downloading
    $deleteCartItems = $conn->prepare("DELETE FROM cart WHERE user_id = :user_id");
    $deleteCartItems->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $deleteCartItems->execute();


    // Redirect to index.php after completing the download and deletion
//    header("location: index.php");
    header( "refresh:5;URL=". APPURL );

    exit();
} else {

    echo "User ID not found.";
}

