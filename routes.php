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

//instantiate post, get class
$post  = new Post($pdo); //using pdo as argugement and create a contructors
$get   = new Get($pdo);
$patch = new Patch($pdo);
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
                    echo json_encode($get->getUsers($request[1]));
                    }else{
                    echo json_encode($get->getUsers());
                } 
                 break;

            case "accounts":
                 if (count($request)>1){
                 echo json_encode($get->getAccts($request[1]));
                 }else{
                 echo json_encode($get->getAccts());
             } 
                break;

             case "newplaylist":
                if (count($request)>1){
                     echo json_encode($get->getnewPlaylist($request[1]));
                }else{
                    echo json_encode($get->getnewPlaylist());
                } 
                 break;
                
            case "playlist":
                if (count($request)>1){
                    echo json_encode($get->getPlaylist($request[1]));
                    }else{
                    echo json_encode($get->getPlaylist());
                } 
                break;

                case "userplaylist":
                    if (count($request)>1){
                        echo json_encode($get->getuserPlaylist($request[1]));
                        }else{
                        echo json_encode($get->getPlaylist());
                    } 
                    break;

            case "songs":
               if (count($request)>1){
                echo json_encode($get->getSongs($request[1]));
                }else{
                echo json_encode($get->getSongs());
            } 
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


    //inserting record
    case "POST":
        $body = json_decode(file_get_contents("php://input"), true);
        switch($request[0]){

            case "users": //$post-form data 
                echo json_encode($post->postUsers($body));
                break;      
             
            case "accounts": //$post-form data 
                echo json_encode($post->postAcct($body));
                break;

            case "newplaylist":
                echo json_encode($post->postnewPlaylist($body));//$post->postPlaylist();
                break;  
                           

            default:
                http_response_code(401);
                echo "This is invalid endpoint";
                break;
        }
    break;

//this is for updating record
case "PATCH":
    $body = json_decode(file_get_contents("php://input"), true);
    switch($request[0]){

        case "users": //$post-form data 
            echo json_encode($patch->patchUsers($body, $request[1]));
            break;      
         
        case "accounts": //$post-form data 
           // echo json_encode($patch->patchAcct($body, $request[1]));
            break;

        case "playlist":
           echo json_encode($patch->patchPlaylist($body, $request[1]));
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
 
}

?>
