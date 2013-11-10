<?php

namespace flowcode\miweb\domain;

/**
 * Description of UserMessage
 *
 * @author Juan Manuel Agüero <jaguero@flowcode.com.ar>
 */
class UserMessage {

    private $type;
    private $message;

    /**
     * UserMessage.
     * types: success, danger, warning, info.
     * @param type $type
     * @param type $message
     */
    function __construct($type, $message) {
        $this->type = $type;
        $this->message = $message;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function __toString() {
        $str = '<div class="alert alert-' . $this->type . '">';
        $str .= '<strong>' . ucfirst($this->type) . '!</strong> '.$this->message;
        $str .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        $str .= '</div>';
        return $str;
    }

}

?>
