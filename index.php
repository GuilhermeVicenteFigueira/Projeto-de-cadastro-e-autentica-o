<?php

require_once "src/User.php";
require_once "src/UserManager.php";
require_once "src/Validator.php";



$user1 = new UserManager([]);
$user1->createUser(1,"Maria Oliveira","maria@email.com","Senha123.");

$user2 = new UserManager([]);
$user2->createUser(2,"Pedro","pedro@@email","Senha123");

$user3 = new UserManager([]);
$user3->createUser(3,"João","joao@email.com","Errada123");