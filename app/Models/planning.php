<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class planning extends Model
{
    use HasFactory;


    protected $fillable = ['DocName','speciality','plan_date','start_time','end_time'];
}
