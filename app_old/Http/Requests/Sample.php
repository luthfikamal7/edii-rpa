<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Sample extends FormRequest
{
    public function rules()
    {
        return [
            'nik' => ['string', 'max:255'],
            'nomor_handphone' => ['string', 'max:255'],
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }
}
