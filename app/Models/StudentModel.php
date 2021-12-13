<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    use HasFactory;

    protected $table = 'student';
    protected $primaryKey = 'studentId';
    protected $fillable = ['studentId', 'name', 'gender', 'dateOfBirth', 'phoneNumber', 'email', 'address', 'classId', 'studentStatus'];
    public $timestamps = false;
}
