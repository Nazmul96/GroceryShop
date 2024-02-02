<?php

namespace App\Http\Controllers;
use App\Constants\Transaction as TransactionConstant;
use App\Models\Transaction;
use App\Http\Requests\SellTransactionRequest;
use App\Http\Requests\supplierTransactionRequest;
use App\Models\Customer;
use App\Models\Friend;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function sellTransaction(SellTransactionRequest $request) 
    {
        $validatedData = $request->validated();
        $validatedData['type'] = TransactionConstant::TYPE_INCOME;
        $validatedData['transaction_date'] = now()->format('Y-m-d');
        Transaction::create($validatedData);

        return redirect()->back()->with('success', 'Customer transaction successfully complete');
    }

    public function showFriendTransactions(Friend $friend): JsonResponse
    {
        $transactions = $friend->transactions;

        return response()->json(['friend' => $friend, 'transactions' => $transactions]);
    }

    public function showCustomerTransactions(Customer $customer): JsonResponse
    {
        $transactions = $customer->transactions;

        return response()->json(['customer' => $customer, 'transactions' => $transactions]);
    }

    public function supplierTransaction(supplierTransactionRequest $request) 
    {
        $validatedData = $request->validated();
        $validatedData['type'] = TransactionConstant::TYPE_EXPENSE;
        $validatedData['transaction_date'] = now()->format('Y-m-d');
        Transaction::create($validatedData);

        return redirect()->back()->with('success', 'Supplier transaction successfully complete');
    }

    public function showSupplierTransactions(Supplier $supplier): JsonResponse
    {
        $transactions = $supplier->transactions;

        return response()->json(['supplier' => $supplier, 'transactions' => $transactions]);
    }

}
