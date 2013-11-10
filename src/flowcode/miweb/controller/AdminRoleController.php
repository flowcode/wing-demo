<?php

namespace flowcode\miweb\controller;

use flowcode\miweb\domain\Permission;
use flowcode\miweb\domain\Role;
use flowcode\miweb\service\PermissionService;
use flowcode\miweb\service\RoleService;
use flowcode\enlace\controller\BaseController;
use flowcode\enlace\http\HttpRequest;
use flowcode\enlace\view\View;

/**
 * Description of AdminNoticia
 *
 * @author juanma
 */
class AdminRoleController extends BaseController {

    private $roleService;

    function __construct() {
        $this->setIsSecure(TRUE);
        $this->addPermission('admin-login');
        $this->addPermission('admin-user-create');
        $this->addPermission('admin-user-delete');
        $this->addPermission('admin-user-update');
        $this->roleService = new RoleService();
    }

    function index(HttpRequest $httpRequest) {
        $viewData['filter'] = $httpRequest->getParameter('search');
        $viewData['page'] = $httpRequest->getParameter('page');
        if (is_null($viewData['page']) || empty($viewData['page'])) {
            $viewData['page'] = 1;
        }
        $viewData['pager'] = $this->roleService->findByFilter($viewData['filter'], $viewData['page']);
        return new View($viewData, "backend/cms/roleList");
    }

    function create(HttpRequest $HttpRequest) {
        $viewData['role'] = new Role();

        $permissionSrv = new PermissionService();
        $viewData['permissions'] = $permissionSrv->findAll();

        return new View($viewData, "backend/cms/roleForm");
    }

    function save(HttpRequest $httpRequest) {

        $id = (isset($_POST['id']) && !empty($_POST["id"]) ) ? $_POST['id'] : NULL;

        $role = new Role();
        $role->setId($id);
        $role->setName($httpRequest->getParameter("name"));

        $permissions = array();
        if (isset($_POST['permissions'])) {
            foreach ($_POST['permissions'] as $idPermission) {
                $permission = new Permission();
                $permission->setId($idPermission);
                $permissions[] = $permission;
            }
        }
        $role->setPermissions($permissions);

        $id = $this->roleService->save($role);

        $viewData['response'] = "success";
        return new View($viewData, "backend/cms/form-response");
    }

    function edit(HttpRequest $HttpRequest) {

        // en el primer parametro tiene que venir el id
        $params = $HttpRequest->getParams();
        $id = $params[0];

        $viewData['role'] = $this->roleService->findById($id);

        $permissionSrv = new PermissionService();
        $viewData['permissions'] = $permissionSrv->findAll();

        return new View($viewData, "backend/cms/roleForm");
    }

    function delete($HttpRequest) {
        // en el primer parametro tiene que venir el id
        $params = $HttpRequest->getParams();
        $id = $params[0];

        $role = $this->roleService->findById($id);
        $this->roleService->delete($role);

        $viewData['response'] = "success";
        return new View($viewData, "backend/cms/form-response");
    }

}

?>
