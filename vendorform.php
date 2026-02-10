<?php
require ('../conn.php');

if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $company = $_POST['company'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  $location = $_POST['location'];
  $services_type = $_POST['services_type'];

  $sql = "INSERT INTO service_providers (service_providersName, phoneNumber, Email, servicedesc, Locationn, service_id) VALUES (?, ?, ?, ?, ?, ?)";
 
  $stmtinsert = $db->prepare($sql);
  $result = $stmtinsert->execute([$name, $company, $email, $message, $location, $services_type]);
  
  if($result){
      echo "<script> alert(' , تم ادخال البيانات بنجاح انتظر رسالة من الموقع' ); </script>";

      header("Location:/theApprovedTrova/index.html");
             // التحويل إلى صفحة "welcome.php"
              exit(); 

  } else {
      echo "<script> alert('فشل في إدخال البيانات'); </script>";
  }
}

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>Vendor Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="navbar.css">  -->
  <!-- Fontawesome CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  
  <!-- Google Font Link -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #A5B7D6;
      padding: 30px;
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
      margin-left: 20px;
      font-size: 24px;
    }

    .navbar ul {
      list-style: none;
      display: flex;
      gap: 20px;
      margin-right: 20px;
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

    .container {
      max-width: 850px;
      width: 100%;
      background: #fff;
      padding: 40px 30px;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
      display: flex;
      flex-direction: row-reverse;
    }

    .cover {
      width: 45%;
      display: flex;
      align-items: right;
      justify-content: center;
      padding: 20px;
      text-align: center;
    }

    .cover img {
      width: 100%;
      height: auto;
      max-width: 300px;
      border-radius: 10px;
      object-fit: cover;
    }

    .forms {
      width: 55%;
      padding: 30px;
    }

    .forms .form-content .title {
      font-size: 24px;
      font-weight: 500;
      color: #BC87B8;
      margin-bottom: 10px;
      text-align: right;
    }

    .forms .form-content .input-box {
      display: flex;
      align-items: center;
      height: 50px;
      margin: 15px 0;
      position: relative;
    }

    .input-box input,
    .input-box select,
    .input-box textarea {
      height: 100%;
      width: 100%;
      outline: none;
      border: none;
      padding: 0 40px;
      font-size: 16px;
      font-weight: 500;
      border-bottom: 2px solid rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease;
      text-align: right;
    }

    .input-box select {
      appearance: none;
      background: transparent;
      padding: 0 40px;
      font-size: 16px;
      font-weight: 500;
      color: #555;
    }

    .input-box input[type="file"] {
      padding: 0 40px;
      height: 100%;
      font-size: 16px;
      font-weight: 500;
      color: #555;
    }

    .input-box textarea {
      height: 80px;
      padding: 10px 40px;
      resize: none;
    }

    .input-box input:focus,
    .input-box select:focus,
    .input-box textarea:focus {
      border-color: #BC87B8;
    }

    .input-box i {
      position: absolute;
      color: #BC87B8;
      font-size: 17px;
      right: 10px;
    }

    .button input {
      color: #fff;
      background: #BC87B8;
      border-radius: 6px;
      cursor: pointer;
      transition: all 0.4s ease;
      height: 50px;
      width: 100%;
      font-size: 16px;
      font-weight: 500;
      border: none;
      text-align:center;

    }

    .button input:hover {
      background: #BDAAFC;
    }

    @media (max-width: 730px) {
      .container {
        flex-direction: column;
      }

      .cover,
      .forms {
        width: 100%;
      }

      .cover img {
        max-width: 250px;
      }
    }
    .navbar img {
  width: 40px; /* Adjust size as needed */
  height: 40px; /* Adjust size as needed */
  border-radius: 50%;
  margin-left: 20px;
    }

  </style>
</head>


<body>
  <div class="navbar">
  <div style="display: flex; align-items: center;">
        <a href="/TROVA2/index.html">
      <img src="PHOTO-2024-11-11-16-56-28.jpg" alt="Logo"> <!-- Add your logo image path here -->
       </a> <h2>Trova</h2>
    
  </div>
    <h2></h2>
    <ul>
      <li><a href="/TROVA2/index.html">الرئيسية</a></li>
      <li><a href="#">حول</a></li>
      <li><a href="/TROVA2/index.html">خدمات</a></li>
      <li><a href="userform.PHP">تسجيل الدخول</a></li>
    </ul>
  </div>
  <div class="container">
    <div class="cover">
      <img src="download.jpg" alt="Cover Image">
    </div>
    <div class="forms">
      <div class="form-content">
        <div class="title">مرحبًا بك في تروڤا</div>
        <form action="vendorform.php" method="POST" enctype="multipart/form-data">
          <div class="input-box">
            <i class="fas fa-user"></i>
            <input type="text" id="name" name="name" placeholder="الاسم الكامل" required>
          </div>
          <div class="input-box">
            <i class="fas fa-map-marker-alt"></i>
            <input type="text" id="location" name="location" placeholder="الموقع" required>
          </div>
          <div class="input-box">
            <i class="fas fa-building"></i>
            <input type="text" id="company" name="company" placeholder="رقم الشركة" required>
          </div>
          <div class="input-box">
            <i class="fas fa-envelope"></i>
            <input type="email" id="email" name="email" placeholder="البريد الإلكتروني" required>
          </div>
          <div class="input-box">
            <i class="fas fa-cogs"></i>
            <select id="services_type" name="services_type" required>
              <option value="" disabled selected>اختر نوع الخدمة</option>
              <option value="1">قاعات</option>
              <option value="2">مأكولات</option>
            </select>
          </div>
          <div class="input-box">
            <i class="fas fa-info-circle"></i>
            <textarea name="message" placeholder="وصف الخدمة" required></textarea>
          </div><br>
          <div class="input-box">
            <i class="fas fa-upload"></i>
            <input type="file" name="file" accept="image/*,video/*,.pdf,.doc,.docx" required>
          </div>
          <div class="button input-box">
            <input type="submit" name="submit" value="تسجيل">
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
