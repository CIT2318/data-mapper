<?php
namespace SimpleFilmApp\Mapper;
use \PDO;
use SimpleFilmApp\Domain\Film;

class FilmMapper{
	private $conn;
	function __construct($conn)
	{
		$this->conn=$conn;
	}

	public function find($id){
		$stmt = $this->conn->prepare("SELECT * FROM films 
			INNER JOIN certificates ON films.certificate_id=certificates.id 
			WHERE films.id = :id");
		$stmt->bindValue(':id',$id);
		$stmt->execute();
		$filmArray = $stmt->fetch();
		$filmObject=$this->makeObject($filmArray);
		return $filmObject;
	}
	public function findAll(){
		$rows = $this->conn->query("SELECT * FROM films INNER JOIN certificates ON films.certificate_id=certificates.id");
		$arrOfFilms=[];
		foreach($rows as $filmArray)
		{
			$arrOfFilms[] = $this->makeObject($filmArray);
		}
		return $arrOfFilms;
	}
	public function makeObject(Array $filmArray)
	{
		$filmObject = new Film($filmArray["title"], $filmArray["year"], $filmArray["duration"]);
		$filmObject->setId($filmArray["id"]);
		return $filmObject;
	}
}
