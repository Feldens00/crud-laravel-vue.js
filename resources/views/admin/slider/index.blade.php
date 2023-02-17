@extends('admin.admin_master')

@section('admin')
    
    <div class="py-5">
        
       <div class="container">
           <div class="row">

                <div class="col-md-12 py-3">
                    <h3>Home Slide</h3>
                    <a href="{{ route('add.slider') }}">
                        <button type="button" class="btn btn-info mt-2">
                            Add Slide
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

                       <div class="card-header">All Slide</div>
                       <div class="card-body">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" width="5%">SL No</th>
                                        <th scope="col" width="15%">Slide Title</th>
                                        <th scope="col" width="25%">Slide Description</th>
                                        <th scope="col" width="15%">Slide Image</th>
                                        <th scope="col" width="15%">Created At</th>
                                        <th scope="col" width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach($sliders as $slide)
                                    <tr>
                                        <th scope="row"> {{ $i++ }} </th>
                                        <td> {{ $slide->title }} </td>
                                        <td> {{ $slide->description }} </td>
                                        <td> <img src=" {{ asset($slide->image) }} " style="width: 70px; height: 40px;"> </td>
                                        <td> 
                                            @if($slide->created_at == NULL) 
                                                <span class="text-danger">No date Set</span>
                                            @else   
                                                
                                                {{ Carbon\Carbon::parse($slide->created_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-info">Edit</a>
                                            <a href="" class="btn btn-danger" onclick="return confirm('Are you sure to delete')">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="col-md-12 pb-2">
                                {{ $sliders->links() }}
                            </div>
                       </div>
                   </div>
               </div>

           </div>
       </div>

    </div>

@endsection
