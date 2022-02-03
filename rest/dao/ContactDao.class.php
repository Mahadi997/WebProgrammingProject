<?php
require_once 'BaseDao.class.php';


class ContactDao extends BaseDao{

  public $table = 'contact';

  public function __construct(){
    parent::__construct($this->table);
  }

}

?>
