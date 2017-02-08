<?php
use SimpleFilmApp\DbConnect;
use SimpleFilmApp\Domain\Film;
use SimpleFilmApp\Domain\Certificate;
use SimpleFilmApp\Mapper\FilmMapper;
use SimpleFilmApp\Mapper\CertificateMapper;
require_once("SimpleFilmApp/Autoload.php");

$certMapper=new CertificateMapper(DbConnect::getConnection());
$cert = $certMapper->find(1);
echo "<p>".$cert->getName()." - ".$cert->getDescription()."</p>";


//1) Write some PHP code that will create an instance of FilmMapper and then use this object to retrieve the 3rd film from the database table. Display the title and age of this film.
//2) Write some PHP code that will display a list of all the certificates.
//3) Write some PHP code that will display a list of all the films.
//4) Have a look at the FilmMapper and CertificateMapper classes, they have a lot in common. Create an abstract Mapper class that both FilmMapper and CertificateMapper will inherit from. This week's lecture provides a similar example. 

//Harder questions
/*
5) So far we haven't created an associated between Film objects and Certificate objects. If you look in the Film class there is a certificate property and getter and setter methods for certificate. Can you modify the FilmMapper so that when film objects are created a certificate is assigned to the film. Here's some advice:
 - Change the SQL in find and findAll methods so that you do a join with the certificates table. You will then get an array that contains both the film and certificate details
 - In the FilmMapper's makeObject() method create an instance of CertificateMapper and call the CertificateMapper's makeObject() method to get a certificate object that you can then assign to the film. 
*/

/*
6) Can you implement insert methods in the Mapper classes. The insert method will accept an object as an argument. It will then run an SQL statement to insert a row using this object's properties. You will then need to use lastInsertId() to get the id number of the new row, and assign this to the object that has been inserted.

 

*/
// $film = $filmMapper->find(10);

// echo "<p>".$film->getTitle()."</p>";


// $films = $filmMapper->findAll();
// foreach($films as $film)
// {
// 	echo "<p>".$film->getTitle()." ".$film->getAge()."</p>";
// }


// $certMapper=new CertificateMapper(DbConnect::getConnection());
// $certs = $certMapper->findAll();
// foreach($certs as $cert)
// {
// 	echo "<p>".$cert->getName()."</p>";
// }

// $cert = $certMapper->find(3);
// echo "<p>".$cert->getName()."</p>";



?>
