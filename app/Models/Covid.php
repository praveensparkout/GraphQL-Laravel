<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Covid extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description','peopleAffected','deathCount','peopleVaccinated','is_lockdown'];
}
