<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Support\Enum;

/**
 * Description of MovieGenres
 *
 * @author Dinkic
 */
class MovieGenres
{
    const _ACTION = 'action';
    const _COMEDY = 'comedy';
    const _HORROR = 'horror';
    const _CRIME = 'crime';
    const _DRAMA = 'drama';
    const _MYSTERY = 'mystery';
    const _FANTASY = 'fantasy';
    const _THRILLER = 'thriller';

    public static function all()
    {
        return [
            self::_ACTION,
            self::_COMEDY,
            self::_HORROR,
            self::_CRIME,
            self::_DRAMA,
            self::_MYSTERY,
            self::_FANTASY,
            self::_THRILLER,

        ];
    }
    
    public static function stringify()
    {
        return implode(",", self::all());
    }
}
