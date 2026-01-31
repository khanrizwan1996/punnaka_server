@extends('user_admin.layouts.main')
@section('main-container')
<link rel="stylesheet" type="text/css" href="{{asset('user_admin/assets/css/vendors/datatables.css')}}">
       <div class="page-body">
          <div class="container-fluid">
            <div class="row page-title">
              <div class="col-sm-6">
                <h3>Franchise Other Details - <span style="color: red">{{ $franchiseData->f_name }}</span></h3>
              </div>
              <div class="col-sm-6">
                <nav>
                  <ol class="breadcrumb justify-content-sm-end align-items-center">
                    <li class="breadcrumb-item"><a href="{{url(USER_ADMIN_URL.'dashboard')}}">Dashboard</a> / </li>
                    <li class="breadcrumb-item"><a href="{{url(USER_ADMIN_URL.'franchiseList')}}">Franchise Listing Details /</a> </li>
                   </ol>
                </nav>
              </div>
            </div>
          </div>
          <div class="container-fluid">
            <div class="row">

               @if (session('message'))
                        <div class="card-body live-dark">
                            @if (session('message') == MSG_ADD_SUCCESS)
                                <div id="liveAlertPlaceholder">
                                    <div class="alert alert-light-success mb-3 alert-dismissible" role="alert">
                                        <div class="text-truncate">Data Inserted Successfully!..</div>
                                        <button class="btn-close" type="button" data-bs-dismiss="alert"
                                            aria-label="Close"fdprocessedid="wsb8o"></button>
                                    </div>
                                    <div>
                                    @else
                                        <div id="liveAlertPlaceholder">
                                            <div class="alert alert-light-danger mb-3 alert-dismissible" role="alert">
                                                <div class="text-truncate">Error In Insert!..</div>
                                                <button class="btn-close" type="button" data-bs-dismiss="alert"
                                                    aria-label="Close" fdprocessedid="wsb8o"></button>
                                            </div>
                                            <div>
                            @endforelse
                        </div>
                    @endif

              <div class="col-sm-12">
                <div class="card">
                    <div class="card-body checkbox-checked">
                        <form class="row g-3 needs-validation custom-input" novalidate="" method="POST" action="{{ url(USER_ADMIN_URL.'franchiseImageStore') }}" enctype="multipart/form-data">
                            <input type="hidden" name="fi_franchise_id" value="{{Route::input('id')}}">
                            @csrf
                            <div class="col-4">
                                <label class="form-label">Upload Franchisee Outlet Images <span class="req" style="color: red">*</span></label>
                                <label>Franchises Image <span title="Please upload jpg,jpge,png & 2 MB size file only">
                                <i class="fa fa-info-circle" style="color: #3fb4e4;"></i></span> 
                                <span class="req" style="color: red">*</span></label>
                                <input type="file" name="franchise_images[]" class="form-control mt-2" multiple required>
                                <div class="invalid-feedback">Please select image.</div>
                            </div>
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Submit form</button>        
                                </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>SR. No</th>                               
                                <th>Image</th>
                                <th>Remove</th>
                                <th>Added Date & Time</th>
                             </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                           @foreach ($getFranchiseImageData as $getFranchiseImageRow)
                            <tr>
                               <td>{{ $i++ }}</td>
                                 <td><a href="{{ url('custom-images/franchise-images/'.$getFranchiseImageRow->fi_path) }}" target="_blank" style="color: #87ceec; font-weight:bolder; text-decoration:underline"> {{ $getFranchiseImageRow->fi_path }}</a></td>
                                 <td><a href="{{url('user-admin/franchiseImageRemove/'.$getFranchiseImageRow->fi_id."/".$getFranchiseImageRow->fi_franchise_id."/".$getFranchiseImageRow->fi_path)}}">Remove</a></td>
                                 <td>{{ date('j F Y h:i:s', strtotime($getFranchiseImageRow->fi_added_time)) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-sm-12">
                <div class="card">
                    <div class="card-body checkbox-checked">
                        <form class="row g-3 needs-validation custom-input" novalidate="" method="POST" action="{{ url(USER_ADMIN_URL.'franchiseLocationDetailStore') }}" enctype="multipart/form-data">
                            <input type="hidden" name="fld_franchise_id" value="{{Route::input('id')}}">
                            @csrf
                            <div class="col-6">
                              <label>Preferred Countries & Cities <span class="req"style="color: red">*</span></label>
                              <br><br>
                                <button type="button" class="btn btn-primary" onclick="addGroup()">Add More</button>
                                  </div>
                                  <div id="inputContainer">
                                      <br>
                                      <div class="input-group">
                                          <div class="row">
                                              <div class="col-6 mb-3">
                                                  <input type="text" name="country[]" class="form-control required" placeholder="Enter Country Name">
                                              </div>
                                              <div class="col-6 mb-3">
                                                  <input type="text" name="city[]" class="form-control required" placeholder="Enter City Name">
                                              </div>
                                          </div>
                                          <a href="javascript:void(0);" class="text-danger remove-link" onclick="removeGroup(this)">&emsp;&emsp;🗑 Delete</a>
                                      </div>
                                  </div>
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Submit form</button>        
                                </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-2">
                        <thead>
                            <tr>
                                <th>SR. No</th>                               
                                <th>Country</th>
                                <th>City</th>
                                <th>Remove</th>
                                <th>Added Date & Time</th>
                             </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                           @foreach ($getFranchiseLocationDetail as $getFranchiseLocationDetailRow)
                            <tr>
                               <td>{{ $i++ }}</td>
                                <td>{{ $getFranchiseLocationDetailRow->fld_country }}</td>
                                <td>{{ $getFranchiseLocationDetailRow->fld_city }}</td> 
                                <td><a href="{{url('user-admin/franchiseLocationDetailRemove/'.$getFranchiseLocationDetailRow->fld_id."/".$getFranchiseLocationDetailRow->fld_franchise_id)}}">Remove</a></td>
                                <td>{{ date('j F Y h:i:s', strtotime($getFranchiseLocationDetailRow->fld_added_timestamp)) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <script>
           function addGroup() {
      const container = document.getElementById("inputContainer");

      const group = document.createElement("div");
      group.className = "input-group";

      const row = document.createElement("div");
      row.className = "row";

      const fields = [
        { name: "country[]", placeholder: "Enter Country Name", type: "text" },
        { name: "city[]", placeholder: "Enter City Name", type: "text" }
      ];

      fields.forEach(field => {
        const col = document.createElement("div");
        col.className = "col-6 mb-3";

        const input = document.createElement("input");
        input.type = field.type;
        input.name = field.name;
        input.placeholder = field.placeholder;
        input.className = "form-control";
        input.required = true;

        col.appendChild(input);
        row.appendChild(col);
      });

      const deleteLink = document.createElement("a");
      deleteLink.href = "javascript:void(0);";
      deleteLink.className = "text-danger remove-link";
      deleteLink.innerHTML = "&emsp;&emsp;🗑 Delete";
      deleteLink.onclick = function () {
        removeGroup(deleteLink);
      };

      group.appendChild(row);
      group.appendChild(deleteLink);
      container.appendChild(group);
    }

    function removeGroup(link) {
      const container = document.getElementById("inputContainer");
      if (container.children.length > 1) {
        link.parentNode.remove();
      } else {
        alert("At least one set of details is required.");
      }
    }
    </script>
        @endsection
