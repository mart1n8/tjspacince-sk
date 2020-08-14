<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use App\AdCampaign;
use App\Ad;

class AdController extends Controller
{

    public function index(AdCampaign $campaign){
        $ad = new Ad;
        return view('ads.ad_index', compact('campaign','ad'));
    }

    public function store(Request $request, AdCampaign $campaign){
      $validator=$this->adValidation($request);
      if ($validator->fails()) return redirect()->route('admin.reklama', ['campaign'=>$campaign->id])->withErrors($validator)->withInput();

      $ad=new Ad($request->all());

      $bannerWidth=explode("x", $ad->banner_size)[0];
      $bannerHeight=explode("x", $ad->banner_size)[1];

      if($ad->banner && $ad->banner->isValid()) {
          $fileName = Str::random(40).'.'.$ad->banner->getClientOriginalExtension(); // MENO + KONCOVKA OBRAZKU
          $image = Image::make($ad->banner);
          $image->resize($bannerWidth, $bannerHeight, function ($constraint) {
              $constraint->aspectRatio();
          });
          $image->save(public_path('uploads/ads/' .$fileName));
          $ad->banner = $fileName;
        }
        $ad->ad_campaign_id=$campaign->id;
        $ad->save();
        return redirect()->route('admin.reklama', ['campaign'=>$campaign->id])->with('Reklamný banner bol pridaný.');
    }

    public function edit(Ad $ad){
        return view('ads.edit', compact('ad'));
    }

    public function update(Request $request, Ad $ad){
      $validator=$this->adValidation($request, $ad->id);
      if ($validator->fails()) return redirect()->route('admin.reklama', ['ad'=>$ad->id])->withErrors($validator)->withInput();

      $ad->fill($request->all());
      $bannerWidth=explode("x", $ad->banner_size)[0];
      $bannerHeight=explode("x", $ad->banner_size)[1];

      if($request->banner && $request->banner->isValid()) {
            $fileName = Str::random(40).'.'.$ad->banner->getClientOriginalExtension(); // MENO + KONCOVKA OBRAZKU
          $image = Image::make($ad->banner);
          $image->resize($bannerWidth, $bannerHeight, function ($constraint) {
              $constraint->aspectRatio();
          });
          $image->save(public_path('uploads/ads/' .$fileName));
          $ad->banner = $fileName;
        }
        $ad->save();
        return redirect()->route('admin.reklama.edit', ['ad'=>$ad->id])->with('Reklamný banner bol upravený.');
    }

    public function delete(Ad $ad){
      $ad->delete();
      return redirect()->route('admin.reklama', ['campaign'=>$ad->campaign->id])->with('Reklamný banner bol vymazaný.');
    }


    public function adValidation(Request $request, $id=""){
      $messages=[
          'title.required'=>'Titulok kampane nemôže byť prázdny.',
          'title.min'=>'Titulok kampane musí obsahovať minimálne :min znakov.',
          'title.max'=>'Titulok kampane môže obsahovať maximálne :max znakov.',
          'url.url'=>'URL musí byť platná url.',
          'banner.image'=>'Banner musí byť obrázok.',
          'banner.required'=>'Banner musí byť obrázok',
          ];
          $validator = Validator::make($request->all(), [
                'title' => 'required|min:5|max:150',
                'url' => 'nullable|URL',
                'banner' => 'nullable|image',
          ], $messages);
      return $validator;
    }

    public function show(Request $request, $size){
      if(!$ad = Ad::where('ads.banner_size', $size)->where('ad_campaigns.points', '<>', 0)
            ->join('ad_campaigns', 'ads.ad_campaign_id', '=', 'ad_campaigns.id')
            ->inRandomOrder()
            ->first()){
        return response()->json(['ad'=>false]);
      }
      $campaign = AdCampaign::find($ad->ad_campaign_id);
      if($campaign->points>0){
        $campaign->decrement('points');
      }
      if($request->session()->get('ad_view_'.$ad->id)!=true){
          $ad->increment('views_unq');
      }
      $ad->increment('views');
      $request->session()->put('ad_view_'.$ad->id, true);


      return response()->json([
            'id' => $ad->id,
            'banner' => $ad->banner,
            'url' => !empty($ad->url) ? $ad->url : $campaign->generalURL,
            'title' => !empty($ad->title) ? $ad->banner : $campaign->company,
            'width' => explode("x", $size)[0],
            'height' => explode("x", $size)[1]
      ]);
    }

    public function click(Request $request, $ad_id){
      if(!$ad = Ad::where('ads.id', $ad_id)
            ->join('ad_campaigns', 'ads.ad_campaign_id', '=', 'ad_campaigns.id')
            ->first()){
        return response()->json(['ad'=>false]);
      }
      $campaign = AdCampaign::find($ad->ad_campaign_id);

      if($campaign->points>0){
        $campaign->decrement('points');
      }
      if($request->session()->get('ad_click_'.$ad->id)!=true){
          $ad->increment('clicks_unq');
      }
      $request->session()->put('ad_click_'.$ad->id, true);
      $ad->increment('clicks');

      return response()->json([
            'message' => 'OK',
      ], 200);
    }

}
