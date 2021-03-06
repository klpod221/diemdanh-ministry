<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MajorModel extends Model
{
    use HasFactory;

    protected $table = 'major';
    protected $primaryKey = 'majorId';
    protected $fillable = ['majorId', 'majorName', 'majorStatus'];
    public $timestamps = false;
}
