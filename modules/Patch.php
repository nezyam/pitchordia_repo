<?php
class Patch{
        protected $pdo;
        public function __construct(\PDO $pdo){
            $this->pdo = $pdo;
        }
    
    //to edit posting to database
        public function patchUsers($body, $id){ //additional paramiters

            $values=[];
            $errmsg= "";
            $code= 0;
    
            foreach($body as $value){
            array_push($values, $value);
            }
            array_push($values,$id); 
            
                //modified sql string
            try{
                $sqlString= "UPDATE users SET username=?, userpassword=?, emailadd=? WHERE users_id=?";
                $sql = $this ->pdo-> prepare($sqlString); //protect sql injection 
                $sql-> execute($values);
    
                $code =200;
                $data = null;
    
                return array("data" =>$data, "code" => $code);
            }   
            catch (\PDOException $e){
                $errmsg = $e ->getMessage();
                $code = 400;
    
            }
            return array( "errmsg"=>$errmsg, "code" => $code);
        }

//archiving DATA
      public function arcUsers($id){ //additional paramiters
       
        $errmsg= "";
        $code= 0;
        
            //modified sql string
        try{
            $sqlString= "UPDATE users SET isdeleted=1 WHERE users_id=?";
            $sql = $this ->pdo-> prepare($sqlString); //protect sql injection 
            $sql-> execute([$id]);

            $code =200;
            $data = null;

            return array("data" =>$data, "code" => $code);
        }
        catch (\PDOException $e){
            $errmsg = $e ->getMessage();
            $code = 400;

        }
        return array( "errmsg"=>$errmsg, "code" => $code);
    }
}
    
    ?>                                                                  

    protected $pdo;

    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }


    public function patchChefs($body, $id){
        $values = [];
        $errmsg = "";
        $code = 0;


        foreach($body as $value){
            array_push($values, $value);
        }

        array_push($values, $id);
        
        try{
            $sqlString = "UPDATE chefs_tbl SET fname=?, lname=? WHERE id = ?";
            $sql = $this->pdo->prepare($sqlString);
            $sql->execute($values);

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

    public function archiveChefs($id){
        
        $errmsg = "";
        $code = 0;
        
        try{
            $sqlString = "UPDATE chefs_tbl SET isdeleted=1 WHERE id = ?";
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
