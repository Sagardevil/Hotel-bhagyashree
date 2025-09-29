<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "hotel_menu";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$order_id = intval($_GET['order_id']);

// Fetch order
$orderResult = $conn->query("SELECT * FROM orders WHERE order_id = $order_id");
$order = $orderResult->fetch_assoc();

// Fetch items
$itemsResult = $conn->query("SELECT * FROM order_items WHERE order_id = $order_id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Summary - Bhagyashree Restaurant</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #FFE5B4;
      padding: 40px 20px;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .summary {
      background: white;
      padding: 40px;
      border-radius: 20px;
      max-width: 700px;
      width: 100%;
      box-shadow: 0 10px 40px rgba(0,0,0,0.2);
      animation: slideUp 0.6s ease-out;
    }
    
    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .success-icon {
      text-align: center;
      font-size: 80px;
      margin-bottom: 20px;
      animation: bounceIn 0.8s ease-out;
    }
    
    @keyframes bounceIn {
      0% { transform: scale(0); }
      50% { transform: scale(1.2); }
      100% { transform: scale(1); }
    }
    
    h1 {
      text-align: center;
      color: #FF7F50;
      font-size: 32px;
      margin-bottom: 10px;
    }
    
    .restaurant-name {
      text-align: center;
      color: #666;
      font-size: 18px;
      margin-bottom: 30px;
      font-style: italic;
    }
    
    .order-info {
      background: #FFF5E6;
      padding: 20px;
      border-radius: 12px;
      margin-bottom: 25px;
      border-left: 4px solid #FF7F50;
    }
    
    .order-info p {
      font-size: 16px;
      margin: 8px 0;
      color: #333;
    }
    
    .order-info strong {
      color: #FF7F50;
      font-weight: 600;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    th, td {
      padding: 15px;
      text-align: center;
      font-size: 15px;
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
    
    .total {
      text-align: right;
      font-size: 24px;
      margin-top: 25px;
      padding: 20px;
      background: #FFF5E6;
      border-radius: 12px;
      color: #333;
      font-weight: bold;
    }
    
    .total span {
      color: #FF7F50;
      font-size: 28px;
    }
    
    .back {
      display: block;
      margin: 30px auto 0;
      padding: 15px 40px;
      background: #FF7F50;
      color: white;
      border: none;
      border-radius: 50px;
      text-decoration: none;
      text-align: center;
      font-size: 18px;
      font-weight: 600;
      box-shadow: 0 8px 20px rgba(255, 127, 80, 0.4);
      transition: all 0.3s ease;
      cursor: pointer;
      max-width: 250px;
    }
    
    .back:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 30px rgba(255, 127, 80, 0.6);
      background: #ff6347;
    }
    
    .back:active {
      transform: translateY(-1px);
    }
    
    .thank-you {
      text-align: center;
      margin-top: 25px;
      color: #666;
      font-size: 16px;
      line-height: 1.6;
    }
    
    .divider {
      height: 2px;
      background: linear-gradient(to right, transparent, #FF7F50, transparent);
      margin: 25px 0;
    }
  </style>
</head>
<body>
  <div class="summary">
    <div class="success-icon">✅</div>
    <h1>Order Placed Successfully!</h1>
    <div class="restaurant-name">Bhagyashree Restaurant</div>
    
    <div class="order-info">
      <p><strong>Order ID:</strong> #<?php echo $order['order_id']; ?></p>
      <p><strong>Order Date:</strong> <?php echo $order['order_date']; ?></p>
    </div>

    <div class="divider"></div>

    <table>
      <tr>
        <th>Item</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Total</th>
      </tr>
      <?php while($row = $itemsResult->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $row['item_name']; ?></td>
          <td><?php echo $row['qty']; ?></td>
          <td>₹<?php echo $row['price']; ?></td>
          <td>₹<?php echo $row['qty'] * $row['price']; ?></td>
        </tr>
      <?php } ?>
    </table>

    <div class="total">
      Grand Total: <span>₹<?php echo $order['total_amount']; ?></span>
    </div>

    <div class="thank-you">
      🙏 Thank you for your order!<br>
      Your delicious meal will be prepared with care.
    </div>

    <a href="index.html" class="back">⬅ Back to Menu</a>
  </div>
</body>
</html>
<?php $conn->close(); ?>