@extends('layouts.theme')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Add Payment</h4>
                    </div>
                    <div class="content">
                        <form action="{{url('update-payment/'.$user->id)}}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{$user->name}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Payment</label>
                                        <input type="number" class="form-control" placeholder="Payment" name="payment" value="{{$user->payment}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Due Date</label>
                                        <input type="date" class="form-control" placeholder="Due Date" name="due_date" value="{{ \Carbon\Carbon::createFromDate($user->year,$user->month,$user->day)->format('Y-m-d')}}" >
                                    </div>
                                </div>
                            </div>

                          

                            <button type="submit" class="btn btn-info btn-fill pull-right">Add Payment</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
           

        </div>
    </div>
</div>
@endsection

