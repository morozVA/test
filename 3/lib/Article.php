<?php

namespace lib;


class Article extends Entity
{

    private $authorId;

    /**
     * Entity constructor.
     * @param $title
     */
    public function __construct($title, $authorId)
    {
        $this->authorId = $authorId;
    }

    /**
     * @param $authorId
     * @return array
     */
    static public function findAll($authorId)
    {
        $articles = [];
        //find all articles of needled user and return result
        $articles = [1, 2, 3];
        return $articles;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->authorId;
    }

    /**
     * @param $newAuthorId
     */
    public function changeAuthor($newAuthorId)
    {
        $this->authorId = $newAuthorId;
    }


}
