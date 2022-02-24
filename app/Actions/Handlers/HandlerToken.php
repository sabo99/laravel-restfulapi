<?php

namespace App\Actions\Handlers;

use App\Models\User;

/**
 * Handler Token Auth Sanctum
 */
class HandlerToken
{
    /**
     * Token Ability
     * 
     * @param  \App\Models\User $user
     * @return string
     */
    public static function generate(User $user)
    {
        $abilities = [];

        switch ($user->role_id) {
            case 1:
                array_push($abilities, '*');
                break;
            case 2:
                array_push($abilities, 'auth-logout', 'user-show', 'user-update', 'post-*', 'comment-*');
                break;
            default:
                array_push($abilities, '');
                break;
        }

        return $user->createToken($user->roles()->value('role_name'), $abilities)->plainTextToken;
    }
}
