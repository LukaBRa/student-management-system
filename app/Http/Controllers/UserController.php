<?php

namespace App\Http\Controllers;

use App\Mail\SignUp;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    public function registerProfessor(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'adress' => 'required',
            'phoneNumber' => 'required'
        ], [
            'name.required' => 'Ime je obavezno.',
            'email.required' => 'Email adresa je obavezna.',
            'email.email' => 'Email adresa nije ispravna.',
            'email.unique' => 'Email adresa već postoji.',
            'adress.required' => 'Adresa je obavezna',
            'phoneNumber.required' => 'Broj telefona je obavezan'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); 
        $alphaLength = strlen($alphabet) - 1; 
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $password = implode($pass);

        $professor = new User;

        $professor->type_id = 2;
        $professor->class_id = null;
        $professor->name = $request->name;
        $professor->email = $request->email;
        $professor->password = $password;
        $professor->adress = $request->adress;
        $professor->phone_number = $request->phoneNumber;

        $professor->save();

        if(count($request->checkedSubjects) != 0){

            $subjects = Subject::whereIn('id', $request->checkedSubjects)->get();

            foreach($subjects as $subject){
                $professor->professorsSubjects()->attach($subject);
            }

        }

        Mail::to($request->email)->send(new SignUp($request->name, $password));

        return redirect("/profesori");
    }
    
}
