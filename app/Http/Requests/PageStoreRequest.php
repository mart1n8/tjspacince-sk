<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
               'title' => 'required|min:3|max:150',
               'slug' => 'required|min:3|max:150',
               'text' => 'required|min:30|max:15000',
           ];
       }

    public function messages()
    {
        return [
            'title.required' => 'Názov príspevku po povinný.',
            'title.min'  => 'Názov príspevku musí obsahovať minimálne :min znakov.',
            'title.max' => 'Názov príspevku môže obsahovať maximálne :max znakov.',
            'slug.required' => 'Slug (link ktorý bude mat stránka) nemôže byť prázdny.',
            'slug.min'  => 'Slug (link ktorý bude mat stránka) musí obsahovať minimálne :min znakov.',
            'slug.max' => 'Slug (link ktorý bude mat stránka) príspevku môže obsahovať maximálne :max znakov.',
            'text.required' => 'Text príspevku je povinný.',
            'text.min' => 'Text príspevku musí obsahovať mnimálne :min znakov.',
            'text.max' => 'Text príspevku môže obsahovať maximálne :max znakov.',
        ];
    }
}
