<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentMethodRequest;
use App\Http\Requests\UpdatePaymentMethodRequest;
use App\Models\PaymentMethod;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;

class PaymentMethodController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', PaymentMethod::class);
        $paymentMethods = PaymentMethod::paginate(15);
        return view('payment-methods.index', compact('paymentMethods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', PaymentMethod::class);
        return view('payment-methods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentMethodRequest $request)
    {
        $this->authorize('create', PaymentMethod::class);
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
        $this->authorize('update', $paymentMethod);
        return view('payment-methods.edit', compact('paymentMethod'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentMethodRequest $request, PaymentMethod $paymentMethod)
    {
        $this->authorize('update', $paymentMethod);
        $validatedData = $request->validate([
        'name' => [
            'required',
            'string',
            // Ignore the current method's ID for the unique check
            Rule::unique('payment_methods')->ignore($paymentMethod->id),
        ],
        'description' => 'required|string',
    ]);

    $paymentMethod->update($validatedData);

    return redirect()->route('payment-methods.index')
        ->with('success', 'Payment Method "' . $paymentMethod->name . '" updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        $this->authorize('delete', $paymentMethod);
        // Check for dependent payments
    if ($paymentMethod->payments()->exists()) {
        return redirect()->back()
            ->with('error', 'Cannot delete payment method. It has been used in existing payments.');
    }

    $paymentMethod->delete();

    return redirect()->route('payment-methods.index')
        ->with('success', 'Payment Method deleted successfully.');
    }
}
