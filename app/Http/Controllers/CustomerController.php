<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerCreateRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->all('search');
        $data = Customer::orderBy('sku', 'desc')
        ->filter($request->only('search'))
        ->paginate(8)
        ->withQueryString()
        ->through(fn ($customers) => [
            'id' => $customers->id,
            'sku' => $customers->sku,
            'customer' => $customers->customer,
            'phone' => $customers->phone
        ]);

        return Inertia::render('Customer/Index', [
            'title' => 'Customer',
            'data' => $data,
            'filters' => $filter
        ]);
    }

    public function create()
    {
        return Inertia::render('Customer/Create', [
            'title' => 'Create Customer'
        ]);
    }

    public function store(CustomerCreateRequest $request): RedirectResponse
    {

        $data = $request->validated();

        $customer = new Customer($data);
        $customer->save();

        return redirect()->route('customer')->with('success', 'Customer successfully created!');
    }

    public function edit(int $id)
    {
        $data = Customer::where('id', $id)->first();
        return Inertia::render('Customer/Edit', [
            'title' => 'Edit Customer',
            'data' => $data
        ]);
    }

    public function update(int $id, CustomerUpdateRequest $request)
    {
        $customer = Customer::where('id', $id)->first();

        $data = $request->validated();

        $customer->fill($data);
        $customer->save();

        return redirect()->route('customer')->with('success', 'Customer successfully updated!');
    }

    public function destroy(int $id)
    {
        $customer = Customer::where('id', $id)->first();
        $customer->delete();
    }

}
