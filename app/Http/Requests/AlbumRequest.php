<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\Album;

class AlbumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /*$album = Album::find($this->id);
        if (Gate::denies('manage-album', $album)) {
            return false;
        } */
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => "required",
            'description' => 'required',
            'album_thumb' => 'image',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "nome obbligatorio",

        ];
    }
}
