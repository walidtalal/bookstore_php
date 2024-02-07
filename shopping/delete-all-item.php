<?php include "../includes/header.php" ?>
<?php include "../config/config.php" ?>

<?php

if(!isset($_SESSION['username'])) {
    header("location: ".APPURL."");
}

if(isset($_POST['delete'])) {
//    $id = $_POST['id'];

    $delete = $conn->prepare("DELETE FROM cart where user_id='$_SESSION[user_id]'");
    $delete->execute();
}

?>

<?php include "../includes/footer.php" ?>
