<?php
class Post {
  private $content;
  private $description;
  private $id;
  private $slug;
  private $title;

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

  public function getObjectPost() {
    return [
      'id' => $this->getId(),
      'content' => $this->getContent(),
      'description' => $this->getPostDescription(),
      'slug' => $this->getPostSlug(),
      'title' => $this->getPostTitle()
    ];
  }
}
?>