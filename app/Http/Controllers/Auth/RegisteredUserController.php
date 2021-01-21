<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    public function index()
    {
        $users = User::all();

        foreach ($users as $user) {
            if ($user->isInactive()) {
                $user->changeActiveStatus();
                $user->save();
            }
        }


        return view('users', compact('users'));
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (!request()->user())
            return view('auth.register');
        return view('user.create');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        event(new Registered($user));

        $user->password = Hash::make($request->password);

        $user->save();

        if (!request()->user()) {
            Auth::login($user);
            return redirect(RouteServiceProvider::HOME);
        }

        return redirect('welcome');
    }

    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);

        return view('user.edit', compact('user'));
    }


    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);
        //dd($user);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|',
            'new_password' => 'nullable|string|confirmed|min:8',
        ]);

        //assign values

        $user->name = $request->name;
        $user->email = $request->email;
        if (isset($request->new_password))
            $user->password = $request->new_password;

        //save

        $user->save();

        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back();
    }

    public function isInactive($id)
    {
        return;
    }
}
