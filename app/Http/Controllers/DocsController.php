<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Docs;
use App\Models\User;
use Auth;

date_default_timezone_set('Asia/Singapore');
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
        $doc->doc_accessibility = "Private";
        $doc->doc_access_code = Str::random(40);
        $docChecker = DB::table('docs')->where('doc_access_code', $doc->doc_access_code)->exists();
        while($docChecker === true){
            $doc->doc_access_code = Str::random(40);
            $docChecker = DB::table('docs')->where('doc_access_code', $doc->doc_access_code)->exists();
        }
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
    public function updateAccessibility($accessibility, $doc_id){
        $doc = Docs::findOrFail($doc_id);
        $doc->doc_accessibility = $accessibility;
        $doc->save();
        return redirect('/docsManager/view-all-docs');
    }
    public function accessToOtherDoc(){
        $doc_code = request("doc-code");
        
        $docChecker = Docs::where([['doc_access_code', "=" , "$doc_code"], ['doc_accessibility', "=", "Viewed By Other"]])
                                        ->orWhere([['doc_access_code', "=" , "$doc_code"],['doc_accessibility', "=" , "Edited By Other"]])
                                        ->exists();
                             
        if($docChecker){
            $doc = Docs::where("doc_access_code" , $doc_code)->first();

            if($doc->doc_accessibility == "Viewed By Other"){
                return view("/docsManager/shared/view-shared-document", ["doc" => $doc]);
            }else if($doc->doc_accessibility == "Edited By Other"){
                return view("/docsManager/shared/edit-shared-document", ["doc" => $doc]);
            }
        }else{
            return redirect("/shared/shared-with-me")->with("message", "No such document or wrong access code."); 
        }
    }
    public function searchDocs(){
        $user = Auth::user(); 
        
        $docs = Db::table('docs')
                ->where('doc_owner_id', $user->id)
                ->where(function($query){
                    $search = request('search');
                    $query->where("created_at", $search)
                        ->orWhere("updated_at", $search)
                        ->orWhere("doc_title", $search)
                        ->orWhere("doc_accessibility", $search);
                })
                ->get();

        return view("/docsManager/view-all-docs", ["allDocs" => $docs]);
    }
}
