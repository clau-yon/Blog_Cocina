<?php
    class Post {
        private $title;
        private $content;
        private $author;

        public function __construct($title, $content, $author) {
            $this->title = $title;
            $this->content = $content;
            $this->author = $author;
        }

        public function getTitle() {
            return $this->title;
        }

        public function getContent() {
            return $this->content;
        }

        public function getAuthor() {
            return $this->author;
        }
    }
?>