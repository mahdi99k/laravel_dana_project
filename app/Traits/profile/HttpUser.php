<?php

namespace App\Traits\profile;
trait HttpUser
{
  protected function successHttpUser($data, $message = null, $info = null, $code = 200)
  {
    return response()->json([
      'status' =>  'success',
      'message' => $message,
      'data' => $data,
      'info' => $info
    ], $code);
  }
  protected function errorHttpUser($data, $message = null, $code, $errors = null)
  {
    return response()->json([
      'status' =>  'error',
      'message' => $message,
      'data' => $data,
      'errors' => $errors
    ], $code);
  }
}
