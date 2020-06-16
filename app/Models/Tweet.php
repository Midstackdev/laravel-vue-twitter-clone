<?php

namespace App\Models;

use App\Tweets\Entities\EntityExtractor;
use App\Tweets\Entities\EntityType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{   
    /**
     * [$guarded description]
     * @var array
     */
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::created(function (Tweet $tweet) {
            $tweet->entities()->createMany(
                (new EntityExtractor($tweet->body))->getAllEntities()
            );
        });
    }

    /**
     * [scopeParent description]
     * @param  Builder $builder [description]
     * @return [type]           [description]
     */
    public function scopeParent(Builder $builder)
    {
        return $builder->whereNull('parent_id');
    }
    
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

    /**
     * [media description]
     * @return [type] [description]
     */
    public function media()
    {
        return $this->hasMany(TweetMedia::class);
    }

    /**
     * [replies description]
     * @return [type] [description]
     */
    public function replies()
    {
        return $this->hasMany(Tweet::class, 'parent_id');
    }

    /**
     * [entities description]
     * @return [type] [description]
     */
    public function entities()
    {
        return $this->hasMany(Entity::class);
    }

    public function mentions()
    {
        return $this->hasMany(Entity::class)
            ->whereType(EntityType::MENTION);
    }
}
