<?php

namespace App\Models;

use App\Models\Pegawai;
use App\Traits\TraitUuid;
use App\Models\FileUpload;
use App\Traits\Blameables;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AsetTidakBergerak extends Model
{
    use HasFactory;
    use TraitUuid;
    use Blameables;
    protected $table = 'aset_tidak_bergerak';
    protected $guarded = ['id'];

    public function aset()
    {
        return $this->belongsTo(AsetTidakBergerak::class, 'aset_id');
    }

    public function fileUploadAll()
    {
        return $this->hasMany(FileUpload::class, 'another_id')->orderBy('is_sampul', 'desc');
    }

    public function fileUploadGambar()
    {
        return $this->hasMany(FileUpload::class, 'another_id')->where('jenis_file', 'Gambar')->orderBy('is_sampul', 'desc')->orderBy('urutan', 'asc');
    }

    public function fileUploadDokumen()
    {
        return $this->hasMany(FileUpload::class, 'another_id')->where('jenis_file', 'Dokumen')->orderBy('urutan', 'asc');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id')->withTrashed();
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
