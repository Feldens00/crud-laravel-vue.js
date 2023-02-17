@extends('admin.admin_master')

@section('admin')
    
    <div class="py-5">
        
       <div class="container">
           <div class="row">

                <div class="col-md-12 py-3">
                    <h3>Contact Page</h3>
                    <a href="{{ route('add.contact') }}">
                        <button type="button" class="btn btn-info mt-2">
                            Add Contact
                        </button>
                    </a>
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

                       <div class="card-header">All Contacts</div>
                       <div class="card-body">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" width="5%">SL No</th>
                                        <th scope="col" width="15%">Adress</th>
                                        <th scope="col" width="15%">Email</th>
                                        <th scope="col" width="25%">Phone</th>
                                        <th scope="col" width="15%">Created At</th>
                                        <th scope="col" width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach($contacts as $contact)
                                    <tr>
                                        <th scope="row"> {{ $i++ }} </th>
                                        <td> {{ $contact->adress }} </td>
                                        <td> {{ $contact->email }} </td>
                                        <td> {{ $contact->phone }} </td>
                                        <td> 
                                            @if($contact->created_at == NULL) 
                                                <span class="text-danger">No date Set</span>
                                            @else   
                                                
                                                {{ Carbon\Carbon::parse($contact->created_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('contact/edit/' . $contact->id) }}" class="btn btn-info">Edit</a>
                                            <a href="{{ url('contact/delete/' . $contact->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure to delete')">Delete</a>
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
