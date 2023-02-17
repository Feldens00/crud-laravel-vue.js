@extends('admin.admin_master')

@section('admin')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Change Password</h2>
                    </div>

                    <div class="card-body">
                        <form class="form-pill" method="POST" action="{{ route('update.password') }}">
                        @csrf

                            <div class="form-group">
                                <label for="old_password">Current Password</label>
                                <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Current Password">
                                
                                @error('old_password')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="New Password">
                                @error('password')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Password</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                                @error('confirm_password')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-default">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection