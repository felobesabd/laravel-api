<?php

namespace App\Traits;

Trait GeneralTrait
{

    public function returnError($status, $msg)
    {
        return response()->json([
            'status' => $status,
            'msg' => $msg
        ], $status);
    }


    public function returnSuccessMessage($status, $msg = "")
    {
        return response()->json([
            'status' => $status,
            'msg' => $msg
        ], $status);
    }

    public function returnData($key, $value, $status)
    {
        return response()->json([
            $key => $value
        ], $status);
    }

    public function returnValidationError($status, $validator)
    {
        return $this->returnError($status, $validator->errors()->first());
    }

}
