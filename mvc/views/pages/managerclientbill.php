<div class="row">
    <div class="col-md-3 p-0 d-flex">
        <a href="http://<?php echo $GLOBALS['HOST']; ?>/webapp/client/default/createorder" class="button container p-3 d-flex justify-content-center ">
            <div class="row">
                <div class="col align-self-center">
                    <span class="material-icons">
                        control_point
                    </span>
                    Tạo đơn
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3 p-0 d-flex">
        <a href="http://<?php echo $GLOBALS['HOST']; ?>/webapp/client" class="button container p-3 d-flex justify-content-center ">

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
    <div class="col-md-3 p-0 d-flex">
        <a href="http://<?php echo $GLOBALS['HOST']; ?>/webapp/client/default/unsent" class="button container p-3 d-flex justify-content-center ">

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
    <div class="col-md-3 p-0 d-flex">
        <a href="http://<?php echo $GLOBALS['HOST']; ?>/webapp/client/default/yetpay" class="button container p-3 d-flex justify-content-center ">

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

<div class="row pt-5 ttb">
    <div class="bg-light rounded p-md-2 p-0 container-fluid">
        <div class="col overflow-auto p-0 m-0">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th class="pl-5 pr-5" scope="col">Tài khoản</th>
                        <th class="pl-5 pr-5" scope="col">Id đơn</th>
                        <th class="pl-5 pr-5" scope="col">nội dung</th>
                        <th class="pl-5 pr-5" scope="col">Ngày</th>
                        <th class="pl-5 pr-5" scope="col">giá</th>
                        <th class="pl-5 pr-5" scope="col">Vận chuyển</th>
                        <th class="pl-5 pr-5" scooe="col">Thanh toán</th>
                        <th class="pl-5 pr-5" scope="col">Link facebook</th>
                    </tr>
                </thead>
                <tbody>
                    <script>
                        function setNotices(idNotices, num) {
                            document.getElementById(idNotices).innerHTML = num;
                        }
                    </script>
                    <?php
                    $data = $arr['data'];
                    $numUnsent = $numYetPay = 0;
                    if ($data->num_rows > 0) {
                        while ($row = $data->fetch_assoc()) {
                            $status = [];
                            echo "<tr onclick='clickrow({$row['id_order']})'>";
                            foreach ($row as $key => $value) {
                                if ($key == "status_tranport") {
                                    $colorStatus = "text-danger";
                                    $content = "Chưa gửi";
                                    $check = 0;
                                    if ($value == 2) {
                                        $colorStatus = "text-success";
                                        $content = "Đã gửi";
                                        $check = 1;
                                    }
                                    if ($check == 0) {
                                        $numUnsent++;
                                        array_push($status, 'gửi hàng');
                                    }
                                    echo "<td class={$colorStatus}>$content</td>";
                                } else if ($key == "status_pay") {
                                    $check = 0;
                                    $content = "Chưa thanh toán";
                                    $colorStatus = "text-danger";
                                    if ($value == 2) {
                                        $content = "Đã thanh toán";
                                        $colorStatus = "text-success";
                                        $check = 1;
                                    }
                                    if ($check == 0) {
                                        $numYetPay++;
                                        array_push($status, "nhận tiền");
                                    }
                                    echo "<td class={$colorStatus}>$content</td>";
                                } else if ($key == "link_fb") {
                                    echo "<td><a href='{$value}' target='_blank'>Link face khach</a></td>";
                                } else echo "<td>{$value}</td>";
                            }
                            echo "</tr>";
                            echo "<tr id='option{$row['id_order']}' class='tb_option'><td class='d-flex flex-column'>";
                            
                            echo "<a href='http://{$GLOBALS['HOST']}/webapp/admin/cancel/{$row['id_order']}' class='m-2 btn btn-danger'>Hủy đơn</a>";
                            echo "</td></tr>";
                        }
                    }
                    ?>
                    <script>
                        function clickrow(idorder) {
                            $(document).ready(function() {
                                var s2 = "#option" + idorder;
                                $(s2).toggle();
                            });
                        }
                    </script>
                </tbody>
            </table>
        </div>

    </div>

</div>