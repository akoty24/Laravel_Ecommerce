<?php

define('PAGINATION_COUNT', 10);

function getFolder()
{

    return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';
}


function uploadImage($folder,$photo){
    $photo->store('/', $folder);
    $filename = $photo->hashName();
    return  $filename;
}