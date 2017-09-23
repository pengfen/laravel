<?php

namespace App\Policies;

use App\Article;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // 修改文章权限
    public function update(User $user, Article $article)
    {
        return $user->id == $article->user_id;
    }

    // 删除文章权限
    public function delete(User $user, Article $article)
    {
        return $user->id == $article->user_id;
    }
}
