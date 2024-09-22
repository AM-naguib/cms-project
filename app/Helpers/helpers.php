<?php

use App\Models\Setting;

if (!function_exists('getSettings')) {
    function getSettings() {
        return Setting::first();
    }
}
