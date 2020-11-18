<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class JsonValidator
{

    /**
     * @param $jsonString
     * @param array $validationConfig
     * @return array
     * @throws ValidationException
     */
    public static function validate($jsonString, array $validationConfig)
    {
        $json = json_decode($jsonString, true);

        if (!is_null($json)) {
            $validator = Validator::make($json, $validationConfig);
            return $validator->validate();
        } else {
            throw ValidationException::withMessages([
                'json' => ['invalid json data.'],
            ]);
        }
    }
}
