<?php

namespace App\Models;

use App\Enums\StatusModelTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    protected $with = ['favorites'];

    protected $casts = [
        'expires_at' => 'date',
    ];

    public function approve()
    {
        $status = Status::where([
            'name' => 'approved',
            'model_type' => StatusModelTypeEnum::VACANCIES])
            ->firstOrFail();

        $this->status_id = $status->id;
        $this->save();
    }

    public function reject()
    {
        $status = Status::where([
            'name' => 'rejected',
            'model_type' => StatusModelTypeEnum::VACANCIES])
            ->firstOrFail();

        $this->status_id = $status->id;
        $this->save();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
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
