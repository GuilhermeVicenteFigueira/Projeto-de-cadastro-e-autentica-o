<?php 

require_once 'Validator.php';

class UserManager
{
    private User $user;
    
    private array $users = [];
     
    public function createUser(int $id, string $name, string $email, string $password): string
    {
        if (!Validator::validateEmail($email)) {
            return "Email invalido";
        }

        if (!Validator::validatePassword($password)) {
 
            return "Senha invalida";
        }

        if (UserManager::hasSameEmail($email)) {
            
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
        foreach ($this->users as $index) {

            if ($index['Email'] === $email) {
                return true;
            }
        }
        return false;
    }



   public function loginUser(string $email, string $password): string
{
    if (!Validator::validateEmail($email)) {
        return "Email inválido";
    }

    if (!Validator::validatePassword($password)) {
        return "Senha inválida";
    }

    if (!UserManager::hasSameEmail($email)) {
        return "Email não existe";
    }

    foreach ($this->users as $user) {
        if ($user['Email'] === $email && password_verify($password, $user['password'])) {
            return "Login feito com sucesso";
        }
    }

    return "Credenciais inválidas";
}


  
    public function resetPassword(string $email, string $password): void
{
            foreach ($this->users as &$user) { 
             if ($user['Email'] === $email) {
                    $user['password'] = Validator::createHash($password);
                    echo "Senha redefinida com sucesso para $email";
                    return;
            }
        }
            echo "Usuário não existe";
}


}


