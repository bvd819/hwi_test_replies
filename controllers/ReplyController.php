<?php 

class ReplyController extends Controller
{

    public function __construct()
    {
        require(ROOT . 'models/ReplyModel.php');
    }

    public function create()
    {
        if ( empty($_POST) ) {
            echo 'The creation of replies is only allowed through form posts.';
            exit();
        }
        ReplyModel::createReply($_POST);
    }

    public static function mutate()
    {
        if ( empty($_POST) ) {
            echo 'The mutation of replies is only allowed through form posts.';
            exit();
        }

        echo json_encode( ReplyModel::mutateScoreOfReply($_POST) );
        exit();
    }

}

?>