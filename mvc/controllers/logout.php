<?php
    class logout extends Controller{
        public function default(){
            if(isset($_SESSION['usernew'])){
                unset($_SESSION['usernew']);
                header("Location:http://{$GLOBALS['HOST']}/webapp1/login");
            }
        }
    }
?>