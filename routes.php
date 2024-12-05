<?php

// Autoload Classes (Manually)
require_once 'C:\xampp\htdocs\pitchordia\src\Database.php';
require_once 'C:\xampp\htdocs\pitchordia\src\Auth.php';
require_once 'C:\xampp\htdocs\pitchordia\src\Playlist.php';

// Set Headers for JSON Response
header("Content-Type: application/json");

// Initialize Classes
$db = new Database();
$pdo = $db->connect();
$auth = new Auth($pdo);
$playlist = new Playlist($pdo);

// Get Route and HTTP Method
$route = $_GET['route'] ?? '';
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Example Routes
switch ($route) {
    case 'login':
        if ($requestMethod === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            try {
                $jwt = $auth->login($data['username'], $data['password']);
                echo json_encode(["token" => $jwt]);
            } catch (Exception $e) {
                echo json_encode(["error" => $e->getMessage()]);
            }
        } else {
            echo json_encode(["error" => "Method not allowed"]);
        }
        break;

    case 'playlist':
        switch ($requestMethod) {
            case 'POST': // Create Playlist
                $data = json_decode(file_get_contents('php://input'), true);
                $jwt = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
                $user = $auth->verifyToken(str_replace('Bearer ', '', $jwt));

                if ($user) {
                    $response = $playlist->createPlaylist($user['id'], $data['name']);
                    echo json_encode($response);
                } else {
                    echo json_encode(["error" => "Unauthorized"]);
                }
                break;

            case 'PUT': // Rename Playlist
                $data = json_decode(file_get_contents('php://input'), true);
                $jwt = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
                $user = $auth->verifyToken(str_replace('Bearer ', '', $jwt));

                if ($user) {
                    $response = $playlist->renamePlaylist($user['id'], $data['playlist_id'], $data['name']);
                    echo json_encode($response);
                } else {
                    echo json_encode(["error" => "Unauthorized"]);
                }
                break;

            case 'DELETE': // Delete Playlist
                $data = json_decode(file_get_contents('php://input'), true);
                $jwt = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
                $user = $auth->verifyToken(str_replace('Bearer ', '', $jwt));

                if ($user) {
                    $response = $playlist->deletePlaylist($user['id'], $data['playlist_id']);
                    echo json_encode($response);
                } else {
                    echo json_encode(["error" => "Unauthorized"]);
                }
                break;

            default:
                echo json_encode(["error" => "Method not allowed"]);
        }
        break;

    default:
        echo json_encode(["error" => "Invalid route"]);
}