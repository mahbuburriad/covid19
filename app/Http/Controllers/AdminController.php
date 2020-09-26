<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = User::all();
        return view('dashboard.user.index', compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/'  // must contain a special character],
                ]
        ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'position' => $request['position'],
            'theme' => 'light',
            'sidebar' => 'light-sidebar',
            'password' => Hash::make($request['password']),
        ]);

        if ($request->has('save')) {
            return redirect(route('user.index'))->with('message', 'User Added');
        } else {
            return redirect()->back()->with('message', 'User Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if ($user->id > 1) {
            return view('dashboard.user.edit', compact('user'));
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        if ($request->has('update')) {
            return redirect(route('user.index'))->with('message', 'Profile Updated');
        } else {
            return redirect()->back()->with('message', 'Profile Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id > 1) {
            $user->delete();
            return redirect()->back()->with('message', 'Profile Deleted');
        }
        return redirect()->back();
    }

    public function profile(){
        return view('dashboard.user.profile');
    }

    public function profileChange(Request $request){
        if ($request->has('image')) {
            $fileOriginalExtension = $request->file('image')->getClientOriginalExtension();
            $image = time().'.'.$fileOriginalExtension;
            $request->image->storeAs('image', $image, 'public');
            if (!empty(auth()->user()->image)) {
                Storage::delete('/public/image/' . auth()->user()->image);
            }
            auth()->user()->update([
                'image' => $image,
            ]);
        }
        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'theme' => $request->theme,
            'sidebar' => $request->sidebar
        ]);
        return redirect()->back()->with('message', 'Profile Updated');
    }

    public function password(){
        return view('dashboard.user.changePassword');
    }

    public function passwordChange(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/'  // must contain a special character],
            ],
            'oldPassword' => ['required', 'string', 'min:8']
        ]);
        $hashedPassword = Auth::user()->getAuthPassword();
        if (Hash::check($request['oldPassword'], $hashedPassword)) {
            auth()->user()->update([
                'password' => Hash::make($request['password']),
            ]);
            Auth::logout();
            return redirect(route('login'))->with('message', 'Password Change Successfully');
        }
        return redirect()->back()->with('error', 'Password Not Changed');
    }
}
