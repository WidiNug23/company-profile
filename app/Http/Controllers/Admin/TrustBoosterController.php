<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrustBooster;
use Illuminate\Http\Request;

class TrustBoosterController extends Controller
{
    public function index()
    {
        return view('admin.trust.index',['trusts'=>TrustBooster::all()]);
    }

    public function store(Request $r)
    {
        TrustBooster::create($r->only('title','description'));
        return back();
    }
}
