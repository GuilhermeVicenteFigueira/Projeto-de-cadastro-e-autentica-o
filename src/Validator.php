<?php 

class Validator{
    public static function validateEmail( User $user ): bool{
          if(!filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)){
            return false;
          }
           return true;
    } 

    public static function validatePassword( User $user ): bool{
        if($user->get)
      }

}