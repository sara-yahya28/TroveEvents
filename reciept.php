<?php
$conn = new mysqli("localhost", "root", "", "your_db");
if ($conn->connect_error) {
  die("DB failed");
}

$orderId = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM orders WHERE id=?");
$stmt->bind_param("i", $orderId);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

$reservation = json_decode($order['reservation_details'], true);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>مولد الإيصال المدمج</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- FontAwesome for icons -->
  <link rel="stylesheet" href="navbar.css">
  <style>
     /* Global Styles */
     * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #A5B7D6;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      text-align: right;
      direction: ltr;
    }

    .navbar {
        background-color: #bc87b8;
        color: white;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        position: fixed;
        top: 0;
        z-index: 100;
      }

      .navbar h2 {
        margin-left: 20px; /* تعديل المحاذاة */
        font-size: 24px;
      }

      .navbar ul {
        list-style: none;
        display: flex;
        gap: 20px;
        margin-right: 20px; /* تعديل المحاذاة */
      }

      .navbar ul li {
        display: inline;
      }

      .navbar ul li a {
        color: #fff;
        text-decoration: none;
        font-size: 16px;
      }

      .navbar ul li a:hover {
        color: #ddd;
      }
      .navbar img {
  width: 40px; /* Adjust size as needed */
  height: 40px; /* Adjust size as needed */
  border-radius: 50%;
  margin-left: 20px;
    }

    .container {
      width: 300px;
      background-color: #ffffff;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      padding: 20px;
    }

    /* Receipt Section Styles */
    #invoice-POS {
      padding: 10px;
      background-color: #FFF;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      font-size: 0.8em;
    }

    .logo {
      background-image: url('./logo.jpg'); /* Use a relative path */
      height: 100px; /* Adjust logo height */
      width: 100px; /* Adjust logo width */
      background-size: contain;
      background-position: center;
      background-repeat: no-repeat;
      margin: 0 auto;
    }

    #invoice-POS h2, #invoice-POS h3, #invoice-POS p {
      color: #444;
    }

    .tabletitle {
      background: #BDAACF;
      color: #FFF;
    }

    .itemtext {
      color: #666;
    }

    table {
      width: 100%;
    }
  </style>
</head>
<body>
 
  <nav class="navbar">
    <ul>
        <li><a href="usersignin.php" target="_blank" class="cta">تسجيل الدخول</a></li>
        <li><a href="cart1.html"> الحجوزات</a></li>
        <li><a href="new.html">من نحن</a></li>
        <li><a href="index.html">الخدمات</a></li>
        <li><a href="index.html" class="active">الرئيسية</a></li>
        <!-- check last link if downloading -->
    </ul>
    <div style="display: flex; align-items: center;">
        <h3>Trova palaces</h3>
        <a href="index.html">
            <img src="logo.jpg" alt="Logo"> <!-- Add your logo image path here -->
        </a>
    </div>
</nav>

  <div class="container">
    <!-- Receipt Section -->
    <div id="invoice-POS">
      <center id="top">
        <div class="logo"></div>
        <div class="info">
        </div>
      </center>
  
      <div id="mid">
        <div class="info">
          <h3>معلومات الاتصال</h3>
          <p>العنوان: عدن، اليمن<br>البريد الإلكتروني: admin@gmail.com<br>الهاتف: *******77</p>
        </div>
      </div>

      <hr>    <div id="bot">
        <div id="user-info">
          <h3>معلومات المستخدم</h3>
<p>الاسم: <?php echo htmlspecialchars($order['customer_name']); ?></p>
<p>الرقم التعريفي: <?php echo $order['id']; ?></p>
<p>تاريخ الحجز: <?php echo date("Y-m-d", strtotime($order['created_at'])); ?></p>

        </div>
  
        <div id="table">
          <table>
            <tr class="tabletitle">
              <td class="item"><h3>اسم القاعة</h3></td>
              <td class="Rate"><h3>السعر</h3></td>
            </tr>
            <tr class="service">
              <td class="tableitem">. <p class="itemtext"></p></td>
              <td class="tableitem"> .<p class="itemtext"></p></td>
            </tr>
  
            <tr class="tabletitle">
              <td class="item"><h3>اسم الطبق</h3></td>
              <td class="Rate"><h3>السعر</h3></td>
              <td class="Rate"><h3>الكمية</h3></td>
            </tr>
<tr class="service">
  <td><?php echo $reservation[0]['name']; ?></td>
  <td><?php echo $reservation[0]['price']; ?></td>
</tr>

  
            <tr class="tabletitle">
              <td></td>
              <td class="Rate"><h3>الإجمالي</h3></td>
              <td class="payment">.<h3></h3></td>
            </tr>
          </table>
        </div>
  <hr>
        <div id="legalcopy">
          <p class="legal"><strong>شكراً لتعاملتك معنا!</strong> الدفع مطلوب في غضون 15 يومًا؛ يرجى معالجة هذه الفاتورة خلال تلك الفترة. سيتم فرض رسوم فائدة بنسبة 10% شهريًا على الفواتير المتأخرة.</p>
        </div>
      </div>
    </div>
  </div>
  
  </body>
  </html>
