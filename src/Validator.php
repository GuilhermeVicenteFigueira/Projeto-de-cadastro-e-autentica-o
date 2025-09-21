<?php 

class Validator{
  public static function validateEmail( User $user ): bool{
      if(!filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL))
      {
        return false;
      }
        return true;

    } 

  public static function validatePassword( string $password ): bool{
    if(strlen(trim($password))<8)
      {
        return false;
      }
        
    if(!preg_match('/[A-Z]/', $password))
      {
        return false;
      }

      return true;
     
    }

  public static function createHash( string $password): string{
      return password_hash($password, PASSWORD_DEFAULT);
    }

  public static function validateHash(string $senha, User $user) : bool{ 
    if(!password_verify($senha,$user->getPassword()))
      {
        return false;
      }
        
      return true;
    }
}