<?php

class Comment{

    public $database ;

    public function __construct(Database $db)
    {
        $this->database = $db->getConnection() ; 
    }

    public function createComment($user_id , $post_id , $content)
    {
        $stmt = $this->database->prepare("INSERT INTO comments (user_id ,post_id, content) VALUES (?, ? ,?)");
        $stmt->execute([$user_id , $post_id , $content]);
    }
}