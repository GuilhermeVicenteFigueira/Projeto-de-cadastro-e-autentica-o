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
     
    public function createUser(User $user): bool
    {
        if(!Validator->validateEmail($user))
        {
            echo "Email invalido";
            return false;
        }

        if(!Validator->validatePassword($user->getPassword()))
        {
            echo "Senha invalida";
            return false;
        }

        if(!UserManager->hasSameEmail($user))
        {
            echo "Email Invalido";
            return false;
        }

        Validator->createHash($user);

        $this->users[] = [
            'Id'=>$user->getId(),
            'Nome'=>$user->getNome(),
            'Email'=>$user->setEmail(),
            'Senha'=>$user->getPassword(),
        ];
        
    }

    public function hasSameEmail($user): bool
    {
        foreach($this->user as $index){
            if($user['Email']===$user)
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