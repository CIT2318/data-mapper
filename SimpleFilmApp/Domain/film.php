<?php
namespace SimpleFilmApp\Domain;
class Film{
	private $id;
	private $title;
	private $year;
	private $duration;
	private $certificate;

	function __construct($title,$year,$duration){
		$this->title=$title;
		$this->year=$year;
		$this->duration=$duration;
	}

	function setId($id){
		$this->id=$id;
	}
	function getId(){
		return $this->id;
	}
	function setTitle($title){
		$this->title=$title;
	}
	function getTitle(){
		return $this->title;
	}
	function setYear($year){
		$this->year=$year;
	}
	function getYear(){
		return $this->year;
	}
	function setDuration($duration){
		$this->Duration=$duration;
	}
	function getDuration(){
		return $this->duration;
	}
	function getAge(){
		$thisDate = \DateTime::createFromFormat('Y', $this->year);
		$currentDate = new \DateTime("NOW");
		$diff=$thisDate->diff($currentDate);
		return $diff->format('%Y');
	}
	function setCertificate(Certificate $certificate){
		$this->certificate=$certificate;
	}
	function getCertificate(){
		return $this->certificate;
	}
	
}

?>