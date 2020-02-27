<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Validator;
use Storage;
use App\Models\User;
use App\Models\Coaching\CoachingCounter;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
    	return view('register');
    }

    public function register(Request $request)
    {
    	$valid = Validator::make($request->all(),[
            'name' => 'required',
            'abbreviation' => 'required',
            'area' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|between:2,10',
            'owner' => 'required',
            'owner_phone' => 'required|digits_between:5,19',
            'inst_phone' => 'required|digits_between:5,19',
            'type' => 'required',
            'service' => 'required'
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $input = $request -> except(['_token']);

        $input['password'] = bcrypt($input['password']);

        $last_inserted_identity = User::select(['identity'])
                                    ->where('type',$request->type)
                                    ->orderBy('id', 'DESC')
                                    ->first();
        
        if($last_inserted_identity === null)
            $last_identity = 1;
        else
            $last_identity =$last_inserted_identity->identity + 1;


        if($input['type'] === 'coaching'){
            $sing = 9;
        } elseif($input['type'] === 'kindergarten') {
            $sing = 8;
        } else {
            $sing = 7;
        }

        $input['FI'] = $sing . $last_identity;
        $input['email_verified_at'] = now();
        
        $input['identity'] = str_pad($last_identity,3,0,STR_PAD_LEFT);
      
        Storage::makeDirectory('public/storage/' . $input['FI'] . '/', 0777, true, true);
        Storage::makeDirectory('public/storage/' . $input['FI'] . '/student/', 0777, true, true);
        Storage::makeDirectory('public/storage/' . $input['FI'] . '/employee/', 0777, true, true);
        Storage::makeDirectory('public/storage/' . $input['FI'] . '/owner/', 0777, true, true);
        Storage::makeDirectory('public/storage/' . $input['FI'] . '/course/', 0777, true, true);
        Storage::makeDirectory('public/storage/' . $input['FI'] . '/event/', 0777, true, true);
        Storage::makeDirectory('public/storage/' . $input['FI'] . '/leaflet/', 0777, true, true);
        Storage::makeDirectory('public/storage/' . $input['FI'] . '/notice/', 0777, true, true);
        

        try {
            
            $user = User::create($input);

            $count['student_count'] = 0;
            $count['teacher_count'] = 0;
            $count['course_count'] = 0;
            $count['event_count'] = 0;
            $count['owner_count'] = 0;
            $count['inst_identity'] = $input['FI'];
            CoachingCounter::create($count);

            event(new Registered($user));

            session()->flash('message','Account create successfully');
            return redirect()->route('login');

        } catch (Exception $e) {

            session()->flash('message',$e->getMessage());
            return redirect()->back();

        }
    }

    public function showLogin()
    {
    	return view('login');
    }

    public function login(Request $request)
    {
    	$validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:2'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request -> except(['_token']);

        if (auth()->attempt($input)) {
            auth()->user();
            return redirect()->route('dashboard');      
        }

        //if user account is invalid
        session()->flash('message','Your account is not registered');
        return redirect()->back();
    }

    public function logout()    
    {
        auth()->logout();
        session()->flash('message','Your are logged-out');
        return redirect()->route('login');
    }
}
