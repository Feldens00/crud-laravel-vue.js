@extends('admin.admin_master')

@section('admin')

<div class="container">
    <div class="col-12">
        <div class="card card-default">
			<div class="card-header card-header-border-bottom">
				<h2>Create Slide</h2>
			</div>

			<div class="card-body">
				<form action="{{ route('store.slider') }}" method="POST" enctype="multipart/form-data">
                    @csrf
					<div class="form-group">
						<label for="title-slide">Title Slide</label>
						<input type="text" class="form-control" name="title_slide" id="title-slide" placeholder="Enter Title">
                        @error('title_slide')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
					</div>

					<div class="form-group">
						<label for="description-slide">Description Slide</label>
						<textarea class="form-control" name="description_slide" id="description-slide" rows="3"></textarea>
                        @error('description_slide')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
					</div>

					<div class="form-group">
						<label for="image-slide">Image</label>
						<input type="file" class="form-control-file" name="image_slide" id="image-slide">
                        @error('image_slide')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
					</div>

					<div class="form-footer pt-4 pt-5 mt-4 border-top">
						<button type="submit" class="btn btn-primary btn-default">Submit</button>
						<button type="submit" class="btn btn-secondary btn-default">Cancel</button>
					</div>
				</form>
			</div>
		</div>
    </div>
</div>

@endsection