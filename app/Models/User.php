<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $fillable = [
        'firstname', 'secname', 'thirdname', 'lastname',
        'email', 'phone_no', 'password', 'image', 'role_id',
    ];
    
    

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'force_logout' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
    public function student()
    {
        return $this->hasOne(Student::class);
    }
    
    public function teacherProfile()
    {
        return $this->hasOne(TeacherProfile::class);
    }

    // Add these security methods
    public function forcePasswordReset()
    {
        $this->update([
            'force_logout' => true,
            'password' => Hash::make(Str::random(10)) // Temporary password
        ]);
    }
public function logoutAllSessions()
{
    DB::table('sessions')
        ->where('user_id', $this->id)
        ->delete();
    
    $this->force_logout = true;
    $this->save();
}

public function getImageUrlAttribute()
{
    return $this->image ? Storage::url($this->image) : asset('images/user.jpg');
}
}

