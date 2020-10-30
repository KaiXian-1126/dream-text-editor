<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docs;
use App\Models\User;
use Auth;
class DocsController extends Controller
{
    public function viewAllDocs(){
        $user = Auth::user();
        $allDocs = Docs::all()->where('doc_owner_id', $user->id);
        return view("/docsManager/view-all-docs", ["allDocs" => $allDocs]);
    }
    public function newDoc(){
        if(Auth::check()){
            $user = Auth::user();
            return view("/docsManager/new-doc", ["username" => $user->name]);
        }else{
            return view("/docsManager/new-doc", ["username" => ""]);
        }
        
        return view("/docsManager/new-doc", ["username" => $user->name]);
    }
    public function createDoc(){    //Save and add a new doc 
        $doc = new Docs();
        $user = Auth::user();
        $doc->doc_content = request("doc_content");
        $doc->doc_owner_id = $user->id;
        $doc->doc_title = request("doc_title");
        $doc->save();
        return redirect('/');
    }
    public function updateDoc($id){
        $user = Auth::user();
        $doc = Docs::find($id);
        return view("/docsManager/update-doc", ["doc" => $doc, "username" => $user->name]);
    }
    public function deleteDoc($id){
        $doc = Docs::findOrFail($id);
        $doc->delete();
        return redirect('/docsManager/view-all-docs');
    }
    public function saveUpdatedDocs($id){
        $doc = Docs::find($id);
        $user = Auth::user();
        $doc->doc_content = request("doc_content");
        $doc->doc_title = request("doc_title");
        $doc->save();
        return redirect('/docsManager/view-all-docs');
    }
    public function getSharedDocInfo(){
        return view("/docsManager/shared/get-shared-doc-info");
    }
    public function accessToOtherDocument(){
        return view("/docsManager/shared/view-document");
    }
}
