<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $fillable = ['firstname', 'lastname', 'gender','laptop_name','serial_number', 'department', 'profession', 'identification', 'img'];
    protected $primaryKey = 'id';
    // public $timestamps = false;

    // use HasFactory;
}
