
<?php
require ('conn.php');
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conpass = $_POST['conpass'];

    if($password === $conpass){
        $sql = "INSERT INTO customers (full_name, phone, email, paassword) VALUES (?, ?, ?, ?)";
        $stmtinsert = $db->prepare($sql);
        $result = $stmtinsert->execute([$name, $phone, $email, $password]);

        if($result){
            echo "<script>alert('تم التسجيل بنجاح');</script>";

            header("Location: /TROVA2/index.html");
             // التحويل إلى صفحة "welcome.php"
              exit(); 

            
        } else {
            echo "<script>alert('فشل في إدخال البيانات');</script>";
        }
    }
    else{
      echo "<script>alert('كلمة السر لم تطابق');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
 <link rel="shortcut icon" href="images/PHOTO-2024-11-11-16-56-28.jpg" type="image/x-icon">
    <!-- Google Font Link -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" href="css\userSigninStyle.css">
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
      <div style="display: flex; align-items: center;">
        <a href="index.html">
        <img src="images\PHOTO-2024-11-11-16-56-28.jpg" alt="Logo"> <!-- Add your logo image path here -->
        </a>
        <h2>تروڤا</h2>
    </div>
     
      <ul>
            <li><a href="index" class="active">الرئيسية</a></li>
            <li><a href="#portfolio">الخدمات</a></li>
            <li><a href="new.html">من نحن</a></li>
            <li><a href="reciept.html"> الفاتورة</a></li>
            <li><a href="cart1.html"> الحجوزات</a></li>
            <li><a href="usersignin.php" target="_blank" class="cta">تسجيل الدخول</a></li>
      </ul>
    </div>

    <div class="container">
      <!-- Cover Section -->
      <div class="cover">
        <img src="image\web pic.jpg" alt="Cover Image">
      </div>

      <!-- Forms Section -->
      <div class="forms">
        <div class="title">مرحبًا بك في تروڤا</div>
      
        <!-- Form Fields -->
        <form action="usersignin.php" method="post">
          <!-- Full Name -->
          <div class="input-box">
            <i class="fas fa-user"></i>
            <input type="text" id="name" name="name" placeholder="الاسم الكامل" required>
          </div>
          <!-- Phone Number -->
          <div class="input-box">
            <i class="fas fa-phone"></i>
            <input type="text"  id="phone" name="phone" placeholder="رقم الهاتف" required>
          </div>
          <!-- Email -->
          <div class="input-box">
            <i class="fas fa-envelope"></i>
            <input type="email"id="email" name="email" placeholder="الايميل" required>
          </div>
          <!-- Password -->
          <div class="input-box">
            <i class="fas fa-lock"></i>
            <input type="password" id="password" name="password" placeholder="كلمة السر" required>
          </div>
          <!-- Confirm Password -->
          <div class="input-box">
            <i class="fas fa-lock"></i>
            <input type="password"id="conpass" name="conpass" placeholder="تأكيد كلمة السر" required>
          </div>

          <div class="flex items-center mb-4">
            <input id="terms-checkbox" type="checkbox" required class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
            <label for="terms-checkbox" class="ms-2 text-sm font-medium text-gray-900">
                أوافق على <a href="terms.html" class="text-blue-600 hover:underline">الأحكام والشروط</a>
            </label>
        </div>
          <!-- Submit Button -->
          <div class="button input-box">
            <input type="submit"  name="submit"  value="تسجيل">
          </div>
        </form>

        <!-- Footer Links -->
        <div class="footer">
          <p>هل لديك حساب مسبقًا؟ <a href="sign in/userform.php">تسجيل دخول</a></p>
        </div>
      </div>
    </div>
</body>
</html>
