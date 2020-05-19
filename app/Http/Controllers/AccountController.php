<?php

namespace App\Http\Controllers;

use App\account;
use App\Http\Requests\AccountStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{

    public function index()
    {
        return DB::table('accounts as a')
            ->leftjoin('web_accounts as wa','a.id', '=', 'wa.account_id')
            ->select(DB::raw('count(wa.id) as total, a.*'))
            ->groupBy('a.id')
            ->get();
    }

    public function store(AccountStore $request)
    {
        $account = new Account();
        $account->account = $request->account;
        $account->password = $request->password;
        $account->description = $request->description;
        $account->save();
        return $account;
    }

    public function show($id)
    {
        return Account::all()->find($id);
    }

    public function update(Request $request, $id)
    {
        $account = Account::all()->find($id);
        $account->account = $request->account;
        $account->password = $request->password;
        $account->description = $request->description;
        $account->save();

    }

    public function destroy($id)
    {
        Account::where('id', $id)->delete();
    }
}
