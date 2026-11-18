<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $mediaId = $this->route('media')?->id ?? $this->route('media');

        if ($this->isMethod('PATCH') || $this->isMethod('PUT')) {
            return [
                'title' => 'sometimes|required|string|max:255|unique:media,title,' . $mediaId,
                'type' => 'sometimes|required|string|max:100',
                'genre' => 'sometimes|required|string|max:100',
                'release_year' => 'nullable|integer|min:1900|max:2100',
                'description' => 'nullable|string',
            ];
        }

        return [
            'title' => 'required|string|max:255|unique:media,title',
            'type' => 'required|string|max:100',
            'genre' => 'required|string|max:100',
            'release_year' => 'nullable|integer|min:1900|max:2100',
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul media wajib diisi.',
            'title.unique' => 'Judul media sudah terdaftar di FlipPlay.',
            'type.required' => 'Jenis media wajib diisi.',
            'genre.required' => 'Genre media wajib diisi.',
            'release_year.integer' => 'Tahun rilis harus berupa angka.',
        ];
    }
}
