<?php
require ('../conn.php');
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $paassword = $_POST['paassword'];
    $sql = "select * from customers where email = ? and paassword = ? ";
    $stmtinsert = $db->prepare($sql);
    $stmtinsert ->execute([$email,$paassword]);
    $result = $stmtinsert -> fetch();

   if($result){
    
    echo
     " <script> ('اهلا بك عزيزي المستخدم') </script> ";
     header("Location: /TROVA2/index.html");
             // التحويل إلى صفحة "welcome.php"
              exit(); 
  }
    else{
        echo "<script> alert('فشل في العثور على البيانات'); </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> تسجيل الدخول </title>

    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css\userFormStyle.css">
    <!-- Google Font Link -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body>
  
    <!-- ناف بار -->
    <nav class="navbar">

        <a href="/TROVA2/index.html">
      <img src="image\PHOTO-2024-11-11-16-56-28.jpg" alt="Logo"> <!-- Add your logo image path here -->
       </a> <h2>Trova</h2>
    
  </div>
    
        <ul>
            <li><a href="index.html" class="active">الرئيسية</a></li>
            <li><a href="#portfolio">الخدمات</a></li>
            <li><a href="new.html">من نحن</a></li>
            <li><a href="reciept.html"> الفاتورة</a></li>
            <li><a href="cart1.html"> الحجوزات</a></li>
            <li><a href="usersignin.php" target="_blank" class="cta">تسجيل الدخول</a></li>
        </ul>
    </nav>

  <!-- Main Container -->
  <div class="container">
    <!-- Cover Section -->
    <div class="cover">
      <img src="image\web pic.jpg" alt="Cover Image">
    </div>

    <!-- Forms Section -->
    <div class="forms">
      <div class="form-content">
        <div class="title">مرحبًا بك في تروڤا</div>
       
        <form action="userform.php" method ="POST">
          <div class="input-box">
            <i class="fas fa-user"></i>
            <input type="email" id="email" name="email" placeholder="الإيميل" required="">
          </div>
          <div class="input-box">
            <i class="fas fa-building"></i>
            <input type="password" id="paassword" name="paassword" placeholder="كلمة السر " required="">
          </div>
          <div class="button input-box">
            <input type="submit"  name="submit"  value="تسجيل">
          </div>
        </form>
      </div>
    </div>
  </div>

</body>
</html>