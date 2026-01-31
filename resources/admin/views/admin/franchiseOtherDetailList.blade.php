@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">

        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('admin/franchiseList') }}">Franchise List</a></li>
                <li><span>Franchise Other Details (<lable style="color: red">{{ $franchiseData->f_name }}</lable>)</span></li>
            </ul>
        </div>
        <div class="md-card">
            <div class="md-card-content">
                <form id="form_validation" method="POST" action="{{ url(ADMIN_URL . 'franchiseImageStore') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="fi_franchise_id" value="{{ Route::input('id') }}">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                             <label class="form-label">Upload Franchisee Outlet Images <span class="req" style="color: red">*</span></label>
                            <div class="parsley-row">
                                <input type="file" name="franchise_images[]" multiple required
                                    class="md-btn md-btn-primary md-input" />
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="parsley-row">
                                <br>
                                <button type="submit" style="margin: 3px;"
                                    class="md-btn md-btn-flat md-btn md-btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="md-card">
            <div class="md-card-content">
                <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>SR. No</th>
                            <th>Image</th>
                            <th>Remove</th>
                            <th>Added Date & Time</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($getFranchiseImageData as $getFranchiseImageRow)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td><a href="{{ url('custom-images/franchise-images/' . $getFranchiseImageRow->fi_path) }}"
                                        target="_blank"
                                        style="color: #87ceec; font-weight:bolder; text-decoration:underline">
                                        {{ $getFranchiseImageRow->fi_path }}</a></td>
                                <td><a
                                        href="{{ url('admin/franchiseImageRemove/' . $getFranchiseImageRow->fi_id . '/' . $getFranchiseImageRow->fi_franchise_id . '/' . $getFranchiseImageRow->fi_path) }}">Remove</a>
                                </td>
                                <td>{{ date('j F Y h:i:s', strtotime($getFranchiseImageRow->fi_added_time)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="md-card">
            <div class="md-card-content">
                <form id="form_validation" method="POST" action="{{ url(ADMIN_URL.'franchiseLocationDetailStore') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="fld_franchise_id" value="{{Route::input('id')}}">
                    <div class="uk-grid" data-uk-grid-margin>
                        
                           <label>Preferred Countries & Cities <span class="req"style="color: red">*</span></label>
                             <br>
                                <button type="button" class="md-input" onclick="addGroup()">Add More</button>
                                 
                                  <div id="inputContainer">
                                      <br>
                                      <div class="input-group">
                                           <div class="uk-grid" data-uk-grid-margin>
                                              <div class="uk-width-medium-1-3">
                                                  <input type="text" name="country[]" class="md-input required" placeholder="Enter Country Name">
                                              </div>
                                              <div class="uk-width-medium-1-3">
                                                  <input type="text" name="city[]" class="md-input required" placeholder="Enter City Name">
                                              </div>
                                              <div class="uk-width-medium-1-3">
                                              <a href="javascript:void(0);" class="text-danger remove-link" onclick="removeGroup(this)">&emsp;&emsp;🗑 Delete</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                     
                        <div class="uk-width-medium-1-1">
                            <div class="parsley-row">
                                <br>
                                <button type="submit" style="margin: 3px;"class="md-btn md-btn-flat md-btn md-btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="md-card">
            <div class="md-card-content">
                <table class="uk-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                                <th>SR. No</th>                               
                                <th>Country</th>
                                <th>City</th>
                                <th>Remove</th>
                                <th>Added Date & Time</th>
                             </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($getFranchiseLocationDetail as $getFranchiseLocationDetailRow)
                           <tr>
                               <td>{{ $i++ }}</td>
                                <td>{{ $getFranchiseLocationDetailRow->fld_country }}</td>
                                <td>{{ $getFranchiseLocationDetailRow->fld_city }}</td> 
                                <td><a href="{{url('admin/franchiseLocationDetailRemove/'.$getFranchiseLocationDetailRow->fld_id."/".$getFranchiseLocationDetailRow->fld_franchise_id)}}">Remove</a></td>
                                <td>{{ date('j F Y h:i:s', strtotime($getFranchiseLocationDetailRow->fld_added_timestamp)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
     <script>
           function addGroup() {
      const container = document.getElementById("inputContainer");

      const group = document.createElement("div");
      group.className = "input-group";

      const row = document.createElement("div");
      row.className = "uk-grid";

      const fields = [
        { name: "country[]", placeholder: "Enter Country Name", type: "text" },
        { name: "city[]", placeholder: "Enter City Name", type: "text" }
      ];

      fields.forEach(field => {
        const col = document.createElement("div");
        col.className = "uk-width-medium-1-3";

        const input = document.createElement("input");
        input.type = field.type;
        input.name = field.name;
        input.placeholder = field.placeholder;
        input.className = "md-input";
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
