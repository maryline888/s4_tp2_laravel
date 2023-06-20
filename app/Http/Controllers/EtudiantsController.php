<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Etudiants;
use App\Models\Villes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EtudiantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Etudiants $etudiants)
    {
        $user = User::selectUser();
        $etudiants = Etudiants::select()
            ->paginate(25);

        return view('etudiants.index', ['etudiants' => $etudiants, 'user' => $user]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $villes = Villes::all();
        $user = User::selectUser();

        return view('etudiants.create', ['villes' => $villes, 'user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:etudiants',
            'phone' => 'required|digits_between:10,15',
            'date_naissance' => 'required|date',
            'ville_id' => 'required|exists:villes,id'
        ]);

        $newEtudiant = Etudiants::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'date_naissance' => $request->date_naissance,
            'ville_id' => $request->ville_id,
        ]);



        return redirect(route('etudiants.show', $newEtudiant->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show(Etudiants $etudiants)
    {
        return view('etudiants.show', ['etudiants' => $etudiants]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit(Etudiants $etudiants)
    {
        $villes = Villes::all();
        return view('etudiants.edit', ['etudiants' => $etudiants, 'villes' => $villes]);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, Etudiants $etudiants)
    {

        $etudiants->update([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'date_naissance' => $request->date_naissance,
            'ville_id' => $request->ville_id
        ]);
        $request->session()->flash('message', 'Vos modifications ont été enregistrées avec succès!');
        return redirect(route('etudiants.show', $etudiants->id));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy(Etudiants $etudiants)
    {
        $etudiants->delete();
        return redirect(route('etudiants.index'));
    }
}
