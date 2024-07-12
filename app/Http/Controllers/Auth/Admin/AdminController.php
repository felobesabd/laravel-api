<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    use GeneralTrait;

    public function login(Request $request)
    {
        // |exists:admins,email
        $rules = [
            "email" => "required",
            "password" => "required"
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnValidationError(400, $validator);
        }

         $credential = $request->only(['email', 'password']);
        $token = Auth::guard('admin')->attempt($credential);

        if (!$token) {
            return $this->returnError(400, 'please login again...');
        }

        $admin = Auth::guard('admin')->user();
        $admin->token = $token;

        return $this->returnData('admin', $admin, 200);
    }

    public function logout(Request $request)
    {
        $token = $request->header('token');

        if ($token) {
            try {
                JWTAuth::setToken($token)->invalidate(); //logout
            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
                return  $this -> returnError(400,'Token Signature could not be verified');
            }
            return $this->returnSuccessMessage(200, 'logout success');
        } else {
            return $this->returnError(403, 'logout failed');
        }
    }
}
