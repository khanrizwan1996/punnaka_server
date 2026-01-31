@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">

        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><span>Blog Main Category List</span></li>
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
                <button class="md-btn md-btn-primary" data-uk-modal="{target:'#modalBlogCategoryMain'}">Add Main
                    Category</button>
                <div class="uk-modal" id="modalBlogCategoryMain">
                    <div class="uk-modal-dialog">
                        <div class="uk-modal-header">
                            <h3 class="uk-modal-title">Main Category Detail</h3>
                        </div>
                        <form id="form_validation" method="POST" action="{{ url('admin/blogMainCategoryStore') }}">
                            @csrf
                            <div class="uk-form-row">
                                <label for="login_username">Main Category Name <span class="req"
                                        style="color: red">*</span></label>
                                <input class="md-input" type="text" id="cat_main_name" required name="cat_main_name" />
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
                            <th>Main Category Name</th>
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
                        </tr>
                    </tfoot>

                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($blogCategoryMainData as $blogCategoryMainRow)
                            @php $modalBlogCategoryMain = 'modalBlogCategoryMain'.$blogCategoryMainRow['cat_main_id']; @endphp
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $blogCategoryMainRow['cat_main_name'] }}</td>
                                <td>
                                    @if ($blogCategoryMainRow['cat_main_status'] == STATUS_INACTIVE)
                                        <span class="uk-badge uk-badge-primary">In Active</span>
                                    @else
                                        <span class="uk-badge uk-badge-success">Active</span>
                                    @endforelse
                                </td>
                                <td>
                                    @if (!empty($blogCategoryMainRow['cat_main_added_time']))
                                        {{ date('j F Y h:i:s', strtotime($blogCategoryMainRow['cat_main_added_time'])) }}
                                    @endif
                                </td>

                                <td>
                                    @if (!empty($blogCategoryMainRow['cat_main_changed_time']))
                                        {{ date('j F Y h:i:s', strtotime($blogCategoryMainRow['cat_main_changed_time'])) }}
                                    @endif
                                </td>

                                <td><a
                                        href="{{ url('admin/blogCategoryMainEdit/' . $blogCategoryMainRow['cat_main_id']) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
