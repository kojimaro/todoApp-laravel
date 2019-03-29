<?php

namespace App\Repositories;

use App\User;
use App\Group;
use PhpParser\Node\Stmt\GroupUse;

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

    /**
     * 特定グループ取得
     * @param string $groupId
     * @return Model
     * @throws ModelNotFoundException 404
     */
    public function getGroupId(string $groupId)
    {
        $groupId = (int) $groupId;
        return Group::findOrFail($groupId);
    }
}