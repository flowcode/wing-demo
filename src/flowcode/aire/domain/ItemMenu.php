<?php

namespace flowcode\aire\domain;

use flowcode\aire\service\PageService;

/**
 * Item de un menu.
 *
 * @author Juanma.
 */
class ItemMenu {

    private $id;
    private $name;
    private $menuId;
    private $fatherId;
    private $pageId;
    private $linkUrl;
    private $linkTarget;
    private $order;
    private $subItems;
    private $page = null;

    public function __construct() {
        $this->subItems = NULL;
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

    public function getMenuId() {
        return $this->menuId;
    }

    public function setMenuId($menuId) {
        $this->menuId = $menuId;
    }

    public function getFatherId() {
        return $this->fatherId;
    }

    public function setFatherId($fatherId) {
        $this->fatherId = $fatherId;
    }

    public function getPageId() {
        return $this->pageId;
    }

    public function setPageId($pageId) {
        $this->pageId = $pageId;
    }

    public function getLinkUrl() {
        return $this->linkUrl;
    }

    public function setLinkUrl($linkUrl) {
        $this->linkUrl = $linkUrl;
    }

    public function getOrder() {
        return $this->order;
    }

    public function setOrder($order) {
        $this->order = $order;
    }

    public function getSubItems() {
        if (is_null($this->subItems)) {
            $itemMenuSrv = new \flowcode\aire\service\ItemMenuService();
            $this->subItems = $itemMenuSrv->findByFatherId($this->getId());
        }
        return $this->subItems;
    }

    public function setSubItems($subItems) {
        $this->subItems = $subItems;
    }

    public function getUrl() {
        $return = $this->linkUrl;
        if (!is_null($this->page)) {
            $return = $this->page->getUrl();
        }
        return $return;
    }

    public function getPage() {
        if (is_null($this->page) && !is_null($this->pageId)) {
            $pageSrv = new PageService();
            $this->page = $pageSrv->findPageById($this->pageId);
        }
        return $this->page;
    }

    public function getLinkTarget() {
        return $this->linkTarget;
    }

    public function setLinkTarget($linkTarget) {
        $this->linkTarget = $linkTarget;
    }

}

?>
