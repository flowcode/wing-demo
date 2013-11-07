<?php

namespace flowcode\aire\domain;

/**
 * Una seccion es una unidad de visualización del portal.
 *
 * @author Juanma.
 */
class Page implements IPage {

    private $id;
    private $name;
    private $permalink;
    private $description;
    private $htmlContent;
    private $status;
    private $type;

    /* status */
    public static $status_draft = 0;
    public static $status_published = 1;

    /* type */
    public static $type_plain = 100;
    public static $type_custom = 110;

    public function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getPermalink() {
        return $this->permalink;
    }

    public function setPermalink($permalink) {
        $this->permalink = $permalink;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getHtmlContent() {
        return $this->htmlContent;
    }

    public function setHtmlContent($htmlContent) {
        $this->htmlContent = $htmlContent;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getUrl() {

        return $this->permalink;
    }

    public function getMetaDescription() {
        return $this->description;
    }

    public function getTitle() {
        return $this->name;
    }

}

?>
