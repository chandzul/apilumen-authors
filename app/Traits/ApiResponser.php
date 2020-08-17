<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
  /**
   * [successResponse description]
   *
   * @param   [type]    $data  [$data description]
   * @param   [type]    $code  [$code description]
   * @param   Response         [ description]
   * @param   HTTP_OK          [ description]
   *
   * @return  [type]           [return description]
   */
  public function successResponse($data, $code = Response::HTTP_OK)
  {
    return response()->json(['data' => $data], $code);
  }

  /**
   * [errorResponse Build error]
   *
   * @param   [type]  $message  [$message description]
   * @param   [type]  $code     [$code description]
   *
   * @return  [type]            [return description]
   */
  public function errorResponse($message, $code)
  {
    return response()->json(['error' => $message, 'code' => $code], $code);
  }
}