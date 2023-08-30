<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Project;

class Type extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "types";

    protected $fillable = ['name', 'color'];

    public function projects(){
        return $this->hasMany(Project::class);
    }
}
