<?php

namespace App\Models;

use App\Traits\TraitUuid;
use App\Traits\Blameables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruangan extends Model
{
    use HasFactory;
    use TraitUuid;
    use Blameables;
    use SoftDeletes;
    protected $table = 'ruangan';
    protected $guarded = ['id'];
}
