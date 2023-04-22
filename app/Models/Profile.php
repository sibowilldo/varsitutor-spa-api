<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'given_name',
        'family_name',
        'name',
        'contact_number',
        'province_city'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
