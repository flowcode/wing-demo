<?php

namespace flowcode\miweb\dao;

use flowcode\miweb\domain\Permission;
use flowcode\ceibo\EntityManager;

/**
 * Description of PermissionDao
 *
 * @author Juanma.
 */
class PermissionDao {

    public function __construct() {
        
    }

    public function save(Permission $permission) {
        $em = EntityManager::getInstance();
        $em->save($permission);
    }

    function delete(Permission $permission) {
        $em = EntityManager::getInstance();
        $em->delete($permission);
    }

    public function findById($id) {
        $em = EntityManager::getInstance();
        return $em->findById("permission", $id);
    }

    public function findAll() {
        $em = EntityManager::getInstance();
        return $em->findAll("permission");
    }
    
    /**
     * Return an active permissionr.
     * @param type $filter
     * @param type $permission
     * @return Permission $permission.
     */
    public function findByFilter($filter = null, $permission = 1) {
        $em = EntityManager::getInstance();
        $permissionr = $em->findByGenericFilter("permission", $filter, $permission, "name", "asc");
        return $permissionr;
    }

}

?>
