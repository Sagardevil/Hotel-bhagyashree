<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_menu";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// Fetch all orders
$ordersResult = $conn->query("SELECT * FROM orders ORDER BY order_date DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - All Orders | Bhagyashree</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #FFE5B4;
      padding: 20px;
      min-height: 100vh;
    }
    
    header {
      background: #FF7F50;
      color: white;
      text-align: center;
      padding: 30px 20px;
      border-radius: 20px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.2);
      margin-bottom: 40px;
      animation: slideDown 0.5s ease-out;
    }
    
    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    h1 {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 8px;
    }
    
    .subtitle {
      font-size: 1.1rem;
      opacity: 0.9;
    }
    
    .container {
      max-width: 1200px;
      margin: 0 auto;
    }
    
    .order-box {
      background: white;
      border-radius: 20px;
      padding: 30px;
      margin-bottom: 30px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.15);
      transition: all 0.3s ease;
      animation: fadeInUp 0.5s ease-out backwards;
      border-left: 6px solid #FF7F50;
    }
    
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .order-box:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    }
    
    .order-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      padding-bottom: 15px;
      border-bottom: 2px solid #FFE5B4;
      flex-wrap: wrap;
      gap: 15px;
    }
    
    .order-box h2 {
      color: #FF7F50;
      font-size: 1.8rem;
      font-weight: 700;
    }
    
    .order-meta {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
    }
    
    .order-meta p {
      font-size: 1rem;
      color: #555;
      background: #FFF5E6;
      padding: 8px 16px;
      border-radius: 20px;
      margin: 0;
    }
    
    .order-meta strong {
      color: #FF7F50;
      font-weight: 600;
    }
    
    .total-badge {
      background: #FF7F50 !important;
      color: white !important;
      font-size: 1.1rem;
      font-weight: 700;
      padding: 10px 20px !important;
      box-shadow: 0 4px 15px rgba(255, 127, 80, 0.3);
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }
    
    th, td {
      padding: 15px;
      text-align: center;
      font-size: 1rem;
    }
    
    th {
      background: #FF7F50;
      color: white;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    td {
      border-bottom: 1px solid #f0f0f0;
    }
    
    tr:last-child td {
      border-bottom: none;
    }
    
    tr:nth-child(even) {
      background-color: #FFF5E6;
    }
    
    tr:hover {
      background-color: #FFE5B4;
      transition: background-color 0.3s ease;
    }
    
    .no-orders {
      text-align: center;
      padding: 80px 20px;
      color: #666;
      font-size: 1.3rem;
    }
    
    .no-orders-icon {
      font-size: 4rem;
      margin-bottom: 20px;
    }
    
    @media (max-width: 768px) {
      h1 {
        font-size: 2rem;
      }
      
      .order-header {
        flex-direction: column;
        align-items: flex-start;
      }
      
      .order-meta {
        flex-direction: column;
        width: 100%;
      }
      
      .order-meta p {
        width: 100%;
      }
      
      table {
        font-size: 0.9rem;
      }
      
      th, td {
        padding: 10px 8px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <h1>📋 All Customer Orders</h1>
      <p class="subtitle">Hotel Bhagyashree - Admin Dashboard</p>
    </header>

    <?php 
    $orderCount = 0;
    $ordersResult->data_seek(0); // Reset pointer
    while($order = $ordersResult->fetch_assoc()) { 
        $orderCount++;
        $order_id = $order['order_id'];
        $itemsResult = $conn->query("SELECT * FROM order_items WHERE order_id = $order_id");
    ?>
      <div class="order-box" style="animation-delay: <?php echo $orderCount * 0.1; ?>s">
        <div class="order-header">
          <h2>Order #<?php echo $order_id; ?></h2>
          <div class="order-meta">
            <p><strong>📅 Date:</strong> <?php echo $order['order_date']; ?></p>
            <p class="total-badge"><strong>💰 Total:</strong> ₹<?php echo $order['total_amount']; ?></p>
          </div>
        </div>

        <table>
          <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
          </tr>
          <?php while($item = $itemsResult->fetch_assoc()) { ?>
            <tr>
              <td><?php echo $item['item_name']; ?></td>
              <td><?php echo $item['qty']; ?></td>
              <td>₹<?php echo $item['price']; ?></td>
              <td>₹<?php echo $item['qty'] * $item['price']; ?></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    <?php } 
    
    if ($orderCount == 0) {
      echo '<div class="no-orders">';
      echo '<div class="no-orders-icon">📦</div>';
      echo '<p>No orders yet. Waiting for customers!</p>';
      echo '</div>';
    }
    ?>
  </div>
</body>
</html>
<?php $conn->close(); ?>