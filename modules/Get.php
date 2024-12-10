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
/////////
public function getuserPlaylist($userId)
    {
        if (!$userId) {
            return ['error' => 'User ID is required'];
        }

        try {
            // Fetch playlists and associated songs for the user
            $query = "
                SELECT 
                    p.id AS playlist_id, 
                    p.name AS p_name, 
                    s.id AS song_id, 
                    s.title AS song_title
                FROM 
                    playlists p
                LEFT JOIN 
                    playlist_songs ps ON p.id = ps.playlist_id
                LEFT JOIN 
                    songs s ON ps.song_id = s.id
                WHERE 
                    p.user_id = :user_id
            ";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['user_id' => $userId]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($results)) {
                return ['message' => 'No playlists found for this user'];
            }

            // Group playlists
            $groupedPlaylists = [];
            foreach ($results as $row) {
                $playlistId = $row['playlist_id'];
                $song = [
                    'song_id' => $row['song_id'],
                    'song_title' => $row['song_title']
                ];

                // Group songs under their respective playlist
                if (!isset($groupedPlaylists[$playlistId])) {
                    $groupedPlaylists[$playlistId] = [
                        'playlist_name' => $row['playlist_name'],
                        'songs' => []
                    ];
                }

                // Only add song if it's not null (to handle empty playlists)
                if ($row['song_id'] !== null) {
                    $groupedPlaylists[$playlistId]['songs'][] = $song;
                }
            }

            // Convert groupedPlaylists to indexed array for JSON response
            return ['playlists' => array_values($groupedPlaylists)];
        } catch (PDOException $e) {
            return ['error' => 'Query failed: ' . $e->getMessage()];
        }
    // Get user ID from the request
    $userId = isset($_GET['user_id']) ? intval($_GET['user_id']) : null;

    // Fetch and display playlists
    $response = $playlist->getPlaylistsByUser($userId);
    echo json_encode($response);

    }
// accountsdetails
public function getAccts($id= null){
    $sqlString= "SELECT * FROM acct_tbl";
    if($id != null){
        $sqlString .=" WHERE accnt_id=" . $id;
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
public function getSongs($id = null){
    $sqlString= "SELECT * FROM songs";
    if($id != null){
        $sqlString .=" WHERE songs_id=" . $id;
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

//usersnewplaylist
public function getnewPlaylist($id= null){
    //code for retrieving data on DB 
    $sqlString= "SELECT p.playlist_id, 
    p.name AS p_name, p.users_id, users.username FROM playlist JOIN users ON playlist.users_id = users.users_id";
   $sqlString= "SELECT * FROM playlist where isdeleted=0";
   
    if($id != null){
        $sqlString .= " AND playlist_id=" . $id;
    }

    $data = array();
    $errmsg="";
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

public function getPlaylist($id = null){
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

}
?>