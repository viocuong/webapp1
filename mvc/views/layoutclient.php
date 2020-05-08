<!DOCTYPE html>
<html lang="vi">

<head>
    <?php include_once './includes/header.php'; ?>
</head>
<header style="background-color:#3b3b3b;" class="sticky-top">
    <div class="row d-flex">
        <div class="col">
            <a id="menu" href="#" class="p-1">
                <span id="iconmenu" class="material-icons" style="vertical-align: middle;font-size:50px;">view_headline</span>
            </a>
        </div>
        <form method="POST" class="col d-flex justify-content-end pr-3 pt-2 pb-2" action="http://<?php echo $GLOBALS['HOST']; ?>/webapp/client/search">
            <input id="inp" type="search" name="search">
        </form>
        <!--HIDENT ------------------------------------------------------------------------->
        <!--END HIDENT-->
    </div>
</header>

<body >
    <div id="menuleft" class="menu">
        <div class="h3 pt-5 " style="text-align: center;color:#ffffff;font-family:'Bangers', cursive;">Bán hàng năm châu</div>
        <div class="" style="text-align: center">
            <a class="" href="" style="color:#ffffff;text-decoration: none;"><span style="vertical-align: middle;" class="material-icons">person</span>xin chào <?php echo $_SESSION['user'] ?></a>
        </div>

        <nav class="mt-3">
            <ul class="p-2">
                <li><a href="" class="btn-menu p-3">Doanh thu</a><span style="color: red;font-size: 10px">đang hoàn thiện</span></li>
                <li><a href="" class="btn-menu p-3">Mặt hàng</a><span style="color: red;font-size: 10px"> đang hoàn thiện</span></li>
                <li><a href="http://<?php echo $GLOBALS['HOST']; ?>/webapp/logout" class="btn-menu p-3">Đăng xuất</a></li>
            </ul>
        </nav>

    </div>
    <div class="container-fluid p-0">
        <div class="bg-light rounded bodyadmin">
            <div class="container-fluid">
                <?php include_once './mvc/views/pages/' . $arr['page'] . '.php'; ?>
            </div>
        </div>
    </div>
</body>
<script>
    var count = 1;
    $(document).ready(function() {
        $("#menu").click(function() {
            if (count % 2) {
                $("#iconmenu").text("close");
            } else $("#iconmenu").text("view_headline");
            $("#menuleft").slideToggle();
            count++;
        })
    });
</script>
</html>