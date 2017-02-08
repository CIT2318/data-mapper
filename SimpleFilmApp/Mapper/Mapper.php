<?php
namespace SimpleFilmApp\Mapper;
use \PDO;

abstract class Mapper{
	protected $conn;
	function __construct($conn)
	{
		$this->conn=$conn;
	}
	abstract public function find($id);
	abstract public function findAll();
	//abstract public function insert($obj);
	//abstract public function delete($obj);
	//abstract public function update($obj);
	abstract public function makeObject(Array $arr);

}


?>