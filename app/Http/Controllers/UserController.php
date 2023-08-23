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
            'phoneNumber' => 'required',
        ], [
            'name.required' => 'Ime je obavezno.',
            'email.required' => 'Email adresa je obavezna.',
            'email.email' => 'Email adresa nije ispravna.',
            'email.unique' => 'Email adresa već postoji.',
            'adress.required' => 'Adresa je obavezna',
            'phoneNumber.required' => 'Broj telefona je obavezan',
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
    
    public function registerStudent(Request $request) {

        $validator = Validator::make($request->all(), [
            'studentName' => 'required',
            'adress' => 'required',
            'studentPhoneNumber' => 'required',
            'parentsEmail' => 'required|unique:users,email',
            'motherName' => 'required',
            'fatherName' => 'required',
            'motherPhoneNumber' => 'required',
            'fatherPhoneNumber' => 'required',
            'classChecked' => 'required'
        ], [
            'studentName.required' => 'Ime učenika je obavezno.',
            'adress.required' => 'Adresa je obavezna.',
            'studentPhoneNumber.required' => 'Broj telefona učenika je obavezan.',
            'parentsEmail.required' => 'Email adresa roditelja je obavezna.',
            'parentsEmail.unique' => 'Email adresa već postoji.',
            'motherName.required' => 'Ime majke je obavezno.',
            'fatherName.required' => 'Ime oca je obavezno',
            'motherPhoneNumber.required' => 'Broj telefona majke je obavezan.',
            'fatherPhoneNumber.required' => 'Broj telefona oca je obavezan.',
            'classChecked.required' => 'Odeljenje je obavezno'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); 
        $alphaLength = strlen($alphabet) - 1; 
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $password = implode($pass);

        $student = new User;

        $student->type_id = 4;
        $student->class_id = $request->classChecked;
        $student->name = $request->studentName;
        $student->email = null;
        $student->password = null;
        $student->adress = $request->adress;
        $student->phone_number = $request->studentPhoneNumber;

        $student->save();

        $mother = new User;

        $mother->type_id = 3;
        $mother->class_id = null;
        $mother->name = $request->motherName;
        $mother->email = $request->parentsEmail;
        $mother->password = $password;
        $mother->adress = $request->adress;
        $mother->phone_number = $request->motherPhoneNumber;

        $mother->save();

        $father = new User;

        $father->type_id = 3;
        $father->class_id = null;
        $father->name = $request->fatherName;
        $father->email = null;
        $father->password = null;
        $father->adress = $request->adress;
        $father->phone_number = $request->fatherPhoneNumber;

        $father->save();

        if(count($request->subjectsChecked) != 0){

            $subjects = Subject::whereIn('id', $request->subjectsChecked)->get();

            foreach($subjects as $subject){
                $student->studentsSubjects()->attach($subject);
            }

        }

        $student->parents()->attach($mother);
        $student->parents()->attach($father);

        $mother->child()->attach($student);
        $father->child()->attach($student);

        $parentsName = $request->motherName . " i " . $request->fatherName;

        Mail::to($request->parentsEmail)->send(new SignUp($parentsName, $password));

        return redirect("/ucenici");


    }

    public function getUserName($id) {

        $userName = User::firstWhere('id', $id);

        return response()->json($userName->name);
    }

}
