<?php
namespace App\Traits\activities\inojob;
trait GetPriorities
{
  protected function successGetPriorities($data, $message = null, $code = 200)
  {
    return response()->json([
      'status' =>  'success',
      'message' => $message,
      'data' => $data
    ], $code);
  }
  protected function errorGetPriorities($data, $message = null, $code)
  {
    return response()->json([
      'status' =>  'error',
      'message' => $message,
      'data' => $data
    ], $code);
  }
}