<?php
class Post{

    protected $pdo;
    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }
    
    public function postUsersacct($body){
        $values=[];
        $errmsg= "";
        $code= 0;

        foreach($body as $value){
        array_push($values, $value);
        }
        try{
            $sqlString= "INSERT INTO user_tbl (fname,lname,contacts) VALUES (?,?,?)";
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




//post new playlist
    public function postPlaylist($body){
        $values=[];
        $errmsg= "";
        $code= 0;
    
        foreach($body as $value){
        array_push($values, $value);
        }
        try{
            $sqlString= "INSERT INTO playlist (user_id,p_name) VALUES (?,?)";
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
    
//post songs
public function postSongs($body, $file) {
    $values = [];
    $errmsg = "";
    $code = 0;

    try {
        // checks if the dir of uploads exist
        $uploadDir = __DIR__ . '/uploads/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // process of uploading a file 
        if (isset($file['file']) && $file['file']['error'] === UPLOAD_ERR_OK) {
            $fileName = basename($file['file']['name']);
            $uploadFilePath = $uploadDir . $fileName;

            if (move_uploaded_file($file['file']['tmp_name'], $uploadFilePath)) {
                // Prepare values for insertion
                $values = [ 
                    $body['title'], 
                    $body['artist'], 
                    $body['lyrics'], 
                    $body['chords'],
                    str_replace(__DIR__, '', $uploadFilePath), // Save to the uploads dir 
                    $body['duration']
                ];

                // SQL query to insert the song
                $sqlString = "INSERT INTO songs (title, artist, lyrics, chords, mp3_path, duration) VALUES (?, ?, ?, ?, ?, ?)";
                $sql = $this->pdo->prepare($sqlString);
                $sql->execute($values);

                $code = 200;
                $data = "Song uploaded and data saved successfully!";
                return array("data" => $data, "code" => $code);
            } else {
                throw new \Exception("Failed to move uploaded file.");
            }
        } else {
            throw new \Exception("No file uploaded or an error occurred during the upload.");
        }
    } catch (\PDOException $e) {
        $errmsg = $e->getMessage();
        $code = 400;
    } catch (\Exception $e) {
        $errmsg = $e->getMessage();
        $code = 400;
    }

    return array("errmsg" => $errmsg, "code" => $code);
}

}
    
?>