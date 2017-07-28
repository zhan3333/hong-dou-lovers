<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token', 'headimg_url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    /**
     * 处理用户头像url
     * @param $value
     * @return string
     */
    public function getHeadimgUrlAttribute($value)
    {
        if ($value) {
            return config('app.url') . \Storage::url($value);
        } else {
            $headimgs = \Storage::disk('images')->files('headimg');
            $headimg = array_random($headimgs, 1)[0];
            $path = \Storage::disk('images')->url($headimg);
            return $path;
        }
    }
}
