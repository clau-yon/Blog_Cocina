<?php

    class Comment {
        private $text;
        private $author;

        public function __construct($text, $author) {
            $this->text = $text;
            $this->author = $author;
        }

        public function getText() {
            return $this->text;
        }

        public function getAuthor() {
            return $this->author;
        }
    }
?>