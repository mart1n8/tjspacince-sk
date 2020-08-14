<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
       {
           return [
               'firstname' => 'required|min:3|max:150',
               'lastname' => 'required|min:3|max:150',
               'birth_date' => 'nullable|date',
               'photo' => 'nullable|image',
               'fn_id' => 'required|integer|gte:100000',
           ];
       }

    public function messages()
    {
        return [
            'firstname.required' => 'Meno hráča je po povinné.',
            'firstname.min'  => 'Meno hráča musí obsahovať minimálne :min znakov.',
            'firstname.max' => 'Meno hráča môže obsahovať maximálne :max znakov.',
            'lastname.required' => 'Priezvisko hráča je po povinné.',
            'lastname.min'  => 'Priezvisko musí obsahovať minimálne :min znakov.',
            'lastname.max' => 'Priezvisko príspevku môže obsahovať maximálne :max znakov.',
            'birth_date.date' => 'Dátum narodenia v zlom formáte.',
            'photo.image' => 'Zlý typ súboru pre fotografiu hráča.',
            'fn_id.required' => 'ID na futbalnet.sk je povinný údaj.',
            'fn_id.integer' => 'ID na futbalnet.sk musí byť celé číslo.',
            'fn_id.gte' => 'ID na futbalnet.sk musí byť celé číslo väčšie ako :gte.',
        ];
    }

}
