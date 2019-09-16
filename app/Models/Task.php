<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = ['title', 'project_id'];

    /**
     * 
     */
    public function scopeActive($query) {
        return $query->where('is_compleated', false);
    }
}
