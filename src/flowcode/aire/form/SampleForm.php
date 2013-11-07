<?php

namespace flowcode\aire\form;

use flowcode\roble\form\BaseForm;
use flowcode\roble\form\field\InputField;
use flowcode\roble\form\field\TextField;
use flowcode\roble\form\validator\MailValidator;
use flowcode\roble\form\validator\StringFieldValidator;

/**
 * Description of SampleForm
 *
 * @author Juan Manuel Agüero <jaguero@flowcode.com.ar>
 */
class SampleForm extends BaseForm {

    function __construct() {
        parent::__construct();
        $this->addField("name", new InputField(null, array("class" => "form-control")), new StringFieldValidator(250, 2));
        $this->addField("mail", new InputField(null, array("class" => "form-control")), new MailValidator());
        $this->addField("coment", new TextField(null, array("class" => "form-control")), new StringFieldValidator(2000, 4));
    }

}

?>
