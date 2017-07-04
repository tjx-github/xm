<?php
spl_autoload_register(function ($class) {
    include_once __DIR__."/".$class . '.php';
});
class T_autoload extends bb_autoload{
    use Trait_;
    public static function i(){
        self::code();
       self::ix();
    }
}

