<?php

include 'sc2gears.php';

$replay_file = '1v1-legendz-rapedz.sc2replay';

$fh = fopen($replay_file, 'r');
$replay_size = filesize($replay_file);

$replay_raw = fread($fh, $replay_size);

//print_r($replay_raw);

$encoded = base64_encode($replay_raw);
$encoded_size = strlen($replay_raw);

//print_r($encoded_size);

//print_r($replay_encoded);

$s = new SC2Gears('FILL-ME-IN');

$parsed = $s->parseReplay(urlencode($encoded), $encoded_size);

print_r(simplexml_load_string($parsed));