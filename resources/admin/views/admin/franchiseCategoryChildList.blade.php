@extends('admin.layouts.main')
@section('main-container')
<script type="text/javascript" src="{{ asset('admin/assets/js/jquery-3.3.1.min.js') }}"></script>
    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><span>Franchise Child Category List</span></li>
            </ul>
        </div>

        @if (session('message'))
            @if (session('message') == MSG_ADD_SUCCESS)
                <div class="uk-alert uk-alert-primary" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <p>Data Inserted Successfully!..</p>
                </div>
            @else
                <div class="uk-alert uk-alert-danger" data-uk-alert="">
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <p>Error In Insert!..</p>
                </div>
            @endforelse
        @endif

        @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="md-card">
            <div class="md-card-content">
                <button class="md-btn md-btn-primary" data-uk-modal="{target:'#modalFranchiseListingCategoryChild'}">Add Child
                    Category</button>
                <div class="uk-modal" id="modalFranchiseListingCategoryChild">
                    <div class="uk-modal-dialog">
                        <div class="uk-modal-header">
                            <h3 class="uk-modal-title">Child Category Detail</h3>
                        </div>
                        <form id="form_validation" method="POST" action="{{ url('admin/franchiseCategoryChildStore') }}">
                            @csrf
                            <label for="login_username">Select Main Category <span class="req" style="color: red">*</span></label>
                            <div class="uk-form-row">
                                <select class="md-input" required name="fcc_cat_main_id" id="catmain_id">
                                    <option value="">Select Category</option>
                                    @foreach ($franchiseListingMainData as $franchiseListingMainRow)
                                        <option value="{{ $franchiseListingMainRow->fcm_id }}">
                                            {{ $franchiseListingMainRow->fcm_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="uk-form-row">
                                <label for="f_sub_cat">Sector / Sub Category </label>
                                <select name="fcc_cat_sub_id" class="md-input" id="catsub_id" required>
                                    <option selected="" disabled="" value="">Choose...</option>
                                </select>
                            </div>
                            

                            <div class="uk-form-row">
                                <label for="login_username">Child Category Name <span class="req"
                                        style="color: red">*</span></label>
                                <input class="md-input" type="text" id="fcc_name" required name="fcc_name" />
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
                            <th>Main Category</th>
                            <th>Sub Category</th>
                            <th>Child Category</th>
                            <th>Status</th>
                            <th>Added Date&Time</th>
                            <th>Updated Date&Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($franchiseListingChildData as $franchiseListingChildRow)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $franchiseListingChildRow->fcm_name }}</td>
                                <td>{{ $franchiseListingChildRow->fcs_name }}</td>
                                <td>{{ $franchiseListingChildRow->fcc_name }}</td>
                                <td>
                                    @if($franchiseListingChildRow->fcc_status == STATUS_INACTIVE)
                                        <span class="uk-badge uk-badge-primary">In Active</span>
                                    @else
                                        <span class="uk-badge uk-badge-success">Active</span>
                                    @endforelse
                                </td>
                                <td>
                                    @if(!empty($franchiseListingChildRow->fcc_added_time))
                                        {{ date('j F Y h:i:s', strtotime($franchiseListingChildRow->fcc_added_time)) }}
                                    @endif
                                </td>

                                <td>
                                    @if(!empty($franchiseListingChildRow->fcc_changed_time))
                                        {{ date('j F Y h:i:s', strtotime($franchiseListingChildRow->fcc_changed_time)) }}
                                    @endif
                                </td>

                                <td><a href="{{ url('admin/franchiseCategoryChildEdit/'.$franchiseListingChildRow->fcc_id) }}">Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
     <script>
        jQuery(document).ready(function() {
            jQuery('#catmain_id').change(function() {
                var catmain_id = jQuery(this).val()
                jQuery.ajax({
                    url: "{{ url('user-admin/getFranchiseSubCategory') }}",
                    type: 'POST',
                    data: 'catmain_id=' + catmain_id + '&_token={{ csrf_token() }}',
                    success: function(result) {
                        jQuery('#catsub_id').html(result)
                    }
                });
            });
        });
    </script>
@endsection
