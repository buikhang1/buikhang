<?php
// edit.php
include_once '../Controller/connect.php'; 
include_once '../Model/customerDB.php'; 

$customerDB = new CustomerDB($conn);
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = $customerDB->getProductById($product_id);
if (!$product) {
    header('Location: list.php');
    exit;
}
if (isset($_POST['submit'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $manufacturer = $_POST['manufacturer'];
    $customerDB->updateProduct($product_id, $product_name, $product_price, $product_description, $manufacturer);
    header('Location: list.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Edit product</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="product_name">Pruct name:</label>
            <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $product['product_name']; ?>">
        </div>
        <div class="form-group">
            <label for="product_price">Product price:</label>
            <input type="number" class="form-control" id="product_price" name="product_price" value="<?php echo $product['product_price']; ?>">
        </div>
        <div class="form-group">
            <label for="product_description">describe:</label>
            <textarea class="form-control" id="product_description" name="product_description"><?php echo $product['product_description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="manufacturer">Manufacturer:</label>
            <input type="text" class="form-control" id="manufacturer" name="manufacturer" value="<?php echo $product['manufacturer']; ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Save changes</button>
        <a href="list.php" class="btn btn-secondary">Come back</a>
    </form>
</div>
</body>
</html>