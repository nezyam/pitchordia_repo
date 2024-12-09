<?php
class Post{

    protected $pdo;
    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }

//to edit posting to database
    public function postUsers($body){
        $values=[];
        $errmsg= "";
        $code= 0;

        foreach($body as $value){
        array_push($values, $value);
        }
        try{
            $sqlString= "INSERT INTO users (username,userpassword,fname,lname,contacts,emailadd) VALUES (?,?,?,?,?,?)";
            $sql = $this -> pdo -> prepare($sqlString); //protect sql injection 
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
    
    public function postAcct($body){
        $values=[];
        $errmsg= "";
        $code= 0;

        foreach($body as $value){
        array_push($values, $value);
        }
        try{
            $sqlString= "INSERT INTO accounts (fname,lastname) VALUES (?,?)";
            $sql = $this -> pdo -> prepare($sqlString); //protect sql injection 
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


    public function postPlaylist($body){
        $values=[];
        $errmsg= "";
        $code= 0;

        foreach($body as $value){
        array_push($values, $value);
        }
        try{
            $sqlString= "INSERT INTO playlist (user_id,song_id,playlist_name,songtitle) VALUES (?,?,?,?)";
            $sql = $this -> pdo -> prepare($sqlString); //protect sql injection 
            $sql-> execute($values);

            $code =200;
            $data = "Success";

            return array("data" =>$data, "code" => $code);
        }
        catch (\PDOException $e){
            $errmsg = $e ->getMessage();
            $code = 400;

        }
        return array( "errmsg"=>$errmsg, "code" => $code);
    }
}

//     public function postChefs($body){
//       $result = $this->postData("chefs_tbl", $body, $this->pdo);
//       if($result['code'] == 200){
//         $this->logger("testthunder5", "POST", "Created a new chef record");
//         return $this->generateResponse($result['data'], "success", "Successfully created a new record.", $result['code']);
//       }
//       $this->logger("testthunder5", "POST", $result['errmsg']);
//       return $this->generateResponse(null, "failed", $result['errmsg'], $result['code']);
//     }

//     public function postMenu($body){
//        $result = $this->postData("menu_tbl", $body, $this->pdo);
//        if($result['code'] == 200){
//         $this->logger("testthunder5", "POST", "Created a new menu record");
//         return $this->generateResponse($result['data'], "success", "Successfully created a new record.", $result['code']);
//       }
//       return $this->generateResponse(null, "failed", $result['errmsg'], $result['code']);
//     }
// }


?>