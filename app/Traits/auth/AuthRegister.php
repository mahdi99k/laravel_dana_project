<?php

namespace App\Traits\auth;
trait AuthRegister
{
  protected function successRegister($data, $message = null, $code = 200)
  {
    return response()->json([
      'status' =>  'success',
      'message' => $message,
      'data' => $data
    ], $code);
  }
  protected function errorRegister($data, $message = null, $code)
  {
    return response()->json([
      'status' =>  'error',
      'message' => $message,
      'data' => $data
    ], $code);
  }
}
