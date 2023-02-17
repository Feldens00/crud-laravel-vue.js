@extends('admin.admin_master')

@section('admin')
    
    <div class="py-5">
        
       <div class="container">
           <div class="row">

               <div class="col-md-8">
                   <div class="card">

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                       <div class="card-header">All Brand</div>
                       <div class="card-body">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">SL No</th>
                                        <th scope="col">Brand Name</th>
                                        <th scope="col">Brand Image</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($brands as $brand)
                                    <tr>
                                        <th scope="row"> {{ $brands->firstItem()+$loop->index }} </th>
                                        <td> {{ $brand->brand_name }} </td>
                                        <td> <img src=" {{ asset($brand->brand_image) }} " style="width: 70px; height: 40px;"> </td>
                                        <td> 
                                            @if($brand->created_at == NULL) 
                                                <span class="text-danger">No date Set</span>
                                            @else   
                                                
                                                {{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('brand/edit/' . $brand->id) }}" class="btn btn-info">Edit</a>
                                            <a href="{{ url('/brand/delete/' . $brand->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure to delete')">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="col-md-12 pb-2">
                                {{ $brands->links() }}
                            </div>
                       </div>
                   </div>
               </div>

               <div class="col-md-4">
                   <div class="card">
                       <div class="card-header">
                           Add Brand
                       </div>
                        <div class="card-body">
                            <form action="{{ route ('store.brand') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="input-brand-name">Brand Name</label>
                                    <input type="text" class="form-control mb-2" id="input-brand-name" name="brand_name" placeholder="Enter brand name">

                                    @error('brand_name')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="input-brand-name">Brand Image</label>
                                    <input type="file" class="form-control mb-2" id="input-brand-image" name="brand_image" placeholder="Enter brand name">

                                    @error('brand_image')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                   </div>
               </div>

           </div>
       </div>

    </div>

@endsection
