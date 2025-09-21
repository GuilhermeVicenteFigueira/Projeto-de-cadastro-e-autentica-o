<?php 

require_once 'Validator.php';

class UserManager{

    private User $user;
    private array $users = [];

    public function __construct(User $user, array $users) 
        {
          $this->user = $user;
          $this->users =$users;
        }
     
    public function createUser(String $nome, string $email,string $senha): bool
    {
        if(!Validator->validateEmail($email))
        {
            echo "Email invalido";
            return false;
        }

        if(!Validator->validatePassword($senha))
        {
            echo "Senha invalida";
            return false;
        }

        if(!UserManager->hasSameEmail($email))
        {
            echo "Email Invalido";
            return false;
        }

        $passwordHash=Validator->createHash($senha);
         $user = new User(UUID_TYPE_RANDOM,$nome, $email, $passwordHash);
         $this->users[] = [
            'Id'=>$user->getId(),
            'Nome'=>$user->getNome(),
            'Email'=>$user->setEmail(),
            'Senha'=>$user->getPassword(),
        ];
        
    }

    public function hasSameEmail(string $email): bool
    {
        foreach($this->users as $index){
            if($index['Email']===$email)
                return false;
        }
            return true;
    }



    public function loginUser($user): void{

        if(!Validator->validateEmail($user))
        {
            echo "Email invalido";
        }

        if(!Validator->validatePassword($user))
        {
            echo "Senha invalida";
        }

        if(Validator->validateHash($user))
        {
            echo"Logado com sucesso";
        }

        echo"login não encontrado"; 
    }

  
    public function resetPassword(int $id, string $password): void{
        
        foreach($this->users as $key){
            if($key['Id']===$id){
                Validator->validatePassword($password);
                Validator->createHash($password);
                $this->user->setPassword($password);
                echo"Senha alterada com secesso!";
            }
            echo"Usuario não existe";
        }
    }
}