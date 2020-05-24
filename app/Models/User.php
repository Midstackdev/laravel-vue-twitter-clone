<?php

namespace App\Models;

use App\Tweets\TweetType;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * [avatar description]
     * @return [type] [description]
     */
    public function avatar()
    {
        return 'https://www.gravatar.com/avatar/' . md5($this->email) . '?d=mp';
    }

    /**
     * [hasLiked description]
     * @param  Tweet   $tweet [description]
     * @return boolean        [description]
     */
    public function hasLiked(Tweet $tweet)
    {
        return $this->likes->contains('tweet_id', $tweet->id);
    }

    /**
     * [tweets description]
     * @return [type] [description]
     */
    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    /**
     * [following description]
     * @return [type] [description]
     */
    public function following()
    {
        return $this->belongsToMany(
            User::class, 'followers', 'user_id', 'following_id'
        );
    }

    /**
     * [followers description]
     * @return [type] [description]
     */
    public function followers()
    {
        return $this->belongsToMany(
            User::class, 'followers', 'following_id', 'user_id'
        );
    }

    /**
     * [tweetsFromFollowing description]
     * @return [type] [description]
     */
    public function tweetsFromFollowing()
    {
        return $this->hasManyThrough(
            Tweet::class, Follower::class, 'user_id', 'user_id', 'id', 'following_id'
        );
    }

    /**
     * [likes description]
     * @return [type] [description]
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function retweets()
    {
        return $this->hasMany(Tweet::class)
            ->where('type', TweetType::RETWEET)
            ->orWhere('type', TweetType::QUOTE);
    }
}
