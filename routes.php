<?php

//import get and post files
require_once "./config/database.php"; // to run trought the connection
require_once "./modules/Get.php";
require_once "./modules/Post.php";
require_once "./modules/Patch.php";
require_once "./modules/UploadController.php";
require_once "./config/database.php";
require_once "./modules/Get.php";
require_once "./modules/Post.php";
require_once "./modules/Patch.php";
require_once "./modules/Delete.php";
require_once "./modules/Auth.php";
require_once "./modules/Crypt.php";

$db= new Connection(); //database connection class
$pdo = $db ->connect();

$db = new Connection();
$pdo = $db->connect();

//instantiate post, get class
$post  = new Post($pdo); //using pdo as argugement and create a contructors
$get   = new Get($pdo);
$patch = new Patch($pdo);

$post = new Post($pdo);
$patch = new Patch($pdo);
$get = new Get($pdo);
$delete = new Delete($pdo);
$auth = new Authentication($pdo);
$crypt = new Crypt();

//$delete= new Delete( $pdo);

//retrieved and endpoints and split
if(isset($_REQUEST['request'])){                    //$REQUEST to capture students
    $request = explode("/", $_REQUEST['request']);  // to check if may laman o wala iisset functionality
}          
else{                                           
    echo "URL does not exist."; //explode used to convert string to array format using delimiters "/" , // students/2023109050/
}

//get post put patch delete etc- HTTPS operation/   request method
//Request method - http request methods you will be using.. ordering .different types https methods
//get -retrieve records
//post- adding records
//put patch- updating records

switch($_SERVER['REQUEST_METHOD']){     //to capture using global variable $server to check the request of client

   case "GET":
        switch($request[0]){               //index of an endpoint start at 0 for indexing request.
            case "users":
                if (count($request)>1){
                    echo json_encode($get->getusers($request[1]));
                    }else{
                    echo json_encode($get->getusers());
                } 
                 break;
                
            case "playlist":
                if (count($request)>1){
                    echo json_encode($get->getPlaylist($request[1]));
                    }else{
                    echo json_encode($get->getPlaylist());
                } 
                break;

            case "accounts":
                if (count($request)>1){
                echo json_encode($get->getAcctnt($request[1]));
                }else{
                echo json_encode($get->getAcctnt());
            } 
            break;

            case "songs":
               if (count($request)>1){
                echo json_encode($get->getSongs($request[1]));
                }else{
                echo json_encode($get->getSongs());
            } 
            break;

            case "chords":
               echo json_encode($get->getChords());
                break;   

            case "lyrics":
                    echo json_encode($get->getLyrics());
                     break;
           
            default:
                http_response_code(401);
                    echo "This is invalid endpoint";
                    break;
            }
    break;  
switch($_SERVER['REQUEST_METHOD']){

    case "GET":
        if($auth->isAuthorized()){
            switch($request[0]){
    
                case "chefs":
                    $dataString = json_encode($get->getChefs($request[1] ?? null));
                    echo $crypt->encryptData($dataString);
                break;
     
                case "menu":
                    $dataString = json_encode($get->getMenu($request[1] ?? null));
                    echo $crypt->encryptData($dataString);
                break;

                case "log":
                    echo json_encode($get->getLogs($request[1] ?? date("Y-m-d")));
                break;

             
                default:
                    http_response_code(401);
                    echo "This is invalid endpoint";
                break;
           
            }
        }
        else{
            http_response_code(401);
        }

    break;

    //inserting record
    case "POST":
        $body = json_decode(file_get_contents("php://input"), true);
        switch($request[0]){
            case "login":
                echo json_encode($auth->login($body));//
            break;
          
            case "user":
                echo json_encode($auth->addAccount($body));//additional
            break;
               
            case "users": //$post-form data 
                echo json_encode($post->postUsers($body));
                break;      
             
            case "accounts": //$post-form data 
                echo json_encode($post->postAcct($body));
                break;


            case "playlist":
                echo json_encode($post->postPlaylist($body));//$post->postPlaylist();
                break;                    

            default:
                http_response_code(401);
                echo "This is invalid endpoint";
                break;
        }
    break;

//this is for updating record
    case "PATCH":
        $body = json_decode (file_get_contents( "php://input"));
        switch($request[0]){

            case "users":
                echo json_encode($patch->patchUsers($body, $request[1]));
            break;

            case "chefs":
                // echo json_encode($body);
                // echo $crypt->decryptData($body);
                echo json_encode($post->postChefs($body));
                break;

            case "menu":
                echo json_encode($post->postMenu($body));
            break;


            default:
                http_response_code(401);
                echo "This is invalid endpoint";
            break;
        }
    break;

//archiving record
case "DELETE":
    switch($request[0]){
        case "users":
            echo json_encode($patch->arcUsers ($request[1]));
        break;

        default:
            http_response_code(401);
            echo "This is invalid endpoint";
        break;
    }
break;

    default:                                                        
        http_response_code(400); //http response code  200-299 success ,300-399 redirect, 400-499 request error, 500 onwards -server errors
        echo "Invalid Request Method.";// handle exceptions
    break;
}

}
$pdo = null;
// unset($pdo);
?>
