<div class="row">
    <div class="col-md-4 p-0 d-flex">
        <a href="http://<?php echo $GLOBALS['HOST']; ?>/webapp1/admin" class="button container p-3 d-flex justify-content-center">

            <div class="row">
                <div class="col align-self-center">
                    <span class="material-icons">
                        timeline
                    </span>
                    Tổng đơn
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 p-0 d-flex">
        <a href="http://<?php echo $GLOBALS['HOST']; ?>/webapp1/admin/default/unsent" class="button container p-3 d-flex justify-content-center ">
            <div class="row">
                <div class="col align-self-center">
                    <span class="material-icons">airport_shuttle</span>
                    Đơn chưa gửi
                </div>
                <div class="d-flex">
                    <div id="unsent" class="bg-danger rounded-lg">
                        <?php
                        if ($arr['notice']['usent'] != 0) {
                            echo "
                                    <script>
                                        var element=document.getElementById('unsent');
                                        element.classList.add('p-1');
                                    </script>
                                ";
                            echo $arr['notice']['usent'];
                        }
                        ?>
                    </div>
                </div>
            </div>
        </a>

    </div>
    <div class="col-md-4 p-0 d-flex">
        <a href="http://<?php echo $GLOBALS['HOST']; ?>/webapp1/admin/default/yetpay" class="button container p-3 d-flex justify-content-center ">

            <div class="row">
                <div class="col align-self-center">
                    <span class="material-icons">
                        money_off
                    </span>
                    Đơn chưa trả tiền
                </div>
                <div class="d-flex">
                    <div id="yetpay" class="bg-danger rounded-lg">
                        <?php
                        if ($arr['notice']['upay'] != 0) {
                            echo "
                                    <script>
                                        var element=document.getElementById('yetpay');
                                        element.classList.add('p-1');
                                    </script>
                                ";
                            echo $arr['notice']['upay'];
                        }
                        ?>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
<div style="text-align:center;">


</div>
<div class="container-md container-fluid">
    <?php
    $data=$arr['data'];
    if (count($data)>0) {
        
        for($i=0;$i<count($data);$i++) {
            $salary = $data[$i]['paid']*40000;
            echo "
                <div class='row statistical mt-5 pl-md-5'>
                <div class='col-md-6 mb-2 mt-2'>
                    <p>Tài khoản: {$data[$i]['user']}</p>
                    <p>Tổng số đơn: {$data[$i]['sumorder']}</p>
                    <p>Số đơn đã gửi: {$data[$i]['sent']}<p>
                    <p>Số đơn đã thanh toán: {$data[$i]['paid']}</p>
                    <div style='font-size: 24px'>
                        <span style='color:#384259;' class='material-icons'>monetization_on</span>Doanh thu: {$salary}
                    </div>
                </div>
                <div class='mb-2 col-md-6 align-self-center justify-content-center' >
                    <div class='d-flex justify-content-center' style='text-align: center;'>
                        <a href='' class='btn-pay p-2 w-75 p-md-5'>Trả lương</a>
                    </div>
                </div>
            </div>
            ";
        }
    }
    ?>
</div>