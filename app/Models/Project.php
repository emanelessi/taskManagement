<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Project extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $guarded = [];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user')
            ->withPivot('role_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function teamMembers()
    {
        return $this->belongsToMany(User::class, 'project_user')->withPivot('role_id');
    }

    // علاقة خاصة لمديري المشاريع
    public function managers()
    {
        $managerRole = Role::where('name', 'project manager')->first();
        if (!$managerRole) {
            return $this->teamMembers()->whereRaw('1 = 0');
        }

        return $this->teamMembers()->wherePivot('role_id',$managerRole->id );
    }



}
