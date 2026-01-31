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
                    <form action="{{url('userPasswordUpdate')}}" method="post">
                        @csrf
                    <div class="my-profile">
                        <div class="row with-forms">
                            <div class="col-md-4">
                                <label>New Password</label>                                
                                <input type="text" name="user_password" class="input-text" placeholder="Enter New Password" required>
                            </div>
                            <div class="col-md-4"style="margin-top: 10px;">
                                <br>
                                <button type="submit" class="button preview btn_center_item margin-top-15">Save Changes</button>
                            </div>
                        </div>
                    </div>
                    
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('frontend.layouts.userFooter')
