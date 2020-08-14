<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdCampaign;
use Illuminate\Support\Facades\Validator;


class AdCampaignsController extends Controller
{
    public function index(){
        $campaign = new AdCampaign;
        $adCampaigns = AdCampaign::get();
        return view('ads.campaign_index', compact('adCampaigns', 'campaign'));
    }


    public function store(Request $request){
        $validator=$this->campaignValidate($request);
        if ($validator->fails()) return redirect()->route('admin.reklama.kampane')->withErrors($validator)->withInput();

        $campaign = new AdCampaign($request->all());
        if(empty($campaign->points)){
          $campaign->points = -1;
        }
        $campaign->save();
        return redirect()->route('admin.reklama.kampane')->with('succeed', 'Reklamná kampaň bola vytvorená');
    }

    public function edit(AdCampaign $campaign){
        return view('ads.campaign_edit', compact('campaign'));
    }

    public function update(Request $request, AdCampaign $campaign){
        $validator=$this->campaignValidate($request, $campaign->id);
        if ($validator->fails()) return redirect()->route('admin.reklama.kampane.edit', ['campaign'=>$campaign->id])->withErrors($validator)->withInput();
        $campaign->fill($request->all());
        if(empty($campaign->points)){
          $campaign->points = -1;
        }
        $campaign->save();
        return redirect()->route('admin.reklama.kampane.edit', ['campaign'=>$campaign->id])->with('succeed', 'Reklamná kampaň bola upravená');
    }


    public function delete(AdCampaign $campaign){
        $campaign->delete();
        return redirect()->route('admin.reklama.kampane')->with('succeed', 'Reklamná kampaň bola vymazaná');
    }


    public function campaignValidate($request, $id=""){
        $messages=[
            'name.required'=>'Názov reklamnej kampane nemôže byť prázdny.',
            'name.min'=>'Názov reklamnej kampane musí obsahovať minimálne :min znakov.',
            'name.max'=>'Názov reklamnej kampane môže obsahovať maximálne :max znakov.',
            'name.unique'=>'Názov reklamnej kampane sa už v databáze nachádza.',
            'company.min'=>'Názov spoločnosti musí obsahovať minimálne :min znakov.',
            'company.max'=>'Názov spoločnosti môže obsahovať maximálne :max znakov.',
            'generalURL.required'=>'URL adresa kampane nemôže byť prázdna.',
            'generalURL.URL'=>'Neplatný formát URL adresy.',
            'points.integer'=>'Body na reklamnúkampaň musia byť celé číslo.',
            ];
            $validator = Validator::make($request->all(), [
                  'name' => 'required|min:5|max:150|unique:ad_campaigns,name,'.$id.',id',
                  'company' => 'nullable|min:3|max:50',
                  'generalURL' => 'required|URL',
                  'points' => 'nullable|integer',
            ], $messages);
        return $validator;
    }

}
