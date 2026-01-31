@extends('user_admin.layouts.main')
@section('main-container')
    <script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sample.js') }}"></script>
    <div class="page-body">
        <div class="container-fluid">
            <div class="row page-title">
                 <div class="col-sm-6">
                    <h3>Profile Edit</h3>
                </div>
                <div class="col-sm-6">
                    <nav>
                        <ol class="breadcrumb justify-content-sm-end align-items-center">
                            <li class="breadcrumb-item"><a href="{{url(USER_ADMIN_URL.'dashboard')}}">Dashboard</a> / </li>
                            <li class="breadcrumb-item active">Add Coupon</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @if (session('message'))
            <div class="card-body live-dark">
                <div class="row">
                    @if(session('message') == MSG_PASSWORD_UPDATE_SUCCESS)
                        <div id="liveAlertPlaceholder">
                            <div class="alert alert-light-success mb-3 alert-dismissible" role="alert">
                                <div class="text-truncate">Password Updated Successfully!..</div>
                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"fdprocessedid="wsb8o"></button>
                                </div>
                            <div>
                    @elseif(session('message') == MSG_PASSWORD_UPDATE_ERROR)
                        <div id="liveAlertPlaceholder">
                            <div class="alert alert-light-danger mb-3 alert-dismissible" role="alert">
                                <div class="text-truncate">Password Not Update!..</div>
                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" fdprocessedid="wsb8o"></button>
                            </div>
                        <div>
                    @endforelse

                    @if(session('message') == MSG_UPDATE_SUCCESS)
                        <div id="liveAlertPlaceholder">
                            <div class="alert alert-light-success mb-3 alert-dismissible" role="alert">
                                <div class="text-truncate">Detail Updated Successfully!..</div>
                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"fdprocessedid="wsb8o"></button>
                                </div>
                            <div>
                    @elseif(session('MSG_UPDATE_ERROR') == MSG_PASSWORD_UPDATE_ERROR)
                        <div id="liveAlertPlaceholder">
                            <div class="alert alert-light-danger mb-3 alert-dismissible" role="alert">
                                <div class="text-truncate">Detail Not Update!..</div>
                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" fdprocessedid="wsb8o"></button>
                            </div>
                        <div>
                    @endforelse
                </div>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                
                <div class="col-xl-8">
                <form class="card" method="POST" action="{{ url(USER_ADMIN_URL.'profileUpdate') }}">
                     @csrf
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                  <div class="card-header">
                    <h4 class="card-title mb-0">Edit Profile</h4>
                    <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Full Name</label>
                          <input class="form-control" type="text" placeholder="Full Name" name="name" value="{{Auth::user()->name}}" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Business Name</label>
                          <input class="form-control" type="text" name="business_name" placeholder="Business Name" value="{{Auth::user()->business_name}}">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Contact No</label>
                          <input class="form-control" type="text" name="contact_no" placeholder="Contact No" value="{{Auth::user()->contact_no}}">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Email address</label>
                          <input class="form-control" type="email" name="email" disabled placeholder="Email address" value="{{Auth::user()->email}}">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Country</label>
                          <input class="form-control" type="text" name="country" placeholder="Country" value="{{Auth::user()->country}}">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">City</label>
                          <input class="form-control" type="text" name="city" placeholder="City" value="{{Auth::user()->city}}">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="mb-3">
                          <label class="form-label">Zip Code</label>
                          <input class="form-control" type="text" name="pin_code" placeholder="ZIP Code" value="{{Auth::user()->pin_code}}">
                        </div>
                      </div>
                      
                      <div class="col-md-12">
                        <div>
                          <label class="form-label">Address</label>
                          <textarea class="form-control" rows="4" name="address" placeholder="Enter Address">{{Auth::user()->address}}</textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-center">
                    <button class="btn btn-primary" type="submit" fdprocessedid="72s4l">Update Profile</button>
                  </div>
                </form>
              </div>

              <div class="col-xl-4">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title mb-0">My Profile</h4>
                    <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                  </div>
                  <div class="card-body">
                    <form onsubmit="return validatePasswords()" method="POST" action="{{ url(USER_ADMIN_URL.'passwordUpdate') }}" >
                        @csrf
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                      <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input class="form-control" type="password" name="password" id="password" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input class="form-control" type="password" id="confirm_password" required>
                        <span id="error-message" style="color:red;"></span><br>
                      </div>
                      <div class="form-footer">
                        <button class="btn btn-primary btn-block" type="submit">Save</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              
            </div>
        </div>
    </div>

    <script>
  function validatePasswords() {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm_password").value;
    const errorMessage = document.getElementById("error-message");

    if(password !== confirmPassword) {
      errorMessage.textContent = "Passwords do not match!";
      return false;
    }
    errorMessage.textContent = "";
    return true;
  }
</script>

@endsection
