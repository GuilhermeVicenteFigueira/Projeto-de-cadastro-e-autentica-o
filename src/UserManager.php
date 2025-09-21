<?php 

require_once 'Validator.php';

class UserManager{

    private array $users = [];

    public function __construct(array $users) 
        {
          $this->users =$users;
        }
     
    public function createUser(int $id, String $name, string $email,string $password): string
    {
        if(!Validator::validateEmail($email))
        {
            return "Email invalido";
        }

        if(!Validator::validatePassword($password))
        {
 
            return "Senha invalida";
        }

        if(UserManager::hasSameEmail($email))
        {
            
            return "Email já está em uso";
        }

        $passwordHash=Validator::createHash($password);

        $user = new User($id,$name, $email, $passwordHash);

        $this->users[] = [
            'Id'=>$user->getId(),
            'Nome'=>$user->getName(),
            'Email'=>$user->getEmail(),
            'password'=>$user->getPassword(),
        ]; 

        return "<br>Usuário cadastrado com sucesso!</br>";
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

        if(!Validator::validateEmail($user))
        {
            echo "Email invalido";
        }

        if(!Validator::validatePassword($user))
        {
            echo "Credenciais inválidas";
        }

        if(Validator::validateHash($user))
        {
            echo"Logado com sucesso";
        }

        echo"login não encontrado"; 
    }

  
    public function resetPassword(int $id, string $password): void{
        
        foreach($this->users as $key){
            if($key['Id']===$id){
                Validator::validatePassword($password);
                Validator::createHash($password);
                $this->user->setPassword($password);
                echo"Senha alterada com secesso!";
            }
            echo"Usuario não existe";
        }
    }
}