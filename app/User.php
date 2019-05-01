<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    //
    protected $guarded = [];

    /**
     * Genders
     */
    public static $genders = [
        1   =>      '男',
        2   =>      '女',
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
     * Related Columnist
     */
    public function columnist()
    {
        return $this->hasOne('App\Columnist');
    }

    /**
     * Guest Avatar
     */
    public static function guestAvatar()
    {
        return '/images/user/avatars/guest.jpg';
    }

    /**
     * Get Avatar Attribute
     */
    public function getAvatarAttribute($value)
    {
        return makeCdnAssetPath($value, '?imageView2/2/w/400');
    }

    /**
     * Get Avatar Attribute
     */
    public function getProfileBgImgAttribute($value)
    {
        return makeCdnAssetPath($value, '?imageView2/2/w/1500');
    }

    /**
     * Get Bio Attribute
     */
    public function getBioAttribute($value)
    {
        if ($value) {
            return $value;
        } else {
            return '暂无签名';
        }
    }
}
