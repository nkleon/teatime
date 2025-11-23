<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = \App\Models\Payment::paginate(15);
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create_payment');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        Payment::create($request->validated());
        return redirect()->route('payments.index')->with('success', 'Payment added');

    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $validatedData = $request->validate([
        'date' => 'required|date',
        'amount' => 'required|numeric|min:0.01',
        
        // **CRITICAL UNIQUE CHECK**: collection_id should only exist once.
        'collection_id' => [
            'required',
            'exists:collections,id',
            // Ignore the current payment's ID
            Rule::unique('payments')->ignore($payment->id),
        ],
        
        'method_id' => 'required|exists:payment_methods,id', // FK check
    ]);

    $payment->update($validatedData);

    return redirect()->route('payments.index')
        ->with('success', 'Payment record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

    // Notify the user that the associated collection is now marked as UNPAID.
    return redirect()->route('payments.index')
        ->with('warning', 'Payment record successfully DELETED. The associated collection is now unpaid.');
    }
}
