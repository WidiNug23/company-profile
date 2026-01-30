<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;

class ProfileCompanyController extends Controller
{
public function show()
{
    $profiles = CompanyProfile::orderBy('profile_id')->get();
    return view('front.companyprofile.show', compact('profiles'));
}

}
