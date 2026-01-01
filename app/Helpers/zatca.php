<?php
if (! function_exists('generateRandomString')) {
    function generateRandomString()
    {
        $parts = [];
        for ($i = 1; $i <= 3; $i++) {
            $randomString = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4));
            $parts[]      = "$i-$randomString";
        }
        return implode('|', $parts);
    }
}
