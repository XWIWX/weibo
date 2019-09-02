<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * 质量可分配的属性。
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * 应该为数组隐藏的属性。
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     * 应该转换为本机类型的属性。
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 获取头像
     * @param string $size
     * @return string
     */
    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user){
            $user->activation_token = Str::random(10); //生成一个更真实的“随机”字母数字字符串。
        });
    }

    public function statuses()
    {
        return $this->belongsTo(Status::class);
    }
}
