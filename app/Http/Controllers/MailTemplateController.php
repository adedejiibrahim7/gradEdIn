<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailTemplateController extends Controller
{
    public function index(){
        return view('admin.mail.templates.index');
    }
}
