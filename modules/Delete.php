<?php
class Delete{
        protected $pdo;
        public function __construct(\PDO $pdo){
            $this->pdo = $pdo;
        }
    
    //to edit posting to database
        
 //archiving DATA
 public function archiveUsers($id){ //additional paramiters      
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
//
public function archiveAcct($id){ //additional paramiters      
    $errmsg= "";
    $code= 0;       
        //modified sql string
    try{
        $sqlString= "UPDATE acct_tbl SET isdeleted=1 WHERE user_id=?";
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
    return array( "errmsg"=>$errmsg, "code" => $code);}

//
    public function archivePlaylist($id){ //additional paramiters      
        $errmsg= "";
        $code= 0;       
            //modified sql string
        try{
            $sqlString= "UPDATE playlist SET isdeleted=1 WHERE playlist_id=?";
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
        return array( "errmsg"=>$errmsg, "code" => $code);}

public function archiveSongs($id){ //additional paramiters      
        $errmsg= "";
        $code= 0;       
            //modified sql string
        try{
            $sqlString= "UPDATE song SET isdeleted=1 WHERE songs_id=?";
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
        return array( "errmsg"=>$errmsg, "code" => $code);}
    
}

?>
