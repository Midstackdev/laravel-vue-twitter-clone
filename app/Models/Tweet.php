<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{   
    /**
     * [$guarded description]
     * @var array
     */
    protected $guarded = [];
    
    /**
     * [user description]
     * @return [type] [description]
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * [originalTweet description]
     * @return [type] [description]
     */
    public function originalTweet()
    {
        return $this->hasOne(Tweet::class, 'id', 'original_tweet_id');
    }

    /**
     * [likes description]
     * @return [type] [description]
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * [retweets description]
     * @return [type] [description]
     */
    public function retweets()
    {
        return $this->hasMany(Tweet::class, 'original_tweet_id');
    }

    /**
     * [retweetedTweet description]
     * @return [type] [description]
     */
    public function retweetedTweet()
    {
        return $this->hasOne(Tweet::class, 'original_tweet_id', 'id');
    }
}
