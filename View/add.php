<?php
include_once '../Controller/connect.php';
include_once '../Model/customerDB.php';

$customerDB = new CustomerDB($conn);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product = new stdClass();
    $product->product_name = $_POST['product_name'];
    $product->product_price = $_POST['product_price'];
    $product->product_description = $_POST['product_description'];
    $product->manufacturer = $_POST['manufacturer'];
    $result = $customerDB->addProduct($product);

    if ($result) {
        header('Location: list.php');
        exit();
    } else {
        $error_message = "An error occurred while adding the product!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Add new product</h1>
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form action="add.php" method="POST">
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" class="form-control" id="product_name" name="product_name" required>
        </div>
        <div class="form-group">
            <label for="product_price">Product price</label>
            <input type="number" class="form-control" id="product_price" name="product_price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="product_description">Describe</label>
            <textarea class="form-control" id="product_description" name="product_description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="manufacturer">Manufacturer</label>
            <input type="text" class="form-control" id="manufacturer" name="manufacturer" required>
        </div>
        <button type="submit" class="btn btn-primary">Add product</button>
    </form>

    <a href="list.php" class="btn btn-secondary mt-3">Back to list</a>
</div>
</body>
</html>