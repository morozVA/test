<?php

namespace lib;


class User
{

    private $id;
    private $name;

    /**
     * User constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->id = 1;
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $title
     * @return Article
     */
    public function createNewArticle($title)
    {
        $article = new Article($title, $this->id);
        return $article;
    }

    /**
     * @return mixed
     */
    public function getAllArticles()
    {
        return Article::findAll($this->id);
    }

}
