<?php

class Messages {
    private $messages = [];

    public function add($message) {
        $this->messages[] = $message;
    }

    public function isEmpty() {
        return empty($this->messages);
    }

    public function getMessages() {
        return $this->messages;
    }

    public function clear() {
        $this->messages = [];
    }
}
