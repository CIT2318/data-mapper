<?php
namespace SimpleFilmApp\Mapper;
use \PDO;
use SimpleFilmApp\Domain\Certificate;
class CertificateMapper extends Mapper{
	public function find($id){
		$stmt = $this->conn->prepare("SELECT * FROM certificates WHERE certificates.id = :id");
		$stmt->bindValue(':id',$id);
		$stmt->execute();
		$certificateArray = $stmt->fetch();
		$certObject=$this->makeObject($certificateArray);
		return $certObject;
	}
	public function findAll(){
		$rows = $this->conn->query("SELECT * FROM certificates");
		$arrOfCerts=[];
		foreach($rows as $certArray)
		{
			$arrOfCerts[] = $this->makeObject($certArray);
		}
		return $arrOfCerts;
	}
	public function insert($certObject){
		$stmt = $this->conn->prepare("INSERT INTO certificates (id, name, description) 
			VALUES (NULL, :name, :description)");
		$stmt->bindValue(':name',$certObject->getName());
		$stmt->bindValue(':description',$certObject->getDescription());
		$stmt->execute();
		$newCertId = $this->conn->lastInsertId();
		$certObject->setId($newCertId);
	}

	public function makeObject(Array $certificateArray)
	{
		$certObject = new Certificate($certificateArray["name"], $certificateArray["description"]);
		$certObject->setId($certificateArray["id"]);
		return $certObject;
	}
}
