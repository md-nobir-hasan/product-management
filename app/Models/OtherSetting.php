<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherSetting extends Model
{
    use HasFactory;
    protected $fillable=['branch_id','fb','youtube','twitter', 'linkedin'];
}
