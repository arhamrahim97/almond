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


    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id')->withTrashed();
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id')->withTrashed();
    }
}
