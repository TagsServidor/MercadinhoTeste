<?php

$url = parse_url('https://tagss.biz/l/AutoeMotoEscolaFOXIII?fbclid=PAAaaiIXPo6YRYEGwy71NsU5D9ZgnoubVC0tq3i_OifkcL7cWsTtLlY7C7N_o');
$path = trim($url['path'] ?? '/', '/');


$str = str_replace ('l/' ,'', $path );
echo $str;