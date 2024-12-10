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
                $sqlString= "UPDATE user_tbl SET fname=?, lname=?, contacts=?  WHERE user_id=?";
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
//accountsdetails
    public function patchAccnts($body, $id){ //additional paramiters

        $values=[];
        $errmsg= "";
        $code= 0;

        foreach($body as $value){
        array_push($values, $value);
        }
        array_push($values,$id); 
        
            //modified sql string
        try{
            $sqlString= "UPDATE acct_tbl SET username=?, userpassword=? WHERE acct_id=?";
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

    public function patchPlaylist($body, $id){ //additional paramiters

        $values=[];
        $errmsg= "";
        $code= 0;

        foreach($body as $value){
        array_push($values, $value);
        }
        array_push($values,$id); 
        
            //modified sql string
        try{
            $sqlString= "UPDATE playlist SET user_id=?, p_name=? WHERE playlist_id=?";
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
            $sqlString= "UPDATE user_tbl SET isdeleted=1 WHERE user_id=?";
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

