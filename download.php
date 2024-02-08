<?php ////require  "includes/header.php"; ?>
<?php ////require  "config/config.php"; ?>
<?php
////
////$select = $conn->query("SELECT * FROM cart WHERE user_id='$_SESSION[user_id]'");
////$select->execute();
////$allProdcuts = $select->fetchAll(PDO::FETCH_OBJ);
//////$files = array('readme.txt', 'test.html', 'image.gif');
////$zipname = 'bookstore.zip';
////$zip = new ZipArchive;
////$zip->open($zipname, ZipArchive::CREATE);
////foreach ($allProdcuts as $file) {
////    $zip->addFile("books/" . $file->pro_file);
////}
////$zip->close();
////
////header('Content-Type: application/zip');
////header('Content-disposition: attachment; filename='.$zipname);
//////header('Content-Length: ' . filesize($zipname));
////readfile($zipname);
////
////$select = $conn->query("Delete from cart where user_id='$_SESSION[user_id]'");
////$select->execute();
////header("location: index.php");
//
//
//require "includes/header.php";
//require "config/config.php";
//
//if (isset($_SESSION['user_id'])) {
//    $user_id = $_SESSION['user_id'];
//
//    // Retrieve cart items for the user
//    $select = $conn->prepare("SELECT * FROM cart WHERE user_id = :user_id");
//    $select->bindParam(':user_id', $user_id, PDO::PARAM_INT);
//    $select->execute();
//    $allProducts = $select->fetchAll(PDO::FETCH_OBJ);
//
//    // Create a zip file and add each product file to it
//    $zipname = 'bookstore.zip';
//    $zip = new ZipArchive;
//    $zip->open($zipname, ZipArchive::CREATE);
//
//    foreach ($allProducts as $product) {
//        $zip->addFile("books/" . $product->pro_file);
//    }
//
//    $zip->close();
//
//    // Set headers for downloading the zip file
//    header('Content-Type: application/zip');
//    header('Content-Disposition: attachment; filename=' . $zipname);
//    header('Content-Length: ' . filesize($zipname));
//
//    // Output the zip file
//    readfile($zipname);
//
//    // Delete items from the cart after downloading
//    $deleteCartItems = $conn->prepare("DELETE FROM cart WHERE user_id = :user_id");
//    $deleteCartItems->bindParam(':user_id', $user_id, PDO::PARAM_INT);
//    $deleteCartItems->execute();
//
//
//    // Redirect to index.php after completing the download and deletion
////    header("location: index.php");
//    header( "refresh:5;URL=". APPURL );
//
//    exit();
//} else {
//
//    echo "User ID not found.";
//}
//


<?php require  "includes/header.php"; ?>
<?php require  "config/config.php"; ?>

<?php



    if(!isset($_SERVER['HTTP_REFERER'])){
        // redirect them to your desired location
        header('location: index.php');
        exit;
    }


    $select = $conn->query("SELECT * FROM cart WHERE user_id='$_SESSION[user_id]'");
    $select->execute();
    $allProdcuts = $select->fetchAll(PDO::FETCH_OBJ);


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'src/Exception.php';
    require 'src/PHPMailer.php';
    require 'src/SMTP.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'german.lang77@gmail.com';                     //SMTP username
        $mail->Password   = 'nftjsrjpaeojbbzx';                               //SMTP password
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //sender
        $mail->setFrom('hsn42476@gmail.com', 'user');

        //Add a recipient
        $mail->addAddress("german.lang77@gmail.com", 'Bookstore');


        foreach($allProdcuts as $products) {
            $path  = 'admin-panel/products-admins/books';
            //$file = $products->pro_file;

            for($i=0; $i < count($allProdcuts); $i++) {

                $mail->addAttachment($path . "/" . $products->pro_file);         //Add attachments

            }
        }





        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'the books you bought';
        $mail->Body    = 'here are you books you paid '.$_SESSION['price'].'$ <b>thanks for buying from Bookstore</b>';
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();

        //delete cart items after sending products
        $select = $conn->query("DELETE FROM cart WHERE user_id='$_SESSION[user_id]'");
        $select->execute();

        header("location: success.php");


    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }


