<?php

namespace App\Http\Controllers;

use App\Models\CompanyDivision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function requestsPage (Request $request) {

        $user = Auth::user();

        $CompanyDivisions = CompanyDivision::whereNull('div_parent_id')
            ->where('div_sync_1c', 1)->where('div_disable', 0)
            ->with([
                'children' => function ($query) {
                    $query->where('div_sync_1c', 1)->where('div_disable', 0)->orderBy('div_name_full')->orderBy('div_id');
                },
                'children.children' => function ($query) {
                    $query->where('div_sync_1c', 1)->where('div_disable', 0)->orderBy('div_name_full')->orderBy('div_id');
                }
            ])
            ->orderBy('div_name_full')->orderBy('div_id')
            ->get();

        return view('handbookPages.requestsPage', ['CompanyDivisions' => $CompanyDivisions, 'user' => $user ]);
    }


    public function getPopupSupport(Request $request) {
        return view('components/popup/popup_support')->render();
    }
}
