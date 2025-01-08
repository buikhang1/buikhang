<?php
include_once '../Controller/connect.php'; 
include_once '../Model/customerDB.php';

$customerDB = new CustomerDB($conn);
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($product_id <= 0) {
    header('Location: list.php');
    exit();
}
$product = $conn->query("SELECT * FROM products WHERE product_id = $product_id")->fetch_assoc();

if (!$product) {
    header('Location: list.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $customerDB->deleteProduct($product_id);

    if ($result) {
        header('Location: list.php?success=1');
        exit();
    } else {
        $error_message = "An error occurred while deleting the product.!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Confirm product deletion</h1>
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Product Name: <?php echo htmlspecialchars($product['product_name']); ?></h5>
            <p class="card-text">Price: <?php echo number_format($product['product_price']. 2); ?> USD</p>
            <p class="card-text">Describe: <?php echo htmlspecialchars($product['product_description']); ?></p>
            <p class="card-text">Manufacturer: <?php echo htmlspecialchars($product['manufacturer']); ?></p>
        </div>
    </div>

    <div class="mt-4">
        <form action="delete.php?id=<?php echo $product_id; ?>" method="POST">
            <button type="submit" class="btn btn-danger">Delete</button>
            <a href="list.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
</body>
</html>