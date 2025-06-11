<?php

namespace App\Models;

use App\Notifications\AdminResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = ['id'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'role',
        'password',
    ];

    public function adminRole(): BelongsTo
    {
        return $this->belongsTo(AdminRole::class, 'role');
    }

    public static function getRoleName($roleId) 
    {
        $adminRole = DB::table('admin_roles')->where('id', $roleId)->first();
        return $adminRole->title;
    }

    /**
     * Send a password reset notification to the user.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPassword($token));
    }
}
