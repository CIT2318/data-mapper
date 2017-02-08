<?php
namespace SimpleFilmApp\Domain;

class Certificate{
	private $id;
	private $name;
	private $description;
	function __construct($name,$description){
		$this->name=$name;
		$this->description=$description;
	}
	function setId($id){
		$this->id=$id;
	}
	function getId(){
		return $this->id;
	}
	function setName($name){
		$this->name=$name;
	}
	function getName(){
		return $this->name;
	}
	function setDescription($description){
		$this->description=$description;
	}
	function getDescription(){
		return $this->description;
	}
}
?>