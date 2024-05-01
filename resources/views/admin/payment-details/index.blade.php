@extends('admin.layouts.master')

@section('title', 'Payment Details')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Payment Details</li>
@endSection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Payment Details List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>Status</th>
                            <th>Method</th>
                            <th>Payment Id</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($paymentDetails as $paymentDetail)
                            <tr>
                                <td>{{ $paymentDetails->firstItem() + $loop->index }}</td>
                                <td>
                                    @if ($paymentDetail->status == 'paid')
                                        <span class="badge badge-success">Paid</span>
                                    @else
                                        <span class="badge badge-danger">Failed</span>
                                    @endif
                                </td>
                                <td><img src="{{ asset('../../dist/img/credit/visa.png') }}" alt=""></td>
                                <td>{{ $paymentDetail->payment_id }}</td> 
                                <td>{{ $paymentDetail->amount }}$</td>   
                                <td>{{ date('d M Y', strtotime($paymentDetail->created_at)) }}</td>
                                <td> 
                                    <div class="btn-group">
                                        <form action="{{ route('admin.paymentDetails.destroy', $paymentDetail->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">
                                              <i class="fas fa-trash"></i> 
                                              Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>      
                            @empty
                                <tr>
                                    <td colspan="10">No payments found.</td>
                                </tr>                          
                            @endforelse                          
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                      {{ $paymentDetails->links() }}
                    </div>
                  </div>
            </div>
        </div>
</section>

@endSection