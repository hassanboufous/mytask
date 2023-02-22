<?php  


class Dbh {
    
    private $dsn = "mysql:host=localhost;dbname=sagidev";
    private $user = "root";
    private $passwd = "";
    
    public function content() {
        $pdo = new PDO($this->dsn, $this->user, $this->passwd);
        return $pdo;
    }
    

}


?>