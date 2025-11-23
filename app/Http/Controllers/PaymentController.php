<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Collection;
use App\Models\Farm;
use App\Models\Payment;
use App\Models\PaymentMethod;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Payment::class);
        $user = auth()->user();
        if ($user->role_id == 1) {
            // Admin sees all collections
            $collections = Collection::pluck('id')->toArray();
        } elseif ($user->role_id == 3) {
            // Picker: collections assigned to them
            $collections = Collection::where('picker_id', $user->id)->pluck('id')->toArray();
        } elseif ($user->role_id == 2) {
            // Owner: collections on their farms
            $collections = Collection::whereHas('farm', function ($query) use ($user) {
                $query->where('owner_id', $user->id);
            })->pluck('id')->toArray();
        } else {
            $collections = [];
        }

        // Retrieve payments for those collections
        $payments = Payment::whereIn('collection_id', $collections)
            ->with(['collection.farm', 'collection.picker', 'payment_method'])
            ->paginate(15);

        return view('payments.index', compact('payments'));
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Payment::class);
        // $collections = Collection::doesntHave('payment')->get();
        $user = auth()->user();
        if ($user->role_id === 1) {
            $collections = Collection::doesntHave('payment')
                ->with(['farm', 'picker'])
                ->get();
        } elseif ($user->role_id == 2) {
            $collections = Collection::doesntHave('payment')
                ->whereHas('farm', function ($q) use ($user) {
                    $q->where('owner_id', $user->id);
                })
                ->with(['farm', 'picker'])
                ->get();
        }
        $payment_methods = PaymentMethod::all();
        return view('payments.create', compact('collections', 'payment_methods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        $this->authorize('create', Payment::class);
        $validated = $request->validated();
        $collection = Collection::findOrFail($validated['collection_id']);
        $farm = Farm::findOrFail($collection->farm_id);
        $validated['amount'] = $farm->rate * $collection->quantity;
        // dd($validated);
        Payment::create($validated);
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
        $this->authorize('update', $payment);
        $user = auth()->user();
        $collection = $payment->collection;
        $other_collections = Collection::doesntHave('payment')
            ->when($user->role_id === 2, function ($query) use ($user) {
            // Only collections on farms owned by this user
            $query->whereHas('farm', fn($q) => $q->where('owner_id', $user->id));
        })
        ->with(['farm', 'picker'])
        ->get();
        $collections = collect([$collection])->merge($other_collections);
        $payment_methods = PaymentMethod::all();
        return view('payments.edit', compact('payment', 'collections', 'payment_methods'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $this->authorize('update', $payment);
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
        $this->authorize('delete', $payment);
        $payment->delete();

    // Notify the user that the associated collection is now marked as UNPAID.
    return redirect()->route('payments.index')
        ->with('warning', 'Payment record successfully DELETED. The associated collection is now unpaid.');
    }
}
