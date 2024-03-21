<?php
class Topic {

  public $id;
  public $items;
  public $name;
  public $slug;

  public function __construct()
  {
    
  }

  public function getId() {
    return $this->id;
  }

  public function setId($value) {
    $this->id = $value;
  }

  public function getTopicName() {
    return $this->name;
  }

  public function setTopicName($value) {
    $this->name = $value;
  }

  public function getTopicSlug() {
    return $this->slug;
  }

  public function setTopicSlug($value) {
    $this->slug = $value;
  }

  public function getItems() {
    return $this->items;
  }

  public function setItems($value) {
    $this->items = $value;
  }
}
?>