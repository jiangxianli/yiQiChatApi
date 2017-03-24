<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;


abstract class Request extends FormRequest
{
    /**
     * @param string $prefix 比如 'activity.', 注意最后需要添加'.'
     *
     * @return array
     */
    public function createMessages($prefix = '')
    {
        $rules    = $this->rules();
        $messages = [];

        foreach ($rules as $field => $rule) {
            if (!is_array($rule)) {
                $rule = explode('|', $rule);
            }

            foreach ($rule as $r) {
                $k                           = explode(':', $r)[0];
                $messages[$field . '.' . $k] = trans($prefix . $field . '.' . $k);
            }
        }

        return $messages;
    }

    /**
     * Format the errors from the given Validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     *
     * @return array
     */
    protected function formatErrors(Validator $validator)
    {
        //todo code
        return [
            'code'    => '40001',
            'message' => $validator->errors()->first(),
            //            'errors' => $validator->errors()->all(),
            //            'status_code' => 422
        ];
    }
}
