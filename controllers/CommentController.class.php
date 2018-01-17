<?php

class CommentController
{
    public function createCommentAction()
    {
        $data = $_POST;
        var_dump($data);
        //$comment = new Commet(-1, $data['title'], $data['category'], $data['active']);
    //  $comment->save();
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
}
