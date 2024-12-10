<?php

class Get{    //for retrieving data from db
    protected $pdo;
    public function __construct(\PDO $pdo){ //get function to call in routes
        $this->pdo = $pdo; // pdo in the parameter
    }

//users
    public function getUsers($user_id = null) {
        $sqlString = "SELECT * FROM user_tbl";
        if ($user_id != null) {
            $sqlString .= " WHERE user_id=" . $user_id;
        }

        $data = array ();
        $errmsg = "";
        $code = 0;

        try {
            if ($result = $this->pdo->query($sqlString)->fetchAll()){
                foreach($result as $record){
                    array_push($data, $record);
                }
                $result = null;
                $code = 200;
                return array("code"=>$code, "data"=>$data);
            }
            else {
                $errmsg = "No data found";
                $code = 404;
            }
        }
        catch (\PDOException $e){
            $errmsg = $e->getMessage();
            $code = 403;
        }
        return array("code"=>$code, "errmsg"=>$errmsg);
    }
//playlist
public function getPlaylist($id = null) {
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
public function getAccts($id= null){
    $sqlString= "SELECT * FROM acct_tbl";
    if($id != null){
        $sqlString .=" WHERE user_id=" . $id;
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
//getsongs
public function getSongs($song_id = null) {
    $sqlString = "SELECT * FROM songs";
    if ($song_id != null) {
        $sqlString .= " WHERE songs_id=" . $song_id;
    }

    $data = array ();
    $errmsg = "";
    $code = 0;

    try {
        if ($result = $this->pdo->query($sqlString)->fetchAll()){
            foreach($result as $record){
                array_push($data, $record);
            }
            $result = null;
            $code = 200;
            return array("code"=>$code, "data"=>$data);
        }
        else {
            $errmsg = "No data found";
            $code = 404;
        }
    }
    catch (\PDOException $e){
        $errmsg = $e->getMessage();
        $code = 403;
    }
    return array("code"=>$code, "errmsg"=>$errmsg);
}

}

?>