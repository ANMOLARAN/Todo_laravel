<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            //
        'title'=>'required|min:8|max:50',
        'description'=>'required|min:50',
        'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
        'video' => 'required|file|mimetypes:video/mp4',
            ];
    }
}
