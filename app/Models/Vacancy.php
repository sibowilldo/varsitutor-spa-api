<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'department_id',
        'category_id',
        'type_id',
        'title',
        'description',
        'location',
    ];

    protected $casts = [
        'expires_at' => 'date',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Favorite::class);
    }

    public function requirements(): BelongsToMany
    {
        return $this->belongsToMany(Requirement::class)->withPivot('rating');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
