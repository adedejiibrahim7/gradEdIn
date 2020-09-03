<?php

namespace App\Http\Controllers;

use App\Application;
use App\opportunity;
use App\profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(opportunity $opportunity){
        $this->authorize('view', $opportunity);
        $applications = Application::latest()->where('opportunity_id', $opportunity->id)->paginate(10);
//        dd($applications[0]->profile);
//        $profiles = profile::all()->whereIn('id', $applications->pluck('profile_id'));
        $starred_ = Application::latest()->where('opportunity_id', $opportunity->id)->where('status', "starred")->paginate(10);
//        dd($applications->links());
//        $starred_profiles = profile::all()->whereIn('id', $starred);
//        dd($starred_profiles);
//        $resume = Application::where('opportunity_id', $opportunity->id)->whereIn('profile_id', $applicant_profiles)->pluck('resume');
        return view('applications.index', compact( 'opportunity', 'starred_', 'applications'));
    }

    public function apply(opportunity $opportunity){
//        dd(request()->all());
        if(request('resume')){
            request()->validate([
               'resume' => ['mimes:doc,docx,pdf', 'max:2048']
            ]);
            $resume = request('resume')->store('uploads/application_docs', 'public');

//            $resume = Storage::disk('public')->put('uploads/application_docs', request('resume'));;
        }else{
            $resume = '';
        }
        if(request('cover_letter')){
            request()->validate([
                'cover_letter' => ['mimes:doc,docx,pdf', 'max:2048']
            ]);
            $cover_letter = request('cover_letter')->store('uploads/application_docs', 'public');
//            $cover_letter = Storage::disk('public')->put('uploads/application_docs', request('cover_letter'));
        }else{
            $cover_letter = '';
        }
        $applied = Application::all()->where('profile_id', auth()->user()->profile->id)->where('opportunity_id', $opportunity->id);
//        $applied = Application::all()->where('profile_id',  2);

        if($applied->count() == 0){
            Application::create([
                'profile_id' => auth()->user()->profile->id,
                'opportunity_id' => $opportunity->id,
                'resume' => $resume,
                'cover_letter' => $cover_letter
            ]);

            $str = "Application for  $opportunity->title  successsful!";

        }else{
            $str = "You already applied for {{ $opportunity->title }}";
        }

//        dd($str);
        session()->flash('msg', $str);
        $opportunities = opportunity::all();
//        return view('opportunities.index', compact('opportunities'));
        return redirect('/home');
    }

    public function myApplications(){
        $applications = Application::where('profile_id', auth()->user()->profile->id)->paginate(10);
        return view('user/applications', compact('applications'));
    }
    public function star(Application $application){
//        dd($application->status);
        if($application->status == "pending"){
            $application = Application::find($application->id);
            $application->status = "starred";
            $application->save();
            return "starred";
        }elseif ($application->status == "starred"){
            $application = Application::find($application->id);
            $application->status = "pending";
            $application->save();
            return "unstarred";
        }
    }

    public function DownloadCSV(opportunity $opportunity){
        $this->authorize('view', $opportunity);
        $file_name = "Starred Applications for " .$opportunity->title;

//        dd($opportunity);
        $callbcack = function() use ($opportunity){
            $starred_apps = Application::where('opportunity_id', $opportunity->id)->where('status', "starred")->get();
            $file_name = "Starred Applications for " .$opportunity->title;
            $array = array('Name', 'Email', 'Resume', 'Cover Letter', 'Profile');
//            header("Content-Type: text/csv; charset=utf-8", true, 200);
//            header("Content-Disposition: attachment; filename={$file_name}");

            // create a file pointer connected to the output stream
            $output = fopen('php://output', 'w');
            fputcsv($output, $array);

            foreach ($starred_apps as $row){
                $name = $row->profile->first_name. " " . $row->profile->last_name;
                $link = 'https://gradedin.herokuapp.com/profile/'.$row->profile->user->id;
                $resume = "https://gradedin.herokuapp.com/" .$row->resume;
                $cover_letter = "https://gradedin.herokuapp.com/" .$row->cover_letter;
                $arr = [$name, $row->profile->user->email, $resume, $cover_letter, $link ];
                fputcsv($output, $arr);
            }
            fclose($output);
        };

        return new StreamedResponse($callbcack, 200, [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename='.$file_name.'.csv'
        ]);

//            return $output;
//        return response()->stream($callback, 200, $headers);
//}

    }
}
