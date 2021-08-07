<?php

include_once('vendor/autoload.php');

use Memed\HTTP\Client;
use Memed\DTO\Doctor;
use Memed\DoctorToolkit;

$Client = new Client();

$Doctor = new Doctor();
$Doctor->nome = 'Fulano';
$Doctor->sobrenome = 'De Tal';
$Doctor->external_id = 'ABC123';
$Doctor->crm = '123';
$Doctor->sexo = 'M';
$Doctor->data_nascimento = '01/01/1990';
$Doctor->email = 'test@test.net';

$Client->setApiKey('iJGiB4kjDGOLeDFPWMG3no9VnN7Abpqe3w1jEFm6olkhkZD6oSfSmYCm');
$Client->setApiSecret('Xe8M5GvBGCr4FStKfxXKisRo3SfYKI7KrTMkJpCAstzu2yXVN4av5nmL');


$t = new DoctorToolkit($Client);

$t->signupDoctor($Doctor);


