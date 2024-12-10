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
            $sqlString= "INSERT INTO accounts (fname,lname,contacts) VALUES (?,?,?)";
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
    public function postnewPlaylist($body){
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
public function postSong($body, $file) {
           $values = [];
           $errmsg = "";
           $code = 0;
   
           {
            // Define response variables
            $errmsg = '';
            $code = 200;
    
            try {
                // Ensure the uploads directory exists
                $uploadDir = __DIR__ . '/uploads/';
                if (!file_exists($uploadDir)) {
                    if (!mkdir($uploadDir, 0777, true)) {
                        throw new Exception('Failed to create upload directory');
                    }
                }
    
                // Handle the file upload
                if (isset($file['file']) && $file['file']['error'] === UPLOAD_ERR_OK) {
                    $fileName = basename($file['file']['name']);
                    $uploadFilePath = $uploadDir . $fileName;
    
                    // Move the uploaded file to the uploads directory
                    if (!move_uploaded_file($file['file']['tmp_name'], $uploadFilePath)) {
                        throw new Exception('Failed to move uploaded file');
                    }
    
                    // Prepare the song data for database insertion
                    $values = [
                        $body['song_title'],
                        $body['song_artist'],
                        $body['song_lyrics'],
                        str_replace(__DIR__, '', $uploadFilePath), // Save relative path
                        str_replace(__DIR__, '', $uploadFilePath), // Save to the uploads dir
                        $body['song_duration']
                    ];
    
                    // SQL query to insert the song into the database
                    $query = "INSERT INTO songs (title, artist, lyrics, file_path, duration) 
                              VALUES (?, ?, ?, ?, ?)";
                    $stmt = $this->pdo->prepare($query);
    
                    // Execute the query
                    if ($stmt->execute($values)) {
                        return ["errmsg" => "File uploaded and song inserted successfully", "code" => 200];
                    } else {
                        throw new Exception('Error inserting song into the database');
                    }
                } else {
                    throw new Exception('No file uploaded or upload error');
                }
            } catch (Exception $e) {
                // Catch any exceptions and return an error response
                return ["errmsg" => $e->getMessage(), "code" => 400];
            }
        }
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