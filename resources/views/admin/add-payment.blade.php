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
                       
                    <form action="{{url('add-user')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Enter New User">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-info btn-fill">Add New User</button>

                            </div>
                        </div>
                    </form>
                      <hr>
                        <form action="{{route('payments.store')}}" method="POST">
                            @csrf
                         

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                       <select name="user_id" id="" class="form-control">
                                           <option value="">Select User Name</option>
                                           @foreach ($users as $user)
                                             <option value="{{$user->id}}">{{$user->name}}</option>
                                           @endforeach
                                       </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Payment</label>
                                        <input type="number" class="form-control" placeholder="Payment" name="payment">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Due Date</label>
                                        <input type="date" class="form-control" placeholder="Due Date" name="due_date">
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

