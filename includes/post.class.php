<?php

class Post{
    
    public $database;
    public function __construct(Database $db)
    {
        $this->database = $db->getConnection() ;
    }
    
    public function createPost($user_id , $content)
    {
        $query = "INSERT INTO posts (user_id , content) VALUES (?, ?)";
        $stmt = $this->database->prepare($query);
        $stmt->execute([$user_id,$content]);
    }
}