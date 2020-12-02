<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailTemplateController extends Controller
{
    public function index(){
        $templates = DB::table('mail_templates')->latest()->paginate(20);
        return view('admin.mail.templates.index', compact('templates'));
    }

    public function show(string $template){
        $template = DB::table('mail_template')->where('id', $template)->get();
        return view('admin.mail.templaets.show', compact('template'));
    }

    public function save(){
        $data = request()->validate([
            'subject' => 'required|string|min:3',
            'body' => 'required|string'
        ]);

        DB::table('mail_templates')->insert([
            'subject' => $data['subject'],
            'body' => $data['body'],
            'created_at' => Carbon::now()
        ]);

    }

    public function delete(String $template){
        DB::table('mail_templates')->where('id', $template)->delete();
        session()->flash('msg', 'Template Deleted');
        return redirect()->back();
    }
}
