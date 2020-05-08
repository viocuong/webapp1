<?php
    class Home extends Controller{
        protected $a;
        function __construct()
        {
            $this->a=$this->requireModel("HomeModel");
        }
        function default(){
    
            
        }
        function show($ho,$ten){
            $this->a->tong($ho,$ten);
        }
    }
?>