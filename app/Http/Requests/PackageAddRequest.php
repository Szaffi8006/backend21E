<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PackageAddRequest extends FormRequest
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
            "package"=>"required|min:3|max:20|unique:packages"
        ];
    }


    public function messages(){

        return [
            "package.required"=>"Kiszerelés elvárt!",
            "package.min"=>"Túl rövid megnevezés!",
            "package.min"=>"Túl rövid megnevezés!",
            "package.unique"=>"Ez a kiszerelés már létezik!",

        ];
    }
    
    public function failedValidation (Validator $validator) {

        throw new HttpResponseException (response ()->json ([

            "succes"=>false,
            "message"=>"Beviteli hiba",
            "data"=>$validator->errors()
        ]));
    }}
