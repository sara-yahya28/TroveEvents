<?php

require_once 'conn.php';

if(isset($_POST['submit'])){
    $hall_id = $_POST['hall_id'];
    $booking_date = $_POST['booking_date'];

  
        // بدء المعاملة
        $db->beginTransaction();

        // إدخال البيانات في جدول bookhall
        $stmt1 = $db->prepare("INSERT INTO bookhall (hall_id) VALUES (:hall_id)");
        $stmt1->bindParam(':hall_id', $hall_id);
        $stmt1->execute();

        // الحصول على آخر معرف تم إدخاله
        $bookhall_id = $db->lastInsertId();

        // إدخال البيانات في جدول bookings
        $stmt2 = $db->prepare("INSERT INTO bookings (booking_date, totalamount, bookhall_id) VALUES (:booking_date, (SELECT the_price FROM halls WHERE hall_id = :hall_id), :bookhall_id)");
        $stmt2->bindParam(':booking_date', $booking_date);
        $stmt2->bindParam(':hall_id', $hall_id);
        $stmt2->bindParam(':bookhall_id', $bookhall_id);
        $stmt2->execute();
$result = $stmt1->execute() &&  $stmt2->execute();
        // إتمام المعاملة
        if($result){
           echo
            "<script> alert('تم ادخال البيانات بنجاح ' ); </script>";
          header('location: /TROVA2/index.html');
        exit();
        }
         else {
            echo 
            "<script> alert('فشل في إدخال البيانات'); </script>";
        }
    }

?>


