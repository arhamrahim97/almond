<?php

namespace App\Models;

use App\Models\User;
use App\Models\Pegawai;
use App\Traits\TraitUuid;
use App\Models\FileUpload;
use App\Traits\Blameables;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AsetBergerak extends Model
{
    use HasFactory;
    use TraitUuid;
    use Blameables;
    protected $table = 'aset_bergerak';
    protected $guarded = ['id'];

    public function fileUpload()
    {
        return $this->hasMany(FileUpload::class, 'another_id')->orderBy('is_sampul', 'desc');
    }

    public function fileUploadGambar()
    {
        return $this->hasMany(FileUpload::class, 'another_id')->where('jenis_file', 'Gambar')->orderBy('is_sampul', 'desc');
    }

    public function fileUploadDokumen()
    {
        return $this->hasMany(FileUpload::class, 'another_id')->where('jenis_file', 'Dokumen')->orderBy('urutan', 'asc');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id')->withTrashed();
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by')->withTrashed();
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by')->withTrashed();
    }
}
