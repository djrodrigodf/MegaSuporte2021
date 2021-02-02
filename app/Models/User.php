<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Carbon\Carbon;
use Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use \DateTimeInterface;

class User extends Authenticatable
{
    use HasAdvancedFilter, SoftDeletes, Notifiable, HasFactory;

    public $table = 'users';

    protected $appends = [
        'sex_label',
    ];

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $dates = [
        'email_verified_at',
        'birthdate',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const SEX_SELECT = [
        [
            'label' => 'Masculino',
            'value' => 'M',
        ],
        [
            'label' => 'Feminino',
            'value' => 'F',
        ],
        [
            'label' => 'Nenhum',
            'value' => 'N',
        ],
    ];

    protected $orderable = [
        'id',
        'name',
        'email',
        'email_verified_at',
        'phone_primary',
        'phone_secundary',
        'birthdate',
        'sex',
        'active',
        'customer_user_otrs',
        'first_access',
        'cliente',
        'endereco_cliente',
        'preferencia',
    ];

    protected $filterable = [
        'id',
        'name',
        'email',
        'email_verified_at',
        'roles.title',
        'phone_primary',
        'phone_secundary',
        'birthdate',
        'sex',
        'active',
        'customer_user_otrs',
        'first_access',
        'cliente',
        'endereco_cliente',
        'preferencia',
    ];

    protected $fillable = [
        'role_id',
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'phone_primary',
        'phone_secundary',
        'birthdate',
        'sex',
        'active',
        'customer_user_otrs',
        'first_access',
        'cliente',
        'endereco_cliente',
        'preferencia',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('title', 'Admin')->exists();
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('project.datetime_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = Hash::needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getBirthdateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.date_format')) : null;
    }

    public function setBirthdateAttribute($value)
    {
        $this->attributes['birthdate'] = $value ? Carbon::createFromFormat(config('project.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getSexLabelAttribute()
    {
        return collect(static::SEX_SELECT)->firstWhere('value', $this->sex)['label'] ?? '';
    }
}
