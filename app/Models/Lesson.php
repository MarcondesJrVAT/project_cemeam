<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lesson extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    public function year(): BelongsTo
    {
        return $this->belongsTo(Year::class);
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'lesson_user', 'lesson_id', 'teacher_id');
    }


}
