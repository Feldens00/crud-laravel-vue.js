<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category
        </h2>
    </x-slot>
    
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

                       <div class="card-header">All Category</div>
                       <div class="card-body">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">SL No</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                    <tr>
                                        <th scope="row"> {{ $categories->firstItem()+$loop->index }} </th>
                                        <td> {{ $category->category_name }} </td>
                                        <td> {{ $category->user->name }} </td>
                                        <td> 
                                            @if($category->created_at == NULL) 
                                                <span class="text-danger">No date Set</span>
                                            @else   
                                                
                                                {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('category/edit/' . $category->id) }}" class="btn btn-info">Edit</a>
                                            <a href="{{ url('/category/soft-delete/' . $category->id) }}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="col-md-12 pb-2">
                                {{ $categories->links() }}
                            </div>
                       </div>
                   </div>
               </div>

               <div class="col-md-4">
                   <div class="card">
                       <div class="card-header">
                           Add Category
                       </div>
                        <div class="card-body">
                            <form action="{{ route ('store.category') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="input-category-name">Category Name</label>
                                    <input type="text" class="form-control mb-2" id="input-category-name" name="category_name" placeholder="Enter category name">

                                    @error('category_name')
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

       <!-- Trash area -->
       <div class="container pt-5">
           <div class="row">

               <div class="col-md-8">
                   <div class="card">

                       <div class="card-header">Trash</div>
                       <div class="card-body">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">SL No</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($trash_categories as $category)
                                    <tr>
                                        <th scope="row"> {{ $categories->firstItem()+$loop->index }} </th>
                                        <td> {{ $category->category_name }} </td>
                                        <td> {{ $category->user->name }} </td>
                                        <td> 
                                            @if($category->created_at == NULL) 
                                                <span class="text-danger">No date Set</span>
                                            @else   
                                                
                                                {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('category/restore/' . $category->id) }}" class="btn btn-info">Restore</a>
                                            <a href="{{ url('category/permanent-delete/' . $category->id) }}" class="btn btn-danger">Permanent Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="col-md-12 pb-2">
                                {{ $trash_categories->links() }}
                            </div>
                       </div>
                   </div>
               </div>

               <div class="col-md-4">
                   
               </div>

           </div>
       </div>

    </div>


</x-app-layout>