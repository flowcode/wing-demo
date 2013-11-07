<?php

namespace flowcode\aire\dao;

use Exception;
use flowcode\aire\domain\User;
use flowcode\ceibo\data\PDOMySqlDataSource;
use flowcode\ceibo\domain\Collection;
use flowcode\ceibo\EntityManager;

/**
 * Engloba las operaciones de persistencia de un Usuario.
 *
 * @author Juan Manuel Aguero - http://juanmaaguero.com.ar .
 */
class UserDao {

    private $dataSource;

    public function __construct() {
        $this->dataSource = new PDOMySqlDataSource();
    }

    /**
     * Metodo para guardar o modificar los datos de un usuario.
     * 
     * @param User $categoria 
     */
    public function save($usuario) {
        $em = EntityManager::getInstance();
        return $em->save($usuario);
    }

    public function getUserByUsernamePassword($username, $password) {
        $user = null;
        $em = EntityManager::getInstance();

        $filter = "username = '" . $username . "' AND password = '" . $password . "'";
        $users = $em->findByWhereFilter("user", $filter);

        if ($users->count() > 0) {
            $users->rewind();
            $user = $users->current();
        }
        return $user;
    }

    /**
     * Obtiene un usuario por su nombre de usuario o nif.
     * @param type $username
     * @return User
     * @throws Exception 
     */
    public function obtenerUsuarioPorUsername($username) {
        try {
            $usuario = NULL;

            if (!is_null($username)) {
                $query = "SELECT * FROM user WHERE username = '" . $username . "' ";
                $result = $this->executeQuery($query);

                if ($result) {
                    $usuario = $this->getInstaceFromArray($result[0]);
                }
            }

            return $usuario;
        } catch (Exception $pEx) {
            throw new Exception("Fallo al obtener el usuario. " . $pEx->getMessage());
        }
    }

    /**
     * Elimina el Usuario correspondiente al ID.
     * @param Boolean $success.
     */
    public function delete(User $user) {
        $em = EntityManager::getInstance();
        return $em->delete($user);
    }

    /**
     * Return a Collection of roles.
     * @param User $user
     * @return Collection roles.
     */
    public function findRoles(User $user) {
        $em = EntityManager::getInstance();
        return $em->findRelation($user, "Roles");
    }

    public function findByFilter($filter = null, $page = 1) {
        $em = EntityManager::getInstance();
        $pager = $em->findByGenericFilter("user", $filter, $page);
        return $pager;
    }

    /**
     * Return a user by its id.
     * @param type $id
     * @return User $user.
     */
    public function findById($id) {
        $em = EntityManager::getInstance();
        return $em->findById("user", $id);
    }

    private function getInstaceFromArray($array) {
        $usuario = null;
        if (!is_null($array)) {
            $usuario = new User();
            $usuario->setId($array["id"]);
            $usuario->setUsername($array["username"]);
            $usuario->setPassword($array["password"]);
            $usuario->setMail($array["mail"]);
            $usuario->setName($array["name"]);
        }
        return $usuario;
    }

}

?>
