<?php 
    class Db extends MySQLi {
        static protected $instance = null;

        public function __construct($host, $user, $password, $schema){
            parent:: __construct($host, $user, $password, $schema);
        }

        static function select($table) {
            $query = "SELECT * FROM $table";
            if($result = $this->query($query)){
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            return [];
        }

        static function selectId($table, $id) {
            $query = "SELECT * FROM $table WHERE `id`= $id";
            if($result = $this->query($query)){
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            return [];
        }

        static function create($table, $nome, $cognome) {
            $query = "INSERT INTO `$table`(`nome`, `cognome`) VALUES ('$nome', '$cognome')";
            if($result = $this->query($query)){
                return "Alunno $nome $cognome creato";
            }
            return "";
        }

        static function update($table, $nome, $cognome ) {
            $query = "UPDATE $table SET `nome`='$nome',`cognome`='$cognome' WHERE `id` = $id";
            if($result = $this->query($query)){
                return "Alunno aggiornato";
            }
            return "";
        }

        static function destroy($table, $id) {
            $query = "DELETE FROM $table WHERE `id` = $id";
            if($result = $this->query($query)){
                return "Alunno $id eliminato";
            }
            return "";
        }

    }
?>