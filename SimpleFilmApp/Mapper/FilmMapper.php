<?php
namespace SimpleFilmApp\Mapper;
use \PDO;
use SimpleFilmApp\Domain\Film;
use SimpleFilmApp\Mapper\CertificateMapper;

class FilmMapper extends Mapper{


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

	public function insert($filmObject){
		$stmt = $this->conn->prepare("INSERT INTO films (id, title, year, duration, certificate_id) 
			VALUES (NULL, :title, :year, :duration, :certificateId)");
		$stmt->bindValue(':title',$filmObject->getTitle());
		$stmt->bindValue(':year',$filmObject->getYear());
		$stmt->bindValue(':duration',$filmObject->getDuration());
		if($filmObject->getCertificate()->getId()){
			$stmt->bindValue(':certificateId',$filmObject->getCertificate()->getId());
		}else{
			$certMapper=new CertificateMapper($this->conn);
			$certObject = $filmObject->getCertificate();
			$certMapper->insert($certObject);
			$stmt->bindValue(':certificateId',$certObject->getId());
		}
		
		$stmt->execute();
		$newFilmId = $this->conn->lastInsertId();
		$filmObject->setId($newFilmId);
	}

	public function makeObject(Array $filmArray)
	{
		//first get the certificate
		$certMapper=new CertificateMapper($this->conn);
		$certObject = $certMapper->makeObject($filmArray);
		//now make the film
		$filmObject = new Film($filmArray["title"], $filmArray["year"], $filmArray["duration"]);
		$filmObject->setId($filmArray["id"]);
		//assign the certificate to the film
		$filmObject->setCertificate($certObject);
		return $filmObject;
	}
}
