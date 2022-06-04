<?php

namespace App\Models;

use App\Traits\TraitUuid;
use App\Traits\Blameables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    use HasFactory;
    use TraitUuid;
    use Blameables;
    protected $table = 'file_upload';
    protected $guarded = ['id'];
}
