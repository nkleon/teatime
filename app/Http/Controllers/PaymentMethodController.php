<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentMethodRequest;
use App\Http\Requests\UpdatePaymentMethodRequest;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentMethods = \App\Models\PaymentMethod::paginate(15);
        return view('payment_methods.index', compact('paymentMethods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create_payment_method');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentMethodRequest $request)
    {
        PaymentMethod::create($request->validated());
        return redirect()->route('payment-methods.index')->with('success', 'Payment Method added');

    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentMethodRequest $request, PaymentMethod $paymentMethod)
    {
        $validatedData = $request->validate([
        'name' => [
            'required',
            'string',
            // Ignore the current method's ID for the unique check
            Rule::unique('payment_methods')->ignore($paymentMethod->id),
        ],
        'description' => 'nullable|string',
    ]);

    $paymentMethod->update($validatedData);

    return redirect()->route('payment_methods.index')
        ->with('success', 'Payment Method "' . $paymentMethod->name . '" updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        // Check for dependent payments
    if ($paymentMethod->payments()->exists()) {
        return redirect()->back()
            ->with('error', 'Cannot delete payment method. It has been used in existing payments.');
    }

    $paymentMethod->delete();

    return redirect()->route('payment_methods.index')
        ->with('success', 'Payment Method deleted successfully.');
    }
}
