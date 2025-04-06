<?php 
    class Db extends MySQLi {
        static protected $instance = null;

        public function __construct($host, $user, $password, $schema){
            parent:: __construct($host, $user, $password, $schema);
        }

        static function select($table, $where = 1) {
            $query = "SELECT * FROM $table WHERE $where";
            if($result = $this->query($query)){
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            return [];
        }

    }
?>