<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Student extends Model implements AuthenticatableContract 
{
    use HasFactory,Authenticatable;
    protected $table = "students";
    protected $fillable = ['first_name', 'last_name', 'email', 'phone','password','gender','google_id','device_token'];
}
