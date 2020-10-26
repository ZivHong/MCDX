<?php
/**
 * 公用头部
 */
?>

<style>
    * {
        font-size: 12px;
    }

    a {
        text-decoration: none;
    }

    .navleft {
        float: left;
        padding: 10px 0px 0px 10px;
    }

    .navright {
        padding: 10px 10px 0px 10px;
        float: right;
    }


</style>


<div class="navleft">
    <a href="ser.php">查詢會員</a>
</div>

<div class="navright">
    <a href="#">擁有人員:<span style="color: red;"><?php echo $_SESSION['admin']['username']; ?><span></a>
    <a href="loginout.php">登出</a>
</div>


