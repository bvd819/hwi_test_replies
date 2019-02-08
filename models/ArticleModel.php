<?php 

class ArticleModel extends Model
{
    public $id = NULL;
    public $title = NULL;
    public $content = NULL;
    public $link = NULL;

    public function __construct($id, $title = '', $content = '')
    {
        $this->id = $id;
        $this->link = '/Article/detail/' . $this->id;
        if ( isset($title) ) {
            $this->setTitle($title);
        }
        if ( isset($content) ) {
            $this->setContent($content);
        }
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    /**
     * Fetches all content and populates properties
     *
     * @return boolean
     */
    public function fetchContent()
    {
        $sql = "SELECT * FROM article WHERE id = " . $this->id;
        $req = Database::establishConnection()->prepare($sql);
        $req->execute();

        if ($result = $req->fetch(PDO::FETCH_ASSOC)) {
            $this->setTitle($result['title']);
            $this->setContent($result['content']);
            return true;
        } else {
            return false;
        }
    }


    /**
     * Simply fetches all articles
     *
     * @return array of Objects
     */
    public static function fetchAllArticles()
    {
        $sql = "SELECT * FROM article";
        $req = Database::establishConnection()->prepare($sql);
        $req->execute();
        $result = $req->fetchAll();

        $articleList = [];

        foreach($result as $article) {
            $articleList[] = new self($article['id'], $article['title'], $article['content']);
        }

        return $articleList;
    }
}

?>