<?php

namespace App;

use App\Model;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use Searchable;

    // 定义索引里面的类型
    public function searchableAs()
    {
        return "article";
    }

    // 定义需要搜索的字段
    public function toSearchableArray()
    {
        return [
            'title' => $this->true,
            'content' => $this->content,
        ];
    }

    // 关联用户
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // 评论模型
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    // 赞关联
    public function zan($user_id)
    {
        return $this->hasOne(\App\Zan::class)->where('user_id', $user_id);
    }

    // 文章的所有赞
    public function zans()
    {
        return $this->hasMany(\App\Zan::class);
    }
}
