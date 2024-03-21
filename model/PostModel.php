<?php
class Post {
  public $content;
  public $description;
  public $id;
  public $slug;
  public $title;

  public function __construct()
  {
    
  }

  public function getContent() {
    return $this->content;
  }

  public function setContent($value) {
    $this->content = $value;
  }

  public function getPostDescription() {
    return $this->description;
  }

  public function setPostDescription($value) {
    $this->description = $value;
  }

  public function getId() {
    return $this->id;
  }

  public function setId($value) {
    $this->id = $value;
  }

  public function getPostSlug() {
    return $this->slug;
  }

  public function setPostSlug($value) {
    $this->slug = $value;
  }

  public function getPostTitle() {
    return $this->title;
  }

  public function setPostTitle($value) {
    $this->title = $value;
  }
}
?>