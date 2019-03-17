<?php
/**
 * Created by PhpStorm.
 * User: Cadaver
 * Date: 17.03.2019
 * Time: 15:15
 */

namespace lib;


abstract class Entity
{
    private $id;
    private $title;

    /**
     * Entity constructor.
     * @param $title
     */
    public function __construct($title, $authorId)
    {
        $this->title = $title;
        $this->authorId = $authorId;
    }


}
