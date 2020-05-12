<?php
    class admin extends Controller{
        public $md;
        public $user;
        function __construct()
        {
            $this->md=$this->requireModel('adminModel');
            if(empty($_SESSION['usernew'])){
                header("Location:http://{$GLOBALS['HOST']}/webapp1/login");
            }
            else $user=$_SESSION['usernew'];
            if(!$this->md->isAdmin($user)){
                header("Location:http://{$GLOBALS['HOST']}/webapp1/client");
            }
        }
        public function default($param){
            $Notices=$this->md->getNotices();
            if($param=="") $data=$this->md->getAllListOrder();
            else if($param=="unsent") $data=$this->md->getListUnsent();
            else if($param=="yetpay") $data=$this->md->getListYetPay();
            $this->view('layoutadmin',['page'=>'managerbill','data'=>$data,'notice'=>$Notices]);
        }
        public function send($idOrder){
            $this->md->excute("update tb_order set status_tranport=2 where id_order={$idOrder}");
            header("Location:../../admin");
            
        }
        public function payed($idOrder){
            $this->md->excute("update tb_order set status_pay=2 where id_order={$idOrder}");
            header('Location:../../admin');
        }
        public function cancel($idOrder){
            $this->md->excute("DELETE FROM tb_order where id_order={$idOrder}");
            header('Location:../../admin');
        }
        public function home(){
            if(empty($_SESSION['usernew'])){
                header("Location:../login");
            }
            $data=$this->md->getAllListOrder();
            if(!isset($pram)) $pram="";
            $this->view('layoutadmin',['page'=>'managerbill','data'=>$data]);
        }
        public function search(){
            $str=trim(htmlspecialchars(filter_var($_POST['search'],FILTER_SANITIZE_STRING)));
            $data=$this->md->getSearch($str);
            if(empty($_SESSION['usernew'])){
                header("Location:http://{$GLOBALS['HOST']}/webapp1/login");
            }
            $Notices=$this->md->getNotices();
            $this->view('layoutadmin',['page'=>'managerbill','data'=>$data,'notice'=>$Notices]);
        }   
        public function edit($idOrder){
            if(empty($_SESSION['usernew'])){
                header("Location:http://{$GLOBALS['HOST']}/webapp1/login");
            }
            $data=$this->md->getOrder($idOrder);
            $Notices=$this->md->getNotices();
            $this->view('layoutadmin',['page'=>'manageredit','idorder'=>$idOrder,'notice'=>$Notices,'dataOrder'=>$data]);

        }
        public function editOrder(){
            if (!empty($_POST['contentorder']) && !empty($_POST['price'])) {
                $content = trim($_POST['contentorder']);
                
                $price = trim($_POST['price']);
                $this->md->updateOrder($content, $price, $_POST['iddon']);
                echo "<script>
                    alert('Cập nhật thành công');
                </script>";
                header("Location: http://{$GLOBALS['HOST']}/webapp1/admin");
            }
        }
        public function statistical(){
            $data=[];
            $Notices=$this->md->getNotices();
            $listAccount=$this->md->getListAccount();
            if($listAccount->num_rows>0){
                $i=0;
                while($row=$listAccount->fetch_assoc()){
                    $orders=$this->md->getListOrder($row['userName']);
                    $sumorder = $sent = $paid  = 0;
                    $arr=[];
                    if($orders->num_rows>0){
                        $sumorder=$orders->num_rows;
                        while($order=$orders->fetch_assoc()){
                            if($order['status_tranport']==2) $sent++;
                            if($order['status_pay']==2) $paid++;
                        }
                        $arr['user']=$row['userName'];
                        $arr['sumorder']=$sumorder;
                        $arr['sent']=$sent;
                        $arr['paid']=$paid;
                    }
                    $data[$i]=$arr;
                    $i++;
                    
                }
            }
            $this->view('layoutadmin',['page'=>'managerstatistical','data'=>$data,'notice'=>$Notices]);
        }
    }
?>