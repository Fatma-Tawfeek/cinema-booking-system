<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PaymentDetail;
use App\Http\Controllers\Controller;

class PaymentDetailController extends Controller
{

    public function index()
    {
        $paymentDetails = PaymentDetail::paginate(15);
        return view('admin.payment-details.index', compact('paymentDetails'));
    }

    public function destroy(PaymentDetail $paymentDetail)
    {
        $paymentDetail->delete();
        return redirect()->route('admin.paymentDetails.index')->with('success', 'Payment detail deleted successfully.');
    }
}
