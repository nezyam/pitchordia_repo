<?php

class Get{    //for retrieving data from db
    protected $pdo;
    public function __construct(\PDO $pdo){ //get function to call in routes
        $this->pdo = $pdo; // pdo in the parameter
    }

    public function getPlaylist($id= null){
            $sqlString= "SELECT * FROM playlist";
            if($id != null){
                $sqlString .=" WHERE playlist_id=" . $id;
            }
    
            $data = array();
            $errmsg= "";
            $code= 0;
    
            try{    
                if($result = $this ->pdo->query($sqlString)->fetchAll()){
                    foreach($result as $record) {
                        array_push($data, $record);
                    }
                    $result = null;
                    $code= 200;
                    return array ("code"=>$code, "data"=>$data);
                }
                else{
                    $errmsg = "No data Found";
                    $code = 404;
                }
            }
            catch(\PDOException $e){
                $errmsg = $e-> getMessage();
                $code= 403;
            }
            return array("code"=>$code, "errmsg"=>$errmsg);
        }
// accountsdetails
public function getAcctnt($id= null){
    $sqlString= "SELECT * FROM accounts";
    if($id != null){
        $sqlString .=" WHERE accounts_id=" . $id;
    }

    $data = array();
    $errmsg= "";
    $code= 0;

    try{    
        if($result = $this ->pdo->query($sqlString)->fetchAll()){
            foreach($result as $record) {
                array_push($data, $record);
            }
            $result = null;
            $code= 200;
            return array ("code"=>$code, "data"=>$data);
        }
        else{
            $errmsg = "No data Found";
            $code = 404;
        }
    }
        //
// include_once "Common.php";

// class Get extends Common{

//     protected $pdo;

//     public function __construct(\PDO $pdo){
//         $this->pdo = $pdo;
//     }
    
//     public function getLogs($date){
//         $filename = "./logs/" . $date . ".log";
        
//         // $file = file_get_contents("./logs/$filename");
//         // $logs = explode(PHP_EOL, $file);

        
//         $logs = array();
//         try{
//             $file = new SplFileObject($filename);
//             while(!$file->eof()){
//                 array_push($logs, $file->fgets());
//             }
//             $remarks = "success";
//             $message = "Successfully retrieved logs.";
//         }
//         catch(Exception $e){
//             $remarks = "failed";
//             $message = $e->getMessage();
//         }
        

//         return $this->generateResponse(array("logs"=>$logs), $remarks, $message, 200);
//     }


//     public function getChefs($id){
        
//         $condition = "isdeleted = 0";
//         if($id != null){
//             $condition .= " AND id=" . $id; 
//         }

//         $result = $this->getDataByTable('chefs_tbl', $condition, $this->pdo);
//         if($result['code'] == 200){
//             return $this->generateResponse($result['data'], "success", "Successfully retrieved records.", $result['code']);
//         }
//         return $this->generateResponse(null, "failed", $result['errmsg'], $result['code']);
//     }
    
//     public function getMenu($id){
//         $condition = "isdeleted = 0";
//         if($id != null){
//             $condition .= " AND id=" . $id; 
//         }

//         $result = $this->getDataByTable('menu_tbl', $condition, $this->pdo);

//         if($result['code'] == 200){
//             return $this->generateResponse($result['data'], "success", "Successfully retrieved records.", $result['code']);
//         }
//         return $this->generateResponse(null, "failed", $result['errmsg'], $result['code']);
//     }
//     catch(\PDOException $e){
//         $errmsg = $e-> getMessage();
//         $code= 403;
//     }
//     return array("code"=>$code, "errmsg"=>$errmsg);
// }

//getsongs
    public function getSongs($id = null){
    //     $sqlString= "SELECT * FROM songs";
    //     if($id != null){
    //         $sqlString .=" WHERE songs_id=" . $id;
    //     }

    // //     $data = array();
    //     $errmsg= "";
    //     $code= 0;

    //     try{
    //         if($result = $this ->pdo->query($sqlString)->fetchAll()){
    //             foreach($result as $record) {
    //                 array_push($data, $record);
    //             }
    //             $result = null;
    //             $code= 200;
    //             return array ("code"=>$code, "data"=>$data);
    //         }
    //         else{
    //             $errmsg = "No data Found";
    //             $code = 404;
    //         }
    //     }
    //     catch(\PDOException $e){
    //         $errmsg = $e-> getMessage();
    //         $code= 403;

    //     }
    //     return array("code"=>$code, "errmsg"=>$errmsg);
    // }

   //   getpitchordia //retrieving data from data base tables
    public function getusers($users_id= null){
        //code for retrieving data on DB 
        $sqlString= "SELECT * FROM users where isdeleted=0";

        if($users_id != null){
            $sqlString .= " AND users_id=" . $users_id;
        }

        $data = array();
        $errmsg= "";
        $code= 0;

        try{
            if($result = $this ->pdo->query($sqlString)->fetchAll()){
                foreach($result as $record) {
                    array_push($data, $record);
                }
                $result = null;
                $code= 200;
                return array ("code"=>$code, "data"=>$data);
            }
            else{
                $errmsg = "No data Found";
                $code = 404;
            }
        }
        catch(\PDOException $e){
            $errmsg = $e-> getMessage();
            $code= 403;

        }
        return array("code"=>$code, "errmsg"=>$errmsg);
}

//lyrics
public function getLyrics($id= null){
    $sqlString = "SELECT * FROM lyrics";
    if($id != null){
        $sqlString .= " WHERE lyrics_id=" . $id;
    }

    $data = array();
    $errmsg = "";
    $code = 0;

    try { //try catch to used in handle exceptions ex. pdo exceptions,type of error msg
    // Execute the query and fetch all results
        if ($result = $this->pdo->query($sqlString)->fetchAll()) { //$this->pdo->query($sqlString)->fetchAll()-fetch record on db
            foreach ($result as $record) {
            array_push($data, $record);
            }
            $result = null;
            $code = 200;
            return array ("code"=>$code, "data"=>$data);
        }
        else{
            $errmsg = "No data Found";
            $code = 404;
         }
    }
    catch(\PDOException $e){
        $errmsg = $e-> getMessage();
        $code= 403;
    }
    return array("code"=>$code, "errmsg"=>$errmsg);
}
//getchords
public function getChords(){
    //code for retrieving data on DB
    return "This is some classes records retrieved from db";
}

}
?>