<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Support\Enum;

/**
 * Description of UserStatuses
 *
 * @author Dinkic
 */
class UserStatuses
{
    const _NEW = 'New';
    const _UNCONFIRMED = 'Unconfirmed';
    const _ACTIVE = 'Active';
    const _INACTIVE = 'Inactive';
    const _BANNED = 'Banned';
    const _DELETED = 'Deleted';

    public static function all()
    {
        return [
            self::_NEW,
            self::_UNCONFIRMED,
            self::_ACTIVE,
            self::_INACTIVE,
            self::_BANNED,
            self::_DELETED,

        ];
    }
    
    public static function stringify()
    {
        return implode(",", self::all());
    }
}
