<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LinkController extends Controller
{
    private $text;

    public function __construct(Request $request)
    {
        $this->text = $request->route('text');
    }

    public function link(){
        $link = DB::table('links')
            ->where('text', $this->text)->get();
        if($link->redirect == "admin-new"){
            $user = User::where('email', $link->value)->get();
            return view('admin.admin-new', compact('user'));
        }
//        return redirect($link->redirect);
    }
}
