<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = ['nameC'];
    protected $guarded = ['id'];


    public function game()
    {
        return $this->hasMany(Game::class);
    }

}
