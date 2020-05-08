<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Support\Enum;

/**
 * Description of MoviesActorRoleTypes
 *
 * @author Dinkic
 */
class MoviesActorRoleTypes
{
    const _MAIN = 'main';
    const _SUPPORT = 'support';

    public static function all()
    {
        return [
            self::_MAIN,
            self::_SUPPORT,

        ];
    }
    
    public static function stringify()
    {
        return implode(",", self::all());
    }
}
