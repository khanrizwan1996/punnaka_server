@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">

        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><span>Blog List</span></li>
            </ul>
        </div>
        <div class="md-card">
            <div class="md-card-content">
                <a href="{{ url('admin/blogCategoryAdd') }}" class="md-btn md-btn-primary">Add Category Blog</a>
                <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Status</th>
                            <th>Main Category</th>
                            <th>Sub Category</th>
                            <th>Title</th>
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
                        @foreach ($blogCategoryListData as $blogCategoryListRow)
                          @php
                            $newBlogCatTitle = str_replace(' ', '-', $blogCategoryListRow['blog_cat_title']);
                            $newBlogCatSub = str_replace(' ', '-', $blogCategoryListRow['blog_cat_subcat']);
                        @endphp
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    @if ($blogCategoryListRow['blog_cat_status'] == STATUS_INACTIVE)
                                        <span class="uk-badge uk-badge-primary">In Active</span>
                                    @else
                                        <span class="uk-badge uk-badge-success">Active</span>
                                    @endforelse
                                </td>
                                <td>{{ $blogCategoryListRow['blog_cat_maincat'] }}</td>
                                <td>{{ $blogCategoryListRow['blog_cat_subcat'] }}</td>
                                <td><a href="{{url('blog-info/'.$newBlogCatSub.'/'.$newBlogCatTitle)}}" target="_blank">{{ $blogCategoryListRow['blog_cat_title'] }}</a></td>
                                <td>
                                    @if (!empty($blogCategoryListRow['blog_cat_added_time']))
                                        {{ date('j F Y h:i:s', strtotime($blogCategoryListRow['blog_cat_added_time'])) }}
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($blogCategoryListRow['blog_cat_changed_time']))
                                        {{ date('j F Y h:i:s', strtotime($blogCategoryListRow['blog_cat_changed_time'])) }}
                                    @endif
                                </td>

                                <td><a
                                        href="{{ url('admin/blogCategoryEdit/' . $blogCategoryListRow['blog_cat_id']) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
