<?php

namespace App\Models;

use App\Models\User;
use App\Traits\TraitUuid;
use App\Models\FileUpload;
use App\Traits\Blameables;
use App\Models\AsetTidakBergerak;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ruangan extends Model
{
    use HasFactory;
    use TraitUuid;
    use Blameables;
    use SoftDeletes;
    protected $table = 'ruangan';
    protected $guarded = ['id'];

    public function asetTidakBergerak()
    {
        return $this->hasMany(AsetTidakBergerak::class, 'ruangan_id')->orderBy('created_at', 'desc');
    }

    public function fileUploadGambar()
    {
        return $this->hasMany(FileUpload::class, 'another_id')->where('jenis_file', 'Gambar')->orderBy('is_sampul', 'desc')->orderBy('urutan', 'asc');
    }

    public function fotoSampul()
    {
        return $this->hasOne(FileUpload::class, 'another_id')->where('jenis_file', 'Gambar')->where('is_sampul', 1);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
