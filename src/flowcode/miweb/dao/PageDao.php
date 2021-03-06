<?php

namespace flowcode\miweb\dao;

use flowcode\miweb\domain\Page;
use flowcode\ceibo\EntityManager;
use flowcode\wing\utils\Pager;

/**
 * Description of PageDao
 *
 * @author Juanma.
 */
class PageDao {

    public function __construct() {
        
    }

    public function save(Page $page) {
        $em = EntityManager::getInstance();
        return $em->save($page);
    }

    function delete(Page $page) {
        $em = EntityManager::getInstance();
        $em->delete($page);
    }

    public function findById($id) {
        $em = EntityManager::getInstance();
        return $em->findById("page", $id);
    }

    public function findAll() {
        $em = EntityManager::getInstance();
        return $em->findAll("page");
    }

    /**
     * Return an active pager.
     * @param type $filter
     * @param type $page
     * @return Pager $pager.
     */
    public function findByFilter($filter = null, $page = 1) {
        $em = EntityManager::getInstance();
        $pager = $em->findByGenericFilter("page", $filter, $page, "name", "asc");
        return $pager;
    }

    public function getPublishedPages($permalink) {

        $em = EntityManager::getInstance();
        $pages = $em->findByWhereFilter("page", "status = '" . Page::$published . "' ", "name", "asc");

        return $pages;
    }

    /**
     * Get post with similar permalinks.
     * @param String $permalink
     * @return array
     */
    function getBySimilarPermalink($permalink, $exceptId = null) {

        $em = EntityManager::getInstance();
        if(!is_null($exceptId)){
            $filter = "permalink LIKE '$permalink%' AND id != '$exceptId' ";
        }  else {
            $filter = "permalink LIKE '$permalink%' ";
        }
        $pages = $em->findByWhereFilter("page", $filter);

        return $pages;
    }

    /**
     * Get page with equal permalink.
     * @param String $permalink
     * @return array
     */
    function getByPermalink($permalink) {

        $em = EntityManager::getInstance();
        $pages = $em->findByWhereFilter("page", "permalink = '$permalink' ");
        if ($pages->count() > 0) {
            $pages->rewind();
            return $pages->current();
        } else {
            return NULL;
        }
    }

}

?>
