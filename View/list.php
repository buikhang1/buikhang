<?php
include_once '../Controller/connect.php'; 
include_once '../Model/customerDB.php'; 

$customerDB = new CustomerDB($conn);
$limit = 3; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$products = $customerDB->getAllProducts($offset, $limit);

$totalProducts = $conn->query("SELECT COUNT(*) FROM products")->fetch_row()[0];
$totalPages = ceil($totalProducts / $limit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Product List</h1>
    <a href="add.php" class="btn btn-primary mb-3">Add new product</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Product price</th>
                <th>Describe</th>
                <th>Manufacturer</th>
                <th>Act</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['product_id']; ?></td>
                    <td><?php echo $product['product_name']; ?></td>
                    <td><?php echo number_format($product['product_price']. 2); ?> USD  </td>
                    <td><?php echo $product['product_description']; ?></td>
                    <td><?php echo $product['manufacturer']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $product['product_id']; ?>" class="btn btn-warning">edit</a>
                        <a href="delete.php?id=<?php echo $product['product_id']; ?>" class="btn btn-danger">delete</a>
                        <a href="view.php?id=<?php echo $product['product_id']; ?>" class="btn btn-info">detail</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <nav>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>
</body>
</html>