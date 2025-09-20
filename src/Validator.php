<?php 

class Validator{
    public static function validateEmail( User $user ): bool{
          if(!filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)){
            return false;
          }
           return true;
    } 

    public static function validatePassword( User $user ): bool{
        if(strlen(trim($user->getPassword()))<8){
           return false;
        }
        
        if(!preg_match('/[A-Z]/', $user->getPassword())){
            return false;
        }

        return true;
        
      }

      public static function createHash( User $user ): void{
         $user->setPassword(password_hash($user->getPassword(), PASSWORD_DEFAULT));
      }

      public static function validateHash(string $senha, User $user) : bool{ 
      if(!password_verify(senha,$user->getPassword())){
          return false;
         }
        
         return true;
    }   
}