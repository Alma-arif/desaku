<?php

if (!function_exists('iconeFormatFile')) {
    function iconeFormatFile($date)
    {
        return \Carbon\Carbon::parse($date)->format('d M Y');
    }
}
