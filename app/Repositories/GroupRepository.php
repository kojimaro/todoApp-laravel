<?php

namespace App\Repositories;

use App\User;
use App\Group;

class GroupRepository
{
    /**
     * 指定ユーザーの全グループ取得
     * 
     * @param User $user
     * @return Collection
     */
    public function forOwner(User $user)
    {
        return Group::where('user_id', $user->id)->orderBy('created_at', 'asc')->get();
    }
}