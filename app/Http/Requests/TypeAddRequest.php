<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class TypeAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            "type" => "required|min:3|max:20|unique:types|regex:/^([^0-9]*)$/",
        ];
    }

    public function messages (){

        return[
            "type.required"=>"Típus elvárt!",
            "type.min"=>"Túl rövid megnevezés!",
            "type.max"=>"Túl hosszú megnevezés!",
            "type.unique"=>"Ez a tíus már létezik!",
            "type.regex"=>"A megnevezés nem tartalmazhat számot!",
        ];
    }

    public function failedValidation (Validator $validator) {

        throw new HttpResponseException (response ()->json ([

            "succes"=>false,
            "message"=>"Beviteli hiba",
            "data"=>$validator->errors()
        ]));
    }
}
