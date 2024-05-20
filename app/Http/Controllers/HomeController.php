<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $income = Transaction::sum('total_bayar');
        $customer = Customer::count('customer');
        $product = product::count('product');
        $productSold = TransactionDetail::sum('qty');
        return Inertia::render('Dashboard', [
            'income' => $income,
            'customer' => $customer,
            'product' => $product,
            'productSold' => $productSold,
            'title' => 'Dashboard'
        ]);
    }
}
