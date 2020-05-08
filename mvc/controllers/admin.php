<?php
    class admin extends Controller{
        public $md;
        public $user;
        function __construct()
        {
            $this->md=$this->requireModel('adminModel');
            if(empty($_SESSION['user'])){
                header("Location:http://{$GLOBALS['HOST']}/webapp/login");
            }
            else $user=$_SESSION['user'];
            if(!$this->md->isAdmin($user)){
                header("Location:http://{$GLOBALS['HOST']}/webapp/client");
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
            if(empty($_SESSION['user'])){
                header("Location:../login");
            }
            $data=$this->md->getAllListOrder();
            if(!isset($pram)) $pram="";
            $this->view('layoutadmin',['page'=>'managerbill','data'=>$data]);
        }
        public function search(){
            $str=trim(htmlspecialchars(filter_var($_POST['search'],FILTER_SANITIZE_STRING)));
            $data=$this->md->getSearch($str);
            if(empty($_SESSION['user'])){
                header("Location:http://{$GLOBALS['HOST']}/webapp/login");
            }
            $Notices=$this->md->getNotices();
            $this->view('layoutadmin',['page'=>'managerbill','data'=>$data,'notice'=>$Notices]);
        }   
    }
?>