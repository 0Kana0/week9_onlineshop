<?php
    session_start();
    $i=$_GET['id'];
    echo $i;
    if(isset($_SESSION['cart'])){
        array_splice($_SESSION['cart'],$i-1,1);
    }
?>
<script>
    window.alert("นำสินค้าออกจากตระกร้าเรียบร้อยแล้ว");
    window.location.replace("cart_page.php");
</script>