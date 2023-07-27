<?php

namespace Database\Seeders\Traits;

use Illuminate\Support\Facades\DB;

trait ToggleForeignChecks {

    protected function disableCheck() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
    }

    protected function enableCheck() {
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}