@extends('admin.admin_master')

@section('admin')
    
    <div class="py-5">
        
       <div class="container">
           <div class="row">

               <div class="col-md-8">
                  <div class="card-group">
                       <div class="row">
                            @foreach($images as $img)
                                <div class="col-md-4 mt-3">
                                    <div class="card">
                                        <img src="{{ asset($img->image) }}" class="img-fluid">
                                    </div>
                                </div>
                            @endforeach
                       </div>
                  </div>
               </div>

               <div class="col-md-4">
                   <div class="card">
                       <div class="card-header">
                           Multi Image
                       </div>
                        <div class="card-body">
                            <form action="{{ route ('store.multi') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="input-Multipicture-name">Multipicture Image</label>
                                    <input type="file" class="form-control mb-2" id="input-multipicture-image" name="image[]" multiple="" placeholder="Enter Multipicture name">

                                    @error('image')
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
