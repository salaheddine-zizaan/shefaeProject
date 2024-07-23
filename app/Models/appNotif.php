<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appNotif extends Model
{
    use HasFactory;
    protected $fillable = ['patientFName','patientLName','patientCIN','planDoc','patientContact','patientSex','appDesc','speciality','appId','planDate','appType','appTime','appStatus','appPaiement','patientNais','adminR','notifStatus'];

}
