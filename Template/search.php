<?php
// Database connection settings
$servername = "localhost";
$user = "root";
$password = "";
$database = "rentacar";

// Create a database connection
$con = new mysqli($servername, $user, $password, $database);

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Retrieve the search query from the URL
$search = $_GET['search'];

// Perform a SQL query to search for products
$sql = "SELECT * FROM product WHERE item_name LIKE '%$search%'";
$result = $con->query($sql);

// Display the search results dynamically
if ($result->num_rows > 0) {
    while ($item = $result->fetch_assoc()) {
        // Display each search result as a grid-item
        echo '<div class="grid-item ' . ($item['item_brand'] ?? "Brand") . ' border" style="height:auto; width:auto;">';
        echo '<div class="item py-2 " style="width:200px;">';
        echo '<h5 class="margin-left-10 text-blue">' . ($item['item_brand'] ?? "Unknown") . '</h5>';
        echo '<div class="product font-rale">';
        echo '<h6 class="margin-left-10"><b>' . ($item['item_name'] ?? "Unknown") . '</b></h6>';
        echo '<a href="' . sprintf('%s?item_id=%s', 'product.php', $item['item_id']) . '">';
        echo '<img style="width:150px; height:auto;" src="../images/cars/' . $item['item_image'] . '" alt="product1" class="img-fluid padding mx-auto d-block">';
        echo '</a>';
        echo '<div class="margin-left-10 price py-2  d-flex justify-content-between margin-right-10">';
        echo '<span>₱' . ($item['item_price'] ?? 0) . '/day</span>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "<p>No results found.</p>";
}

// Close the database connection
$conn->close();
?>
