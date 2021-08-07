<?php

include_once('vendor/autoload.php');

use Memed\HTTP\Client;
use Memed\DTO\Doctor;
use Memed\DoctorToolkit;

$Client = new Client();

$Client->setApiKey('iJGiB4kjDGOLeDFPWMG3no9VnN7Abpqe3w1jEFm6olkhkZD6oSfSmYCm');
$Client->setApiSecret('Xe8M5GvBGCr4FStKfxXKisRo3SfYKI7KrTMkJpCAstzu2yXVN4av5nmL');


$t = new DoctorToolkit($Client);

var_dump($t->getDoctorInfo('ABC123'));


