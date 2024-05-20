<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class TransactionController extends Controller
{

    public function index(Request $request)
    {
        $filter = $request->all('search');
        $data = Transaction::with(['details', 'customer'])
                ->withSum('details', 'qty')
                ->filter($request->only('search'))
                ->paginate(8)
                ->withQueryString()
                ->through(function ($transaction) {
                    return [
                        'id' => $transaction->id,
                        'transaction_number' => $transaction->transaction_number,
                        'tgl' => $transaction->tgl,
                        'subtotal' => $transaction->subtotal,
                        'diskon' => $transaction->diskon,
                        'ongkir' => $transaction->ongkir,
                        'total_bayar' => $transaction->total_bayar,
                        'details_sum_qty' => $transaction->details_sum_qty,
                        'details' => $transaction->details->map(function ($detail) {
                            return [
                                'transaction_id' => $detail->transaction_id,
                                'product_id' => $detail->product_id,
                                'transaction_number' => $detail->transaction_number,
                                'harga_bandrol' => $detail->harga_bandrol,
                                'qty' => $detail->qty,
                                'diskon_pct' => $detail->diskon_pct,
                                'diskon_nilai' => $detail->diskon_nilai,
                                'harga_diskon' => $detail->harga_diskon,
                                'total' => $detail->total
                            ];
                        }),
                        'customer' => [
                            'id' => $transaction->customer->id,
                            'sku' => $transaction->customer->sku,
                            'customer' => $transaction->customer->customer,
                            'phone' => $transaction->customer->phone,
                        ]
                    ];
                });


        // dd($data);

        return Inertia::render('Transaksi/Index', [
            'data' => $data,
            'title' => 'History',
            'filters' => $filter
        ]);
    }

    public function create()
    {
        $products = product::all();
        $customers = Customer::all();
        return Inertia::render('Transaksi/Create',[
            'title' => 'Create Transaction',
            'product' => $products,
            'customer' => $customers
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'transaction_number' => 'required',
            'transaction_date' => 'required',
            'total' => 'required',
            'totalBayar' => 'required',
            'detail' => 'required|array',
            'detail.*.product_sku' => 'required',
            'detail.*.product_price' => 'required',
            'detail.*.qty' => 'required',
            'detail.*.discount_percent' => 'nullable',
            'detail.*.discount_price' => 'nullable',
            'detail.*.total_discount_price' => 'nullable',
            'detail.*.grand_total' => 'nullable'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->getMessageBag());
        }

        $transaction = Transaction::create([
            'transaction_number' => $request->get('transaction_number'),
            'tgl' => $request->get('transaction_date'),
            'customer_id' => $request->get('customer_id'),
            'subtotal' => $request->get('total'),
            'diskon' => $request->get('discountTransaction'),
            'ongkir' => $request->get('ongkir'),
            'total_bayar' => $request->get('totalBayar')
        ]);


        foreach($request->get('detail') as $row)
        {
            if (is_array($row)) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'transaction_number' => $request->get('transaction_number'),
                    'product_id' => $row['product_id'],
                    'harga_bandrol' => $row['product_price'],
                    'qty' => $row['qty'],
                    'diskon_pct' => $row['discount_percent'],
                    'diskon_nilai' => $row['discount_price'],
                    'harga_diskon' => $row['total_discount_price'],
                    'total' => $row['grand_total']
                ]);
            } else {
                return redirect()->back()->withErrors('Something went wrong..');
            }
        }
        return redirect()->route('transaksi.history')->with('success', 'Transaction Successfully created!');


    }
}
