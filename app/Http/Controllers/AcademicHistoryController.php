<?php

namespace App\Http\Controllers;

use App\academic_history;
use Illuminate\Http\Request;

class AcademicHistoryController extends Controller
{
    public function update(){
        if(request('school')){
//            dd("Yes");
//            dd(\request()->all());

            $data = request()->validate([
               'school.*' => 'required|string|min:3' ,
               'course.*' => 'required|string|min:3',
               'certification.*' => 'required|string|min:3',
                'start' => 'required',
                'end' => 'required',
                'id' => ''
            ]);

            for ($i=0; $i<count($data['school']); $i++){
                $ach = academic_history::find($data['id'][$i]);
//                print_r($ach);
                $ach->school = $data['school'][$i];
                $ach->course = $data['course'][$i];
                $ach->certification = $data['certification'][$i];
                $ach->start = $data['start'][$i];
                $ach->end = $data['end'][$i];

                $ach->save();
            }
        }
        dd("Updated");
    }

    public function store(){
        if(request('school')){
            $data = \request()->validate([
                'school.*' => 'required|string|min:3' ,
                'course.*' => 'required|string|min:3',
                'certification.*' => 'required|string|min:3',
                'start' => 'required',
                'end' => 'required',
            ]);

            for ($i=0; $i<count($data['school']); $i++){

                academic_history::create([
                    'school' => $data['school'][$i],
                    'course' => $data['course'][$i],
                    'certification' => $data['certification'][$i],
                    'start' => $data['start'][$i],
                    'end' => $data['end'][$i],
                    'profile_id' => auth()->user()->profile->id
                ]);

            }
        }
        dd("Stored");
    }

    public function destroy(academic_history $academic_history){
        $user = $academic_history->profile->user->id;
        if($user == auth()->user()->id){
            $academic_history->delete();
            $str = "/profile/" .$user;
            return redirect($str);
        }

    }
}
