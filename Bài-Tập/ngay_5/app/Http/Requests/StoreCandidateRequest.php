<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\NoProfanity;

class StoreCandidateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'required|min:5',
            'email' => 'required|email|unique:candidates,email',
            'birthday' => 'required|date|before:-18 years',
            'avatar' => 'nullable|image|max:2048',
            'cv' => 'required|file|mimetypes:application/pdf|max:5120',
            'bio' => ['nullable', 'max:1000', new NoProfanity],
        ];
    }
}
