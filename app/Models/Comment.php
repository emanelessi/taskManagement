<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Comment extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $guarded = [];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
