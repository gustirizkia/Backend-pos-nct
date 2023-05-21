<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

function generateUuid($table, $length = 12)
{
    $uuid = Str::random($length);
    $db = DB::table($table)->where('uuid', $uuid)->first();

    if ($db) {
        // $this->generateUuid($table, $length+1);
        generateUuid($table, $length+1);
    } else {
        return $uuid;
    }
}
