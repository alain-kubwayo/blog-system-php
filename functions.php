<?php

function generateButtonContent($code) {
    $icon = "<span>$code</span>";
    return $icon;
}

function formatDate($date) {
    return date('M j Y g:i A', $date);
}

function formatTime($seconds) {
    $h = floor(($seconds/60)/60);
    $m = floor(($seconds/60) - ($h * 60));

    return "$h hrs : $m mins";
}

function save($data) {
    $json = json_encode($data); // convert array to json format
    $file = fopen('data.json', 'w');
    fwrite($file, $json);
}