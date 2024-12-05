<?php

class Playlist
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createPlaylist($userId, $name)
    {
        $query = "INSERT INTO Playlists (name, user_id) VALUES (:name, :user_id)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['name' => $name, 'user_id' => $userId]);
        return ["message" => "Playlist created successfully"];
    }

    public function renamePlaylist($userId, $playlistId, $newName)
    {
        $query = "UPDATE Playlists SET name = :name WHERE id = :id AND user_id = :user_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['name' => $newName, 'id' => $playlistId, 'user_id' => $userId]);
        return ["message" => "Playlist renamed successfully"];
    }

    public function deletePlaylist($userId, $playlistId)
    {
        $query = "DELETE FROM Playlists WHERE id = :id AND user_id = :user_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $playlistId, 'user_id' => $userId]);
        return ["message" => "Playlist deleted successfully"];
    }
}
