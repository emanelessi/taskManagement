<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Permission;

class Role extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // إذا كان لديك صلاحيات وترغب في إضافة هذه العلاقة، يمكنك فعل ذلك هنا:
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
