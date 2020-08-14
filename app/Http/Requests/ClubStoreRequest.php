<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClubStoreRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:150',
            'short_name' => 'nullable|min:3|max:50',
            'city' => 'required|min:3|max:150',
            'about' => 'nullable|min:15|max:2000',
            'website' => 'nullable|min:3|max:150',
            'fb_web' => 'nullable|min:5|max:150',
            'arena_gps' => 'nullable|min:5|max:450',
            'emblem' => 'nullable|mimes:jpeg,jpg,bmp,png',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Názov klubu musí byť vyplnené.',
            'name.min' => 'Názov klubu musí obsahovať minimálne :min znakov.',
            'name.max'  => 'Názov klubu môže obsahovať :max znakov.',
            'short_name.min' => 'Krátky názov klubu musí obsahovať minimálne :min znakov.',
            'short_name.max'  => 'Krátky názov klubu môže obsahovať :max znakov.',
            'city.required' => 'Dedina/Mesto musí byť vyplnené.',
            'city.min' => 'Dedina/Mesto musí obsahovať minimálne :min znakov.',
            'city.max'  => 'Dedina/Mesto môže obsahovať maximálne :max znakov.',
            'about.min'  => 'Text o klube musí obsahovať minimálne :min znakov.',
            'about.max'  => 'Text o klube môže obsahovať maximálne :max znakov.',
            'website.min'  => 'Webstránka musí obsahovať minimálne :min znakov.',
            'website.max'  => 'Webstránka môže obsahovať maximálne :max znakov.',
            'fb_web.min'  => 'Stránka na Facebooku musí obsahovať minimálne :min znakov.',
            'fb_web.max'  => 'Stránka na Facebooku môže obsahovať maximálne :max znakov.',
            'arena_gps.min'  => 'Súradnice na štadión musia obsahovať minimálne :min znakov.',
            'arena_gps.max'  => 'Súradnice na štadión môžu obsahovať maximálne :max znakov.',
            'emblem.mimes'  => 'Chybný formát obrázku.',
        ];
    }
}
