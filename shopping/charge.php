<?php include "../includes/header.php" ?>
<?php include "../config/config.php" ?>
<?php require  "../vendor/autoload.php"; ?>

<?php

\Stripe\Stripe::setApiKey($secret_key);


$charge = \Stripe\Charge::create([
    'source' => $_POST['stripeToken'],
    'amount' => $_SESSION['price'] * 100,
    'currency' => 'usd',
]);
echo "Done";

?>

<?php include "../includes/footer.php" ?>
