<?php

namespace App\Http\Controllers\api;

trait api_responseTrait
{
public function ApiResponse($data,$message,$status){
   $array=[
        'data'=>$data,
       'message'=>$message,
       'status'=>$status
       ];
   return response($array);
}
}