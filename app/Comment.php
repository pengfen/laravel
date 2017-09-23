<?php

namespace App;

use App\Model;

class Comment extends Model
{
    protected  $table = "comments";

    // 评论所属文章
    public function article()
    {
        return $this->belongsTo('App\Article')->orderBy('created_at', 'desc');
    }

    // 用户
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
