<?php

function base_url()
{
    return $_ENV["BASE_URL"];
}
function images_url()
{
    return $_ENV["BASE_URL"] . "/assets/images";
}
function pre($data)
{
    $format  = print_r('<pre>');
    $format .= print_r($data);
    $format .= print_r('</pre>');
    return $format;
}
