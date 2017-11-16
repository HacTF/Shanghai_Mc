<?php
    class sqlhelper{
        private $mysqli;
        private static $host="localhost";
        private static $user="root";
        private static $pwd="";
        private static $db="chart";

        public function  __construct()
        {
            $this->mysqli= new  mysqli(self::$host,self::$user,self::$pwd,self::$db);
            if($this->mysqli->connect_error){
                die("链接失败".$this->mysqli->connect_error);
            }
            $this->mysqli->query("set names utf8");
        }

        public function execute_dql($sql){
            $res=$this->mysqli->query($sql) or die("操作dql".$this->mysqli->error);
            return $res;
        }
        public function execute_dml($sql){
            $res=$this->mysqli->query($sql) or die("操作dql".$this->mysqli->error);
            if(!$res){
                return 0;
            }else{
                if($this->mysqli->affected_rows>0){
                    return 1;
                }else{
                    return 2;
                }
            }
        }
    }
?>