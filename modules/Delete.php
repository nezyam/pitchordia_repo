<?php
class Delete{

    protected $pdo;

    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }


  

    public function deleteplaylist($id){
        
        $errmsg = "";
        $code = 0;
        
        try{
            $sqlString = "DELETE FROM chefs_tbl WHERE id = ?";
            $sql = $this->pdo->prepare($sqlString);
            $sql->execute([$id]);

            $code = 200;
            $data = null;

            return array("data"=>$data, "code"=>$code);
        }
        catch(\PDOException $e){
            $errmsg = $e->getMessage();
            $code = 400;
        }

        
        return array("errmsg"=>$errmsg, "code"=>$code);

    }


    
}

?>