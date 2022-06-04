<?php

namespace App\Models;

use App\Traits\TraitUuid;
use App\Traits\Blameables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use HasFactory;
    use TraitUuid;
    use Blameables;
    use SoftDeletes;
    protected $table = 'pegawai';
    protected $guarded = ['id'];

    public function jabatanStruktural()
    {
        return $this->belongsTo(JabatanStruktural::class, 'jabatan_struktural_id');
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
