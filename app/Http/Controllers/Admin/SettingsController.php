<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    //
    /**
     * SettingsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $data = Setting::all();
        $settings=[];
        foreach ($data as $setting){
            $settings[$setting['name']]=$setting['content'];
        }
        return view('admin.settings.index',[
            'settings'=>$settings
        ]);
    }

    public  function save(Request  $request){
        $data = $request->only('title','subtitle','email','bgcolor','textcolor');
        $validator= $this->validator($data);
        if($validator->fails()){
           return redirect()->route('settings')
                ->withErrors($validator);
        }

        foreach ($data as $item=>$value){
            Setting::where('name',$item)->update([
                'content'=>$value
            ]);
        }
        return redirect()->route('settings')->with('success','Alterações salvas com sucesso!');
    }
    protected function validator($data){
        return Validator::make($data,[
            'title'=>['string','max:100'],
            'subtitle'=>['string','max:100'],
            'email'=>['string','email'],
            'bgcolor'=>['string','regex:/#[A-Z0-9{6}]/i'],
            'textcolor'=>['string','regex:/#[A-Z0-9{6}]/i']
        ]);
    }
}
