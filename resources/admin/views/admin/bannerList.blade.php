@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><span>Banner List</span></li>
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
                <button class="md-btn md-btn-primary" data-uk-modal="{target:'#modalBanner'}">Add New Banner</button>
                <div class="uk-modal" id="modalBanner">
                    <div class="uk-modal-dialog">
                        <div class="uk-modal-header">
                            <h3 class="uk-modal-title">Banner Detail</h3>
                        </div>
                        <form id="form_validation" method="POST" action="{{url('admin/bannerStore')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2">
                                    <div class="parsley-row">
                                        <label for="blog_detail">Title</label>
                                        <input type="text" name="banner_title" class="md-input" />
                                    </div>
                                </div>
                                <div class="uk-width-medium-1-2">
                                    <label for="banner_image">Image<span class="req" style="color: red">*</span></label>
                                    <div class="parsley-row">
                                        <input type="file" name="banner_image"
                                            onchange='single_attachment(this,{{ JPG_PNG_FORMATES }},{{ IMAGE_SIZE }})'
                                            required class="md-btn md-btn-primary md-input" />
                                    </div>
                                </div>
                            </div>
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-1">
                                    <div class="parsley-row">
                                        <label for="blog_detail">Short Description</label>
                                        <input type="text" name="banner_short_desc" class="md-input" />
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
                            <th>Image</th>
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
                        </tr>
                    </tfoot>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($bannerData as $bannerRow)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    @if ($bannerRow['banner_status'] == STATUS_INACTIVE)
                                        <span class="uk-badge uk-badge-primary">In Active</span>
                                    @else
                                        <span class="uk-badge uk-badge-success">Active</span>
                                    @endforelse
                                </td>
                                <td>
                                    <a href="{{ url('custom-images/banner/' . $bannerRow['banner_image']) }}" target="_blank">
                                        <span class="fa fa-eye">View Image</span>
                                        {{-- <img src="{{ url('custom-images/banner/' . $bannerRow['banner_image']) }}"
                                            alt="" style="height: 50px; width:50px" /> --}}
                                    </a>
                                </td>
                                <td>
                                    @if (!empty($bannerRow['banner_added_time']))
                                        {{ date('j F Y h:i:s', strtotime($bannerRow['banner_added_time'])) }}
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($bannerRow['banner_changed_time']))
                                        {{ date('j F Y h:i:s', strtotime($bannerRow['banner_changed_time'])) }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/bannerEdit/' . $bannerRow['banner_id']) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
