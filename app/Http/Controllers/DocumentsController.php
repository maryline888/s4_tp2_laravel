<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\User;
use App\Models\Documents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentsController extends Controller
{
    public function index()
    {
        $documents = Documents::with('user')->orderBy('id')->paginate(10);
        return view('documents.index', ['documents' => $documents]);
    }

    public function create()
    {


        return view('documents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre_fr' => 'required',
            'titre_en' => 'required',
            'file' => 'required|mimes:pdf,zip,doc',
        ]);

        $filePath = $request->file('file')->store('public/documents');

        Documents::create([
            'titre_fr' => $request->titre_fr,
            'titre_en' => $request->titre_en,
            'date' => $request->date ? $request->date : now(),
            'file' => $filePath,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('doc.index')->with('success', 'Document ajouté avec succes!');
    }


    public function edit(Documents $documents)
    {
        return view('documents.edit', ['documents' => $documents]);
    }

    public function update(Request $request, Documents $documents)
    {
        $user = Auth::user();

        $request->validate([
            'titre_fr' => 'nullable',
            'titre_en' => 'nullable',
            'file' => 'mimes:pdf,doc,zip',
        ]);

        $filePath = $documents->file; // default to the existing file path

        if ($request->hasFile('file')) {
            // delete the old file from storage
            Storage::disk('public')->delete($documents->file);

            // store the new file
            $filePath = $request->file('file')->store('public/documents');

            // update the file path in the directory
            $documents->file = $filePath;
        }

        $documents->update([
            'titre_fr' => $request->titre_fr,
            'titre_en' => $request->titre_en,
            'file' => $filePath,
            'date' => $request->date_de_creation ? $request->date_de_creation : now(),
            'user_id' => $user->id,
        ]);

        $documents->save();

        return redirect(route('doc.index', $documents));
    }



    public function destroy(Documents $documents)
    { {
            $documents->delete();

            return redirect(route('documents.index'));
        }
    }
}
