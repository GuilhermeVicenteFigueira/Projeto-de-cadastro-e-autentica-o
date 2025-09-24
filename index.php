<?php

require_once "src/User.php";
require_once "src/UserManager.php";
require_once "src/Validator.php";


$manager = new UserManager();

echo $manager->createUser(1,"Maria Oliveira","maria@email.com","Senha123.");
echo $manager->createUser(2,"Pedro","pedro@@email","Senha123");

echo $manager->createUser(3,"pedro","pedro@email.com","Senha123");


echo "<br>";
echo $manager->loginUser("pedro","Errada123");

echo "<br>";
echo $manager->loginUser("maria@email.com","Senha123.");


echo "<br>";
$manager->resetPassword("maria@email.com","NovaSenha@123");
