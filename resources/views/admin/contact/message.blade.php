@extends('admin.admin_master')

@section('admin')
    
    <div class="py-5">
        
       <div class="container">
           <div class="row">

                <div class="col-md-12 py-3">
                    <h3>Admin message</h3>
                </div>

               <div class="col-md-12">
                   <div class="card">

                   @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                       <div class="card-header">All Messages</div>
                       <div class="card-body">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col"">SL No</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach($messages as $msg)
                                    <tr>
                                        <th scope="row"> {{ $i++ }} </th>
                                        <td> {{ $msg->name }} </td>
                                        <td> {{ $msg->email }} </td>
                                        <td> {{ $msg->subject }} </td>
                                        <td> {{ $msg->message }} </td>
                                        <td> 
                                            @if($msg->created_at == NULL) 
                                                <span class="text-danger">No date Set</span>
                                            @else   
                                                
                                                {{ Carbon\Carbon::parse($msg->created_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('message/delete/' . $msg->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure to delete')">Delete</a>
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

@endsection
