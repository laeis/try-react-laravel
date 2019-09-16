<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = ['name', 'description'];

    /**
     * 
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * 
     */
    public function scopeActive($query) {
        return $query->where('is_compleated', false);
    }
}
