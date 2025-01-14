<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Admin;
use App\Proposal;

class AdminsControllers extends Controller
{
    public function store(Request $request){

        //You should add validation before creating the user.
     
        $user = Admin::create([
           "email" => $request->email,
           "password" => bcrypt($request->password),
           "ormawa" => $request->ormawa,
        ]);
     
        if(!$user){
           return redirect('/register');
        } else {
            return redirect('/login');
        }
     
        // return response(["user" => $user], 200);
     
     }

     public function login(Request $request)
     {
        if (Auth::Attempt($request->only('email', 'password'))) {
            return redirect('/admin');
        }else{
             return redirect('/login');
        }
     }

     public function createProposal(Request $request)
     {
        // $request->validate([
        //     'adminId' => 'required',
        //     'eventName' => 'required',
        //     'eventTimeHeld' => 'required',
        //     'file' => 'required|mimes:jpeg,png,jpg|max:5000',
        // ]);
        
        // // $file = $request->customFile('file');
        
        // $fileName = time().'.'.$request->file('file')->extension();  
   
        // $request->file->move(public_path('uploads'), $fileName);

        
        $proposal = Proposal::create([
            "admin_id" => Auth::user()->id,
            "eventName" => $request->judul,
            "eventTimeHeld" => $request->tanggalPel,
            "file" => '1',
         ]);

         if(!$proposal){
            return redirect('/admin/acara/create');
         } else {
             return redirect('/admin/acara');
         }
     }
}
