<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $table = 'skill';
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'status'

    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function userSkill()
    {
        return $this->hasOne(UserSkill::class, 'skill_id');
    }
    
}
