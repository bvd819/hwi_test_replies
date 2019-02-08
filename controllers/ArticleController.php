<?php 

class ArticleController extends Controller
{

    public function __construct()
    {
        require(ROOT . 'models/ArticleModel.php');
        require(ROOT . 'models/ReplyModel.php');
    }

    /**
     * Detail method provides functionality to view an article in detail.
     * This method also interfaces with ReplyModel in order to fetch all associated replies for this article.
     * 
     * Utilizes $_GET variables in $data string in order to either sort the replies or apply a score threshold for comments.
     * 
     * Eventually renders a view utilizing the detail template.
     *
     * @param string $data
     *  - INT       id in url path
     *  - INT       ?score_threshold
     *  - string    ?sort (can be either 'desc' or 'asc')
     * @return view
     */
    public function detail($data)
    {
        $parts = parse_url($data);
        $articleId = intval($parts['path']);

        if ( !isset($articleId) || $articleId == '' ) {
            exit();
        }

        if ( isset($parts['query']) ) {
            parse_str($parts['query'], $query);
            if ( isset($query['score_threshold']) ) {
                $scoreThreshold =  intval($query['score_threshold']);
            }
            if ( isset($query['sort']) ) {
                $sort = $query['sort'];
            }
        }

        $article = new ArticleModel($articleId);
        if ( $article->fetchContent() === false ) {
            $data = [];
            $data['pageNotFound'] = ['title' => 'Helaas...', 'message' => 'Helaas, dit artikel bestaat niet (meer).'];
            $this->set($data);
            $this->render('detail');
            return;
        }

        $replyList = ReplyModel::fetchRepliesOfArticle($article->id, isset($scoreThreshold) ? $scoreThreshold : false, isset($sort) ? $sort : 'desc');

        $data = [];
        $data['data'] = $article;
        $data['replies'] = $replyList;

        $this->set($data);
        $this->render('detail');
    }
    
    /**
     * Displays simple article list and renders a view with the articlelist template.
     *
     * @return view
     */
    public function articleList()
    {
        $articleList = ArticleModel::fetchAllArticles();

        $data = [];
        $data['articleList'] = $articleList;
        $this->set($data);
        $this->render('articlelist');
    }
    
}

?>