<?php
namespace SimpleFilmApp\Mapper;
use \PDO;
use SimpleFilmApp\Domain\Certificate;

class CertificateMapper {
	private $conn;
	function __construct($conn)
	{
		$this->conn=$conn;
	}
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
		$arrOfCertificates=[];
		foreach($rows as $certificateArray)
		{
			$arrOfCertificates[] = $this->makeObject($certificateArray);
		}
		return $arrOfCertificates;
	}


	public function makeObject(Array $certificateArray)
	{
		$certObject = new Certificate($certificateArray["name"], $certificateArray["description"]);
		$certObject->setId($certificateArray["id"]);
		return $certObject;
	}
}
