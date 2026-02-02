<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'priority',
        'due_date',
        'is_completed',  
        'completed_at',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'due_date' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // Scope for completed tasks
    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true);
    }

    // Scope for incomplete tasks
    public function scopeIncomplete($query)
    {
        return $query->where('is_completed', false);
    }

    // Method to mark as complete
    public function markAsComplete()
    {
        $this->update([
            'is_completed' => true,
            'completed_at' => now(),
        ]);
    }

    // Method to mark as incomplete
    public function markAsIncomplete()
    {
        $this->update([
            'is_completed' => false,
            'completed_at' => null,
        ]);
    }
}
