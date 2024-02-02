<?php

namespace App\Http\Controllers;

use App\Constants\Transaction as TransactionConstant;
use App\Http\Requests\FriendRequest;
use App\Models\Friend;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class FriendController extends Controller
{
    
    public function index(): View
    {
        $friends = Friend::all();
        return view('friends.index',compact('friends'));
    }

    function lendMoneyToFriend(FriendRequest $request, Friend $friend) : RedirectResponse
    {
        $amount = $request->validated('amount');

        $transaction = new Transaction([
            'type'   => TransactionConstant::TYPE_LOAN,
            'transaction_date'    => now()->format('Y-m-d'),
            'transaction_details' => $request->validated('transaction_details'),
            'amount' => $amount,
        ]);
        $friend->transactions()->save($transaction);
        $friend->increment('total_loan', $amount);
        
        return redirect()->route('friends')->with('success', 'Money lent successfully done.');
    }

    public function receiveRepaymentFromFriend(FriendRequest $request, Friend $friend)
    {
        $amount = $request->input('amount');
        
        $transaction = new Transaction([
            'type' => TransactionConstant::TYPE_REPAID,
            'amount' => $amount,
        ]);

        $friend->transactions()->save($transaction);
        $friend->increment('repaid_amount', $amount);

        return redirect()->route('friends')->with('success', 'Repayment received successfully.');
    }

 
}
