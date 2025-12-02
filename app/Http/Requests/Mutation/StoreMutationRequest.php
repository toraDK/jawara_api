<?php

namespace App\Http\Requests\Mutation;

use Illuminate\Foundation\Http\FormRequest;

class StoreMutationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'family_id'     => 'required|exists:families,id',
            'mutation_type' => 'required|in:move_in,move_out,deceased',
            'mutation_date' => 'required|date',
            'reason'        => 'required|string|max:500',
        ];
    }
}
