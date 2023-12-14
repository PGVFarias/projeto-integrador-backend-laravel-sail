<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentStoreRequest;
use App\Models\Document;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('document.index', ['documents' => Document::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('document.create', ['groups' => Auth::user()->is_admin ? Group::all() : Auth::user()->groups()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DocumentStoreRequest $request)
    {
        foreach($request->file('files') as $file) {
            $path = $file->store('documents');
            Document::create([
                'name' => $file->getClientOriginalName(),
                'storage_name' => $path,
                'group_id' => $request->input('group_id')
            ]);
        }

        return to_route('documents.index')->with('message', 'Documentos salvos com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!Auth::user()->is_admin) {
            return to_route('documents.index')->with('error', 'Apenas administradores podem excluir arquivos');
        }
        Storage::delete(Document::find($id)->storage_name);
        Document::destroy($id);

        return to_route('documents.index')->with('message', 'Documento excluído com sucesso');
    }

    public function download(Document $document)
    {
        return Storage::download($document->storage_name, $document->name);
    }
}
