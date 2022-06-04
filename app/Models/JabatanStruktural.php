<?php

namespace App\Models;

use App\Traits\TraitUuid;
use App\Traits\Blameables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanStruktural extends Model
{
    use HasFactory;
    use TraitUuid;
    use Blameables;
    protected $table = 'jabatan_struktural';
    protected $guarded = ['id'];
}
