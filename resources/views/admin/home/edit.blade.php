@extends('admin.admin_master')

@section('admin')

<div class="container">
    <div class="col-12">
        <div class="card card-default">
			<div class="card-header card-header-border-bottom">
				<h2>Edit about</h2>
			</div>

			<div class="card-body">
				<form action="{{ url('about/update/' . $about->id) }}" method="POST">
                    @csrf
					<div class="form-group">
						<label for="title-about">Title About</label>
						<input type="text" class="form-control" name="title_about" id="title-about" placeholder="Enter Title" value="{{ $about->title }}">
                        @error('title_about')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
					</div>

                    <div class="form-group">
						<label for="subtitle-about">Subtitle About</label>
						<textarea class="form-control" name="subtitle_about" id="subtitle-about" rows="3" >
                        {{ $about->subtitle }}
                        </textarea>
                        @error('subtitle_about')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
					</div>

					<div class="form-group">
						<label for="description-about">Description About</label>
						<textarea class="form-control" name="description_about" id="description-about" rows="3">
                            {{ $about->description }}
                        </textarea>
                        @error('description_about')
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