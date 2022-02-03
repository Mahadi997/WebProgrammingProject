<?php
require_once 'BaseDao.class.php';


class MenuDao extends BaseDao{

  public $table = 'menu';

  public function __construct(){
    parent::__construct($this->table);
  }

  public function get_menu(){
    return $this->execute_query("SELECT m.menu_name, c.name from {$this->table} m JOIN chefs c ON m.chef_id = c.id", []);
}

}

?>
