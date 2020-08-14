<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
class MatchStoreRequest extends FormRequest
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
            'team_id' => 'required|integer',
            'season_id' => 'required|integer',
            'club_id' => 'required|integer',      
            'match_datetime' => 'required|date',
            'is_bus' => 'nullable',
            'bus_time' => 'nullable|date_format:"H:i"',
            'short_info' => 'nullable|min:3|max:200',
            'about' => 'nullable|min:5|max:3500',
            'result' => 'nullable|min:3|max:5',
            'home_away' => 'required|boolean',
            'fn_ID' => 'nullable|integer|unique:matches,fn_ID,'.Request::get('id').',id',
            'locked' => 'nullable',
            'locked_reason' => 'nullable|min:3|max:250',
        ];
    }
    public function messages()
    {
        return [
            'team_id.required' => 'Musíte vyplniť tím ktorý zápas odohrá.',
            'team_id.integer' => 'Musíte vyplniť tím ktorý zápas odohrá.',
            'season_id.required'  => 'Musíte vyplniť sezónu v ktorej sa zápas odohrá.',
            'season_id.integer' => 'Musíte vyplniť sezónu v ktorej sa zápas odohrá.',
            'club_id.required'  => 'Musíte vyplniť klub s ktorým zápas odohráme.',
            'club_id.integer' => 'Musíte vyplniť klub s ktorým zápas odohráme.',
            'match_datetime.required' => 'Musíte vyplniť dátum a čas kedy sa zápas odohrá.',
            'match_datetime.date'  => 'Musíte vyplniť dátum a čas kedy sa zápas odohrá.',
            //'is_bus.boolean'  => 'Pôjde na zápas autobus?',
            'bus_time.date_format'  => 'Odchod autobusu musí byť vo foráte H:i.',
            'short_info.min'  => 'Krátke informácie pred zápasom musia obsahovať najmenej :min znakov.',
            'short_info.max'  => 'Krátke informácie pred zápasom môžu obsahovať najviac :max znakov.',
            'about.min'  => 'Report o zápase musí obsahovať najmenej :min znakov.',
            'about.max'  => 'Report o zápase musí obsahovať najviac :max znakov.',
            'result.min'  => 'Výsledok musí obsahovať najmenej :min znakov.',
            'result.max'  => 'Výsledok môže obsahovať najviac :max znakov.',
            'home_away.required'  => 'Miesto konania zápasu nemôže byť prázdne.',
            'home_away.boolean'  => 'Miesto konania zápasu nemôže byť prázdne.',
            'fn_ID.integer' => 'ID zápasu na FutbalNete musí byť číslo.',
            'fn_ID.unique' => 'ID zápasu sa už v databáze nachádza.',
            'locked_reason.min' => 'Dôvod zablokovania musí obsahovať minimálne :min znakov.',
            'locked_reason.max' => 'Dôvod zablokovania môže mať maximálne :max znakov.',
        ];
    }
}
