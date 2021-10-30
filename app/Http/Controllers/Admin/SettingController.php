<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $settings = [];

        $dbsettings = Setting::get();

        foreach($dbsettings as $dbsetting){
            $settings[$dbsetting['name']] = $dbsetting['content'];

        }

        return view('admin.settings.index', [
            'settings' => $settings
        ]);
    }

    public function save(Request $request){
        $data = $request->only(['title', 'email', 'bgcolor', 'textcolor']);
        
        $validator = $this->validator($data);

        if($validator->fails()){
            return redirect()->route('settings')->withErrors($validator);

        }

        foreach($data as $item => $value){
            Setting::where('name', $item)->update([
                'content' => $value
            ]);

        }
        return redirect()->route('settings')->with('warning', 'Campos alterados com sucesso!');

    }

    protected function validator($data){
        return Validator::make($data, [
            'title' => ['string', 'max:100'],
            'subtitle' => ['string', 'max:100'],
            'email' => ['string', 'email'],
            'bgcolor' => ['string'],
            'textcolor' => ['string']
        ]);

    }
}
