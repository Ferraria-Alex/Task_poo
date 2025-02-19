<?php

function clean(string $data){
    return htmlentities(strip_tags(stripslashes(trim($data))));
}