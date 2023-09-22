<?php

namespace App\Http\Controllers;

use App\Models\Concultation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ConcultationController extends Controller
{
    
    public function addAppointment(Request $request): RedirectResponse{

        if($request->fromHours == "" || 
        $request->fromMinutes == "" || 
        $request->toHours == "" || 
        $request->toMinutes == "" ||
        $request->dayOfWeek == "" ||
        $request->roomName == ""
        ){
            return back()->withErrors(['errorMsg' => "Molimo Vas unesite sve podatke."]);
        }

        $consultation = new Concultation;

        $consultation->professor_id = Auth::user()->id;
        $consultation->consultation_appointment = $request->dayOfWeek . " od " . $request->fromHours . ":" . $request->fromMinutes . " do " . $request->toHours . ":" . $request->toMinutes;
        $consultation->room_name = $request->roomName;
        $consultation->save();

        return redirect("/");
    }

    public function deleteAppointment(Request $request) {

        if(Concultation::where('id', '=', $request->appId)->delete()){
            return response()->json('success');
        }else{
            return response()->json('error');
        }

    }

}
