<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BlameableObserver
{
    /**
     * Handle the Observer "created" event.
     *
     * @param  \App\Models\Observer  $observer
     * @return void
     */
    public function creating(Model $model)
    {
        $model->created_by = Auth::user()->id ?? '5gf9ba91-4778-404c-aa7f-5fd327e87e80';
        $model->updated_by = Auth::user()->id ?? '5gf9ba91-4778-404c-aa7f-5fd327e87e80';
    }

    public function updating(Model $model)
    {
        $model->updated_by = Auth::user()->id ?? '5gf9ba91-4778-404c-aa7f-5fd327e87e80';
    }
}
