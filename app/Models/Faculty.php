<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'email',
        'contact_number',
        'thumbnail_path',
    ];

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }
}
