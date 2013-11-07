<?php

namespace flowcode\aire\domain;

use flowcode\aire\domain\IPageManager;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlainPageManager
 *
 * @author juanma
 */
class PlainPageManager implements IPageManager {

    private $viewData;

    function __construct(Page $page) {
        $this->viewData["page"] = $page;
    }

    public function getViewData() {
        return $this->viewData;
    }

}

?>
