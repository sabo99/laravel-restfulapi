<?php

namespace App\Actions\Handlers;

use App\Models\RoleAbility;
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
        foreach (RoleAbility::where('role_id', $user->role_id)->get() as $value) {
            array_push($abilities, $value['abilities']->ability);
        }

        return $user->createToken($user->roles()->value('role_name'), $abilities)->plainTextToken;
    }
}
