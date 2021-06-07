<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{

  /**  @var UserService */
  private $service;

  /**     
   *
   * @param UserService $service
   */
  public function __construct(UserService $service)
  {
    $this->service = $service;
  }
 
}
