<?php
include_once '../Controller/connect.php'; 
include_once '../Model/customerDB.php'; 

$customerDB = new CustomerDB($conn);

// Get product ID from URL
if (!isset($_GET['id'])) {
    header("Location: list.php");
    exit();
}
$product_id = (int)$_GET['id'];
$product = $customerDB->getProductById($product_id);

// If product not found, redirect to list
if (!$product) {
    header("Location: list.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - <?php echo htmlspecialchars($product['product_name']); ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .detail-card {
            margin-top: 30px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .detail-section {
            margin-bottom: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <a href="list.php" class="btn btn-secondary mt-3">← Back to Product List</a>
    
    <div class="detail-card">
        <h1 class="mb-4"><?php echo htmlspecialchars($product['product_name']); ?></h1>
        
        <div class="row">
            <div class="col-md-6">
                <div class="detail-section">
                    <h5>Basic Information</h5>
                    <p><strong>Product ID:</strong> <?php echo $product['product_id']; ?></p>
                    <p><strong>Price:</strong> <?php echo number_format($product['product_price'], 2); ?> USD</p>
                    <p><strong>Manufacturer:</strong> <?php echo htmlspecialchars($product['manufacturer']); ?></p>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="detail-section">
                    <h5>Product Description</h5>
                    <p><?php echo nl2br(htmlspecialchars($product['product_description'])); ?></p>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <a href="edit.php?id=<?php echo $product['product_id']; ?>" class="btn btn-warning btn-block">Edit Product</a>
            </div>
            <div class="col-md-6">
                <a href="delete.php?id=<?php echo $product['product_id']; ?>" class="btn btn-danger btn-block">Delete Product</a>
            </div>
        </div>
    </div>
</div>
</body> 
</html>
