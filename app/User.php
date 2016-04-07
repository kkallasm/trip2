<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'role', // Why?
        'verified', // Why?
        'registration_token', // Why?
        'contact_facebook',
        'contact_twitter',
        'contact_instagram',
        'contact_homepage',

        'real_name',
        'show_real_name',
        'gender',
        'birthyear',
        'description',

        'notify_message',
        'notify_follow',

    ];

    protected $hidden = ['password', 'remember_token'];

    public $messages_count = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {

            $user->registration_token = str_random(30);

        });
    }

    public function confirmEmail()
    {
        $this->verified = true;
        $this->registration_token = null;
        $this->save();
    }

    public function unreadMessagesCount()
    {
        if ($this->messages_count === false) {
            $this->messages_count = $this->hasMany('App\Message', 'user_id_to')
                ->where('read', '0')
                ->get()
                ->unique('user_id_from')
                ->count();
        }

        return $this->messages_count;
    }

    public function messages()
    {
        $received = $this->hasMany('App\Message', 'user_id_to')
            ->get()
            ->sortByDesc('created_at')
            ->unique('user_id_from')
            ->transform(function ($item) {
                $item->attributes['user_id_with'] = $item->attributes['user_id_from'];

                return $item;
            });

        $sentWithoutReply = $this->hasMany('App\Message', 'user_id_from')
            ->whereNotIn('user_id_to', $received->pluck('user_id_from')->all())
            ->get()
            ->transform(function ($item) {
                $item->attributes['user_id_with'] = $item->attributes['user_id_to'];

                return $item;
            });

        return $received->merge($sentWithoutReply)->sortByDesc('created_at')->all();
    }

    public function messagesWith($user_id_with)
    {
        $sent = $this->hasMany('App\Message', 'user_id_from')->where('user_id_to', $user_id_with)->get();
        $received = $this->hasMany('App\Message', 'user_id_to')->where('user_id_from', $user_id_with)->get();

        return $sent->merge($received)->sortBy('created_at');
    }

    public function contents()
    {
        return $this->hasMany('App\Content');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function flags()
    {
        return $this->hasMany('App\Flag');
    }

    public function follows()
    {
        return $this->hasMany('App\Follow');
    }

    public function images()
    {
        return $this->morphToMany('App\Image', 'imageable');
    }

    public function imagePreset($preset = 'small_square')
    {
        $image = null;

        if (count($this->images)) {
            $image = config('imagepresets.presets.'.$preset.'.path').$this->images[0]->filename;
        }

<<<<<<< HEAD
        if (! file_exists($image)) {
=======
        if (! $image || ! file_exists(public_path().$image)) {
>>>>>>> master
            $image = config('imagepresets.image.none');
        } else {
            $image = config('imagepresets.presets.'.$preset.'.displaypath').$this->images[0]->filename;
        }

        return $image;
    }

    public function hasRole($role)
    {
        $roleMap = [
            'regular' => ['regular', 'admin', 'superuser'],
            'admin' => ['admin', 'superuser'],
            'superuser' => ['superuser'],
        ];

        return in_array($this->role, $roleMap[$role]);
    }

    public function hasRoleOrOwner($role, $ownable_user_id)
    {
        return $this->hasRole($role) || $ownable_user_id == $this->id;
    }

    public function destinationHaveBeen()
    {
        return $this->flags->where('flag_type', 'havebeen');
    }

    public function destinationWantsToGo()
    {
        return $this->flags->where('flag_type', 'wantstogo');
    }
}
