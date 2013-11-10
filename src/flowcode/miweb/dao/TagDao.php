<?php

namespace flowcode\miweb\dao;

use flowcode\miweb\domain\Tag;
use flowcode\ceibo\EntityManager;

/**
 * Description of TagDao
 *
 * @author juanma
 */
class TagDao {

    public function __construct() {
        
    }

    public function save(Tag $tag) {
        return EntityManager::getInstance()->save($tag);
    }

    public function findAll() {
        return EntityManager::getInstance()->findAll("tag");
    }

    public function delete(Tag $tag) {
        EntityManager::getInstance()->delete($tag);
    }

    public function findById($id) {
        return EntityManager::getInstance()->findById("tag", $id);
    }

    public function findByFilter($filter = null, $page = 1) {
        $em = EntityManager::getInstance();
        $pager = $em->findByGenericFilter("tag", $filter, $page);
        return $pager;
    }

}

?>
