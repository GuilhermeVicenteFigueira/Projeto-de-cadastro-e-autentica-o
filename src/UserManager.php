<?php 

require_once 'Validator.php';

class UserManager
{
    private array $users = [];

    public function __construct(array $users) 
    {
        $this->users = $users;
    }
     
    public function createUser(int $id, string $name, string $email, string $password): string
    {
        if(! Validator::validateEmail($email))
        {
            return "Email invalido";
        }

        if(! Validator::validatePassword($password))
        {
 
            return "Senha invalida";
        }

        if(UserManager::hasSameEmail($email))
        {
            
            return "Email já está em uso";
        }

        $passwordHash = Validator::createHash($password);

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
        foreach($this->users as $index) {
            if($index['Email'] === $email)
                return true;
        }
            return false;
    }



    public function loginUser(string $email, string $password): void{

        foreach($this->users as $user) {
            if($user['Email'] === $email && Validator::validateHash($password, new User($user['Id'], $user['Nome'], $user['Email'], $user['password']))) {
                echo "Logado com sucesso";
                return;
            }
        }
        echo "credenciais invalidas";
    }

  
    public function resetPassword(int $id, string $password): void
    {
        foreach($this->users as &$user) {

            if($user['Id'] === $id)
            {
                if(!Validator::validatePassword($password))
                {
                    echo "Senha inválida";
                    return;
                }
                $user['password'] = Validator::createHash($password);
                echo "Senha alterada com sucesso!";
                return;
            }
        }
        echo "Usuário não existe";
    }
}