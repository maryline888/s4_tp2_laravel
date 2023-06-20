<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class CustomAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.create');
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'min:6|max:20'
        ]);

        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect(route('login'))->withSuccess(trans('lang.text_success_user'));
    }

    public function authentication(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::validate($credentials)) {
            return redirect()->back()->withErrors(trans('auth.password'));
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);
        return redirect()->intended(route('blog.index'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }

    public function usersList()
    {
        $users = User::select('id', 'name') //si on veut boucler sur les posts du user il faut absolument mettre le id ici 
            ->orderby('name')
            ->paginate(5);

        return view('auth.listUsers', ['users' => $users]);
    }

    public function forgtoPassword()
    {
        return view('auth.forgot-password');
    }

    //validation du email savoir si il exist
    public function tempPassword(Request $request)
    {

        $request->validate([
            'email' => 'exists:users'
        ]);

        $user = User::where('email', $request->email)->first();

        $tempPassword = Str::random(45);

        $user->temp_password = $tempPassword;
        $user->save();

        $body = "<a href='" . route("new.password", [$user->id, $tempPassword]) . "' >Cliquer ici pour réinitialiser votre mots de passe</a>";

        $to_email = $user->email;
        $to_name = $user->name;

        Mail::send(
            'email.mail',
            [
                'name' => $to_name,
                'body' => $body
            ],
            function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject('Reset password'); // ici on pourrait attacher un chemin de fichier attacher 
            }
        );
        return redirect(route('login'))->withSuccess('Please check your email');
    }

    public function newPassword(User $user, $tempPassword)
    {

        if ($user->temp_password === $tempPassword) {
            return view('auth.new-password');
        };
        return redirect(route('forgot.password'))->withErrors('Access denied');
    }

    public function storeNewPassword(Request $request, User $user, $tempPassword)
    {

        if ($user->temp_password === $tempPassword) {
            $request->validate([
                'password' => 'max:20|min:6|confirmed'
            ]);

            $user->password = Hash::make($request->password);
            $user->temp_password = null;
            $user->save();
        };
        return redirect(route('login'))->withSuccess('Success');
    }
}
