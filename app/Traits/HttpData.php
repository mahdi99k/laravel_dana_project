<?php

namespace App\Traits;
trait HttpData
{
  protected function successHttpData($data, $message = null, $code = 200)
  {
    return response()->json([
      'status' =>  'success',
      'message' => $message,
      'data' => $data
    ], $code);
  }
  protected function errorHttpData($data, $message = null, $code)
  {
    return response()->json([
      'status' =>  'error',
      'message' => $message,
      'data' => $data
    ], $code);
  }
}
