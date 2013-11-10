<?php

namespace flowcode\miweb\dao;

use flowcode\ceibo\domain\Collection;
use flowcode\ceibo\EntityManager;

/**
 * Description of TodoDao
 *
 * @author Juan Manuel Agüero <jaguero@flowcode.com.ar>
 */
class TodoDao {

    /**
     * Find all to-dos.
     * @return Collection todoCollecion.
     */
    public function findAll() {
        $em = EntityManager::getInstance();
        return $em->findAll("todo");
    }

}

?>
