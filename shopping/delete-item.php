<?php include "../includes/header.php" ?>
<?php include "../config/config.php" ?>

<?php

if(isset($_POST['delete'])) {
    $id = $_POST['id'];

    $delete = $conn->prepare("DELETE FROM cart where id='$id'");
    $delete->execute();
}

?>

<?php include "../includes/footer.php" ?>
