<?php 
    class Db extends MySQLi {
        static protected $instance = null;

        public function __construct($host, $user, $password, $schema){
            parent:: __construct($host, $user, $password, $schema);     
        }

        public static function getInstance($host, $user, $password, $schema) {
            if (self::$instance === null) {
                self::$instance = new Db($host, $user, $password, $schema);
            }
            return self::$instance;
        }

        public function select($table, $where = 1) {
            $query = "SELECT * FROM $table WHERE $where";
            if($result = $this->query($query)){
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            return [];
        }

        public function selectId($table, $id) {
            return $this->select($table,"id=$id");
        }

        public function create($table, array $data) {
            $fields = implode(", ",array_keys($data)); 
            $values = "'".implode("', '",array_values($data))."'";    
            $query = "INSERT INTO `$table` ($fields) VALUES ($values)";
            if($result = $this->query($query)){
                return true;
            }
            return false;
        }

        public function update($table, array $data, $where) {
            $set=[];
            foreach($data as $key=>$value){
                $set[]="`". $key . "`= '" .$value . "'";
            }
            $fields = implode(",",$set);
            $query = "UPDATE $table SET $fields WHERE $where";
            if($result = $this->query($query)){
                return true;
            }
            return false;
        }

        public function destroy($table, $id) {
            $query = "DELETE FROM $table WHERE `id` = $id";
            if($result = $this->query($query)){
                return true;
            }
            return false;
        }

    }
?>