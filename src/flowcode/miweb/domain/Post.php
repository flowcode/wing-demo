<?php

namespace flowcode\miweb\domain;

use flowcode\miweb\service\PostService;
use flowcode\miweb\domain\IPage;

/**
 * Description of Noticia
 *
 * @author juanma
 */
class Post implements IPage {

    private $id;
    private $permalink;
    private $title;
    private $description;
    private $intro;
    private $body;
    private $type;
    private $status;
    private $date;
    private $tags = null;
    public static $draft = 0;
    public static $published = 1;

    public function __construct() {
        $this->id = null;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPermalink() {
        return $this->permalink;
    }

    public function setPermalink($permalink) {
        $this->permalink = $permalink;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getFormatedDate() {
        return date("d/m/Y H:i", strtotime($this->date));
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getDate() {
        $returnFecha = date("Y-m-d H:i:s");
        if ($this->date != "" && $this->date != null) {
            $returnFecha = $this->date;
        }
        return $returnFecha;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getBody() {
        return $this->body;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function getIntro() {
        return $this->intro;
    }

    public function setIntro($intro) {
        $this->intro = $intro;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function __toString() {
        return $this->name;
    }

    public function getTags() {
        if (is_null($this->tags)) {
            $postSrv = new PostService();
            $this->tags = $postSrv->findTagsByPost($this);
        }
        return $this->tags;
    }

    public function setTags($tags) {
        $this->tags = $tags;
    }

    public function getMetaDescription() {
        return $this->description;
    }

}

?>
