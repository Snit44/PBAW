<?php
class Messages {
    public $messages = [];

    public function add($message) {
        $this->messages[] = $message;
    }

    public function isEmpty() {
        return empty($this->messages);
    }
}
?>
