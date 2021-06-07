<?php

namespace App\Observers;

use App\Table;

class TableObserver
{
    /**
     * Handle the table "created" event.
     *
     * @param  \App\Table  $table
     * @return void
     */
    public function created(Table $table)
    {
        //
    }

    /**
     * Handle the table "updated" event.
     *
     * @param  \App\Table  $table
     * @return void
     */
    public function updated(Table $table)
    {
        //
    }

    /**
     * Handle the table "deleted" event.
     *
     * @param  \App\Table  $table
     * @return void
     */
    public function deleted(Table $table)
    {
        //
    }

    /**
     * Handle the table "restored" event.
     *
     * @param  \App\Table  $table
     * @return void
     */
    public function restored(Table $table)
    {
        //
    }

    /**
     * Handle the table "force deleted" event.
     *
     * @param  \App\Table  $table
     * @return void
     */
    public function forceDeleted(Table $table)
    {
        //
    }
}
