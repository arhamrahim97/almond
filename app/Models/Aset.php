<?php

namespace App\Models;

use App\Traits\Blameables;
use App\Traits\TraitUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;
    use TraitUuid;
    use Blameables;
    protected $table = 'aset';
    protected $guarded = ['id'];
}
