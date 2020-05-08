<?php
    class login extends Controller{
        protected $user;
        protected $password;
        function default(){
            $error="";
            if($_SERVER['REQUEST_METHOD']=='POST'){
                if(isset($_POST)){
                    $error="";
                    $username=Functions::filter($_POST['user']);
                    $password=md5(Functions::filter($_POST['pass']));
                    $md=$this->requireModel("loginModel");
                    $resutl=$md->getAccount($username,$password);
                    if(!empty($resutl)){
                        $arr=$md->getData($username,$password);
                        $lever=$arr['lever'];
                        $_SESSION['user']=$username;
                        if($lever==1){
                            header('Location: admin');
                        }
                        else header('Location: client');
                    }
                    else $error="Thông tin tài khoản hoặc mật khẩu không chính xác";
                }
            }
            $this->view("layoutlogin",['error'=>$error]);
            
        }
    }
