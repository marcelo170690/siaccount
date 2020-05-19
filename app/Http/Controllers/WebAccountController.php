<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebAccountStore;
use App\webAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebAccountController extends Controller
{

    public function index(Request $request)
    {
        return WebAccount::where([
            ['web_page', 'like', '%'.$request->web_page.'%'],
            ['web_account', 'like', '%'.$request->web_account.'%'],
            ['description', 'like', '%'.$request->description.'%'],
            ['account_id', 'like', '%'.$request->account_id]
        ])->get();
    }

    public function store(WebAccountStore $request)
    {
        $webAccount = new WebAccount();
        $webAccount->account_id = $request->account_id;
        $webAccount->web_page = $request->web_page;
        $webAccount->web_account = $request->web_account;
        $webAccount->password = $request->password;
        $webAccount->description = $request->description;
        $webAccount->save();
        return $webAccount;
    }

    public function show($id)
    {
        return DB::table('web_accounts')->where('account_id', $id)->get();
    }

    public function update(Request $request, $id)
    {
        $webAccount = WebAccount::where('id', $id)->first();
        $webAccount->web_page = $request->web_page;
        $webAccount->web_account = $request->web_account;
        $webAccount->password = $request->password;
        $webAccount->description = $request->description;
        $webAccount->save();
        return $webAccount;
    }

    public function destroy($id)
    {
        webAccount::destroy($id);
    }
}
