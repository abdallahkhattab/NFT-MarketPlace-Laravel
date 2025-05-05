<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
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
           // 'user_id' => ['required', 'exists:users,id'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'avatar' => ['nullable', 'image' ,'max:2048'], // allows jpeg, png, bmp, gif, svg, or webp
            'background_image' => ['nullable', 'image', 'max:4096'],
            'personal_website' => ['nullable', 'url'],
            'twitter' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],

        ];
    }
}
