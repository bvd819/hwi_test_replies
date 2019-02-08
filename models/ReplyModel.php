<?php 

class ReplyModel extends Model
{
    public $id = NULL;
    public $article_id = NULL;
    public $reply_id = NULL;
    public $account_id = NULL;
    public $content = NULL;
    public $created_date = NULL;
    public $score = NULL;
    
    /**
     * Creates a reply on an article or on a reply
     *
     * @param array $creationData
     * @param int $creationData['article_id] The article to create the reply for, required.
     * @param int $creationData['reply_id'] The optional parent reply that has been responded to.
     * @param int $creationData['account_id] The account identifier, required.
     * @param string $creationData['message] The message, also required.
     * @return void
     */
    public static function createReply($creationData)
    {
        // Since PDO only sanitizes for sql, sanitize using before passing to pdo
        $articleId = isset($creationData['article_id']) ? intval($creationData['article_id']) : NULL;
        $replyId =  isset($creationData['reply_id']) ? intval($creationData['reply_id']) : NULL;
        $accountId =  isset($creationData['account_id']) ? intval($creationData['account_id']) : NULL;
        $message =  isset($creationData['message']) ? $creationData['message'] : '';

        if (
            $articleId === NULL ||
            $accountId === NULL ||
            $message === ''
        ) {
            // error, required fields not given
            exit();
        }


        $sql = "
        INSERT INTO reply (
            id, 
            article_id, 
            reply_id, 
            account_id, 
            content, 
            created_date, 
            score
        ) VALUES (
            NULL,
            :article_id,
            :reply_id,
            :account_id,
            :content,
            DATE_FORMAT(NOW(), '%y-%m-%d %H:%i'),
            0
        )";
        $statement = Database::establishConnection()->prepare($sql);

        $statement->bindParam(':article_id', $articleId, PDO::PARAM_INT);
        $statement->bindParam(':reply_id', $replyId, PDO::PARAM_INT);
        $statement->bindParam(':account_id', $accountId, PDO::PARAM_INT);
        $statement->bindParam(':content', $message, PDO::PARAM_STR);

        if ( $statement->execute() === false ) {
            // log error, the creation of replies should be done through ajax in my opinion as the displaying of errors to the client is direct and doesn't require going to another page.   
        }

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    /**
     * Logged in users are allowed to mutate the score of replies by adding or subtracting.
     *
     * @param array $mutationData
     * @param string $mutationData['mutation'] (has to be an allowed operator like '+' or '-')
     * @param int $mutationData['reply_id'] Reply id to mutate
     * @return void
     */
    public static function mutateScoreOfReply($mutationData)
    {
        if ( !isset($_SESSION['account']) || $_SESSION['account']['loggedIn'] === false ) {
            return ['returnstatus' => false, 'message' => 'Je moet ingelogd zijn om dit te kunnen doen.'];
            exit();
        }

        $allowedMutations = ['+', '-'];
        $mutation = in_array($mutationData['mutation'], $allowedMutations) ? $mutationData['mutation'] : false;
        $reply_id = isset($mutationData['reply_id']) ? intval($mutationData['reply_id']) : NULL;

        if ( $mutation === false ) {
            // @todo: display error to user because of illegal operator
            exit();
        }

        $sql = "
            UPDATE 
                reply
            SET
                score = score ". $mutation ." 1
            WHERE
                id = :reply_id
        ";
        $statement = Database::establishConnection()->prepare($sql);

        $statement->bindParam(':reply_id', $reply_id, PDO::PARAM_INT);

        if ( $statement->execute() ) {
            return ['status' => true, 'message' => 'De score van de reactie is gewijzigd.'];
        } else {
            return ['status' => false, 'message' => 'Het wijzigen van de score is mislukt.'];
        }
        exit();
    }

    /**
     * This function walks through the array of replies and establishes hierarchy based on the reply_id column
     *
     * @param Array $replyArray - Array to process
     * @param boolean $reverse - In my functionality, when walking through the array items I establish a new array. This means that possible parents for children might not have been found yet. 
     *  Considering that the functionality as is only allows sorting based on id a simple array_reverse followed by an array_reverse at the end ensures parents exist. This isn't a clean solution, but considering the time I have at the moment I think it's a fine solution that's robust for this job.
     * @return Array 
     */
    public static function applyReplyHierarchy($replyArray, $reverse = false)
    {
        $comments = array();
        
        if ($reverse === true) {
            $replyArray = array_reverse($replyArray);
        }


        foreach( $replyArray as $item ) {
            if ( $item['reply_id'] == 0 ) {
                $comments[] = $item;
            } else {
                $parent_array = array_search($item['reply_id'], array_column($comments,'id'));
                if ($parent_array !== false) {
                    $comments[$parent_array]['replies'][] = $item;
                } 
            }
        }

        if ($reverse === true) {
            $comments = array_reverse($comments);
        }

        return $comments;
    }
    
    /**
     * Fetches all replies belonging to an article based on provided articleId
     *
     * @param int $articleId
     * @param int $scoreThreshold (minimum score to show)
     * @param string $sort ('desc' or 'asc', defaults to 'desc')
     * @return array Array of article comments
     */
    public static function fetchRepliesOfArticle($articleId, $scoreThreshold, $sort) 
    {
        $sql = "SELECT reply.*, account.name as account_name, account.image as account_image, account.id as account_id  ";
        $sql .= "FROM reply ";
        $sql .= "JOIN account ON reply.account_id = account.id ";
        $sql .= "WHERE reply.article_id = " . $articleId . " ";
        if ( isset($scoreThreshold) && $scoreThreshold !== '' && $scoreThreshold !== false) {
            $sql .= " AND score >= " . $scoreThreshold;
        }
        if ( isset($sort) && $sort !== '' ) {
            switch ($sort) {
                case 'desc':
                    $sql .= " ORDER BY id DESC";
                    break;
                case 'asc':
                    $sql .= " ORDER BY id ASC";
                    break;
                default:
                    break;
            }
        }

        $req = Database::establishConnection()->prepare($sql);
        $req->execute();
        $result = $req->fetchAll();
        
        
        $replyList = self::applyReplyHierarchy($result, $sort == "desc" ? true : false);


        return $replyList;
    }

}

?>