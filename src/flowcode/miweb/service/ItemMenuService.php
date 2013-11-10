<?php

namespace flowcode\miweb\service;

use flowcode\miweb\dao\ItemMenuDao;
use flowcode\miweb\domain\ItemMenu;
use flowcode\miweb\domain\Menu;

/**
 * 
 */
class ItemMenuService {

    private $itemmenuDao;

    function __construct() {
        $this->itemmenuDao = new ItemMenuDao();
    }

    /**
     * Funcion que guarda una ItemMenu.
     * @param ItemMenu $itemmenu
     * @return type 
     */
    public function save($itemmenu) {
        $id = $this->itemmenuDao->save($itemmenu);
        return $id;
    }

    /**
     * Obtiene todas las ItemMenu.
     * @return type 
     */
    public function findAll() {
        $itemmenus = $this->itemmenuDao->findAll();
        return $itemmenus;
    }

    public function findById($id) {
        $entidad = NULL;
        if (strlen($id) > 0) {
            $entidad = $this->itemmenuDao->findById($id);
        }
        return $entidad;
    }

    public function findByMenu(Menu $menu) {
        $entidad = $this->itemmenuDao->findByMenuId($menu->getId());
        return $entidad;
    }

    public function findByFatherId($fatherId = NULL) {
        if (!is_null($fatherId)) {
            $items = $this->itemmenuDao->findByFatherId($fatherId);
        } else {
            $items = array();
        }
        return $items;
    }
    
    public function findFathersByMenu(Menu $menu){
        $itemmenus = $this->itemmenuDao->findFathersByMenuId($menu->getId());
        return $itemmenus;
    }

    /**
     * Elimina una itemmenu por su id.
     * @param type $id 
     */
    public function deleteById($id) {
        if (strlen($id) > 0) {
            $itemMenu = $this->itemmenuDao->findById($id);
            $this->itemmenuDao->delete($itemMenu);
        }
    }

}

?>
