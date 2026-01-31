@include('frontend.layouts.userHeader')

<div class="utf_dashboard_content">
    <div id="titlebar" class="dashboard_gradient">
        <div class="row">
            <div class="col-md-12">
                <h2>Profile</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>Dashboard</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="utf_dashboard_list_box margin-top-0">
                <h4 class="gray"><i class="sl sl-icon-user"></i> Profile Details</h4>
                <div class="utf_dashboard_list_box-static">
                    <form action="{{url('profileUpdate')}}" method="post">
                        @csrf
                    <div class="my-profile">
                        <div class="row with-forms">
                            <div class="col-md-4">
                                <label>Name</label>
                                <input type="text" name="user_name" class="input-text" placeholder="Enter Your Full Name" value="{{Auth::user()->name}}" required>
                            </div>
                            <div class="col-md-4">
                                <label>Contact No</label>
                                <input type="text" name="user_contact_no" class="input-text" placeholder="Enter Contact Number" value="{{Auth::user()->contact_no}}" required>
                            </div>
                            <div class="col-md-4">
                                <label>Email</label>
                                <input type="text" name="user_email" class="input-text" placeholder="Enter Email Address" value="{{Auth::user()->email}}" required>
                            </div>
                            {{-- <div class="col-md-4">
                                <label>Password</label>
                                <input type="text" name="user_password" class="input-text" placeholder="Enter Email Address" value="{{Auth::user()->password}}" required>
                            </div> --}}
                            <div class="col-md-4">
                                <label>Country</label>
                                <input type="text" name="user_country" class="input-text" placeholder="Enter Country Name" value="{{Auth::user()->country}}" required>
                            </div>
                            <div class="col-md-4">
                                <label>City</label>
                                <input type="text" name="user_city" class="input-text" placeholder="Enter City Name" value="{{Auth::user()->city}}" required>
                            </div>
                            <div class="col-md-4">
                                <label>Pin Code</label>
                                <input type="text" name="user_pin_code" class="input-text" placeholder="Enter Pin Code" value="{{Auth::user()->pin_code}}" required>
                            </div>
                            <div class="col-md-12">
                                <label>Address</label>
                                <textarea name="user_address" cols="30" rows="10" required>{{Auth::user()->address}}</textarea>
                            </div>

                        </div>
                    </div>
                    <button type="submit" class="button preview btn_center_item margin-top-15">Save Changes</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('frontend.layouts.userFooter')
