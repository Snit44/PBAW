<?php
namespace App\Core;
class Messages {
    private $messages = [];
    public function add($msg) {
        $this->messages[] = $msg;
    }
    public function isEmpty() {
        return empty($this->messages);
    }
    public function getMessages() {
        return $this->messages;
    }
}
