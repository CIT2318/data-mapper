<?php
use SimpleFilmApp\DbConnect;
use SimpleFilmApp\Domain\Film;
use SimpleFilmApp\Domain\Certificate;
use SimpleFilmApp\Mapper\FilmMapper;
use SimpleFilmApp\Mapper\CertificateMapper;

function myAutoLoader($class_name) {
    require_once($class_name . '.php');
};

spl_autoload_register('myAutoLoader');

$filmMapper=new FilmMapper(DbConnect::getConnection());

$film = $filmMapper->find(10);

echo "<p>".$film->getTitle()."</p>";


$films = $filmMapper->findAll();
foreach($films as $film)
{
	echo "<p>".$film->getTitle()." ".$film->getAge()."</p>";
}


$certMapper=new CertificateMapper(DbConnect::getConnection());
$cert = $certMapper->find(4);
echo "<p>".$cert->getName()."</p>";


$newCert = new Certificate("w","w");
echo "<p>".$newCert->getName()."</p>";
$anotherNewFilm = new Film("fw","1991",101);
echo "<p>".$anotherNewFilm->getTitle()."</p>";
$anotherNewFilm->setCertificate($newCert);
echo "<p>".$anotherNewFilm->getCertificate()->getId()."</p>";

$filmMapper->insert($anotherNewFilm);
echo "<p>".$anotherNewFilm->getId()."</p>";
echo "<p>".$anotherNewFilm->getCertificate()->getId()."</p>";

?>
