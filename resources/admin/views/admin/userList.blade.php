@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><span>Users List</span></li>
            </ul>
        </div>
        @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="md-card">
            <div class="md-card-content">

                <button class="md-btn md-btn-primary" data-uk-modal="{target:'#modalBanner'}">Add New User</button>
                <div class="uk-modal" id="modalBanner">
                    <div class="uk-modal-dialog">
                        <div class="uk-modal-header">
                            <h3 class="uk-modal-title">User Detail</h3>
                        </div>
                        <form id="form_validation" method="POST" action="{{url('admin/userStore')}}" onsubmit="return checkPasswordMatch()" >
                            @csrf

                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2">
                                    <div class="parsley-row">
                                        <label for="blog_detail">Name</label>
                                        <input type="text" name="user_name" class="md-input" />
                                    </div>
                                </div>
                                <div class="uk-width-medium-1-2">
                                    <div class="parsley-row">
                                        <label for="blog_detail">Email</label>
                                        <input type="text" name="user_email" class="md-input" />
                                    </div>
                                   
                                </div>
                                <div class="uk-width-medium-1-2">
                                    <br>
                                    <div class="parsley-row">
                                        <label for="blog_detail">Password</label>
                                        <input type="password" name="user_password" id="password" class="md-input" />
                                    </div>
                                </div>
                                <div class="uk-width-medium-1-2">
                                     <br>
                                    <div class="parsley-row">
                                        <label for="blog_detail">Confirmed Password</label>
                                        <input type="password" name="confirmPassword" id="confirmPassword" class="md-input" />
                                    <span id="message" style="color:red;"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-modal-footer uk-text-right">
                                <button type="button"
                                    class="md-btn md-btn-flat md-btn md-btn-danger uk-modal-close">Close</button>
                                <button type="submit" class="md-btn md-btn-flat md-btn md-btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

                <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Status</th>
                            <th>Name</th>
                            <th>Email</th>
                            {{-- <th>Contact No</th> --}}
                            {{-- <th>Country</th>
                            <th>City</th> --}}
                            <th>Register Date & Time</th>
                            <th>Updated Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            {{-- <th></th> --}}
                            {{-- <th></th>
                            <th></th> --}}
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($userList as $userListRow)
                            <tr>
                                <td>{{ $i++ }}</td>
                                 <td>
                                    @if ($userListRow['status'] == STATUS_INACTIVE)
                                        <span class="uk-badge uk-badge-primary">In Active</span>
                                    @else
                                        <span class="uk-badge uk-badge-success">Active</span>
                                    @endforelse
                                </td>
                                <td>{{ $userListRow['name']}}</td>
                                <td>{{ $userListRow['email']}}</td>
                                {{-- <td>{{ $userListRow['contact_no']}}</td> --}}
                                {{-- <td>{{ $userListRow['country']}}</td>
                                <td>{{ $userListRow['city']}}</td> --}}
                                <td>
                                    @if (!empty($userListRow['created_at']))
                                        {{ date('j F Y h:i:s', strtotime($userListRow['created_at'])) }}
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($userListRow['updated_at']))
                                        {{ date('j F Y h:i:s', strtotime($userListRow['updated_at'])) }}
                                    @endif
                                </td>
                                 <td>
                                    <div>
                                        <div class="uk-position-relative uk-display-inline-block"
                                            data-uk-dropdown="{pos:'bottom-right'}">
                                            <i class="md-icon material-icons">&#xE8B8;</i>
                                            <div class="uk-dropdown">
                                                <ul class="uk-nav">
                                                    <li><a
                                                            href="{{ url('admin/userEdit/' . $userListRow['id']) }}">Detail Edit</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection
    <script>
    function checkPasswordMatch() {
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("confirmPassword").value;
      const message = document.getElementById("message");

      if (password !== confirmPassword) {
        message.textContent = "Passwords do not match!";
        return false; // prevent form submission
      }

      message.textContent = ""; // clear message
      return true; // allow form submission
    }
  </script>

