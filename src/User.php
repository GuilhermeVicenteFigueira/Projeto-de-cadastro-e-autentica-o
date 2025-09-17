<?php
class User {
    private int $id;
    private string $name;
    private string $email;
    private string $password;

    public function __construct(int $id, string $name, string $email, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getNome(): string 
    {
        return $this->name;
    }

    public function getEmail(): string 
    {
        return $this->email;
    }


      public function setId(int $id): void {
        $this->id = $id;
    }

    public function setNome(string $name): void {
        $this->name = $name;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    }