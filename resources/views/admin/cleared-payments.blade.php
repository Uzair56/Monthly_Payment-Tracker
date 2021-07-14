@extends('layouts.theme')
@section('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.css" integrity="sha512-DYOwgMAsSbNzrSwEU3nQ7bcYo5aEqpIq1lOe5doeuUwXjuFYjIPvIZDZrEOH+QMIXvRpqcc8gPKcoIMIyAZMCg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @include('alertsinfo')
                    <div class="header">
                        <div class="row">
                            <div class="col-lg-6">
                                    <h4 class="title">Cleared Payments</h4>
                            </div>
                            <div class="col-lg-6">
                                <a href="{{url('add-payment')}}" class="btn btn-info btn-fill pull-right">Add Payment</a>
                            </div>
                        </div>
                    </div>   
                    <div class="card-body">
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped" id="payments">
                                <thead>
                                    <th>Sr No.</th>
                                    <th>Name</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>Due Date</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$payment->users->name}}</td>
                                        <td>{{$payment->payment}}</td>
                                        <td>
                                            @if ($payment->status==0)
                                                <p class="text-danger">Pending</p>
                                            @else
                                              <p class="text-info">Clear</p>
                                             @endif
                                        </td>
                                        <td>{{$payment->due_date}}</td>
                                        <td>
                                          
                                                <a href="javascript:;" class="btn btn-danger btn-sm delete" data-id="{{encrypt($payment->id)}}" title="Delete"><i class="pe-7s-trash"></i></a>


                                        </td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>   
                </div>
            </div>
        </div>

    </div>
</div>      

   
@endsection
@section('script')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js" integrity="sha512-mBSqtiBr4vcvTb6BCuIAgVx4uF3EVlVvJ2j+Z9USL0VwgL9liZ638rTANn5m1br7iupcjjg/LIl5cCYcNae7Yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready( function () {
        $('#payments').DataTable();
     } );

   $(document).on('click','.delete',function(){
    var uid = $(this).data('id');
       tr = $(this).closest('tr');

       
     Swal.fire({
         title: 'Are you sure?',
         text: "You won't be able to revert this!",
         type: "warning",
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, delete it!'
     }).then((result)=>
         {
             if(result.value)
             {
                        $.ajaxSetup({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        method: 'post',
                        data: {'_method': 'DELETE'},
                        url: '{{url('delete-payment/')}}/' + uid,
                        
                    }).done(function (response) {
            
                                Swal.fire("Deleted!",response.msg, "success");
                                var table = $('#payments').DataTable();
                                table.row(tr).remove().draw();
                                setTimeout(function() {
                                    location.reload();
                                }, 500);
                                
                        }).fail(function (response) {
                            swal.fire("Cancelled",response.statusText, "error");
                        });
             }
         }
     )
   });
   
   //clear payments
//    $(document).on('click','.clear',function(){
//     var uid = $(this).data('id');
//        tr = $(this).closest('tr');

       
//      Swal.fire({
//          title: 'Are you sure?',
//          text: "You won't be able to revert this!",
//          type: "warning",
//          showCancelButton: true,
//          confirmButtonColor: '#3085d6',
//          cancelButtonColor: '#d33',
//          confirmButtonText: 'Yes, clear it!'
//      }).then((result)=>
//          {
//              if(result.value)
//              {
//                         $.ajaxSetup({
//                         headers: {
//                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                         }
//                     });
//                     $.ajax({
//                         method: 'post',
//                         url: '{{url('clear-payment/')}}/' + uid,
                        
//                     }).done(function (response) {
            
//                                 Swal.fire("Cleared",response.msg, "success");
//                                 var table = $('#payments').DataTable();
//                                  setTimeout(function() {
//                                     location.reload();
//                                 }, 500);

                             
                                
//                         }).fail(function (response) {
//                             swal.fire("Cancelled",response.statusText, "error");
//                         });
//              }
//          }
//      )
//    });
</script>
@endsection
   
