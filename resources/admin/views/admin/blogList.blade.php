@extends('admin.layouts.main')
@section('main-container')
        <div id="page_content_inner">
            <div id="top_bar">
                <ul id="breadcrumbs">
                    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                    <li><a href="{{url('admin/blogAdd')}}">Shopping Blog Add</a></li>
                    <li><span>Shopping Blogs Lisitng</span></li>
                </ul>
            </div>
            <h4 class="heading_a uk-margin-bottom">Shopping Blogs Listing</h4>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <a href="{{url('admin/blogAdd')}}" class="md-btn md-btn-primary">Add Shopping Blog</a>
                    <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Added Date & Time</th>
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
                        </tr>
                        </tfoot>

                        <tbody>
                            @php $i=1; @endphp
                            @foreach ($BlogAllData as $blogRow)
                             @php
                                $newBlogTitle = str_replace(' ', '-', $blogRow['blog_title']);
                            @endphp
                        <tr>
                            <td>{{$i++}}</td>
                            <td><a href="{{ url('detail-blog/' . $newBlogTitle) }}" target="_blank">{{$blogRow['blog_title']}}</a></td>
                            <td> @if ($blogRow['blog_status'] == STATUS_INACTIVE)
                                    <span class="uk-badge uk-badge-primary">In Active</span>
                                @else
                                    <span class="uk-badge uk-badge-success">Active</span>
                                @endforelse
                            </td>
                            <td>{{$blogRow['created_at']}}</td>
                            <td><a href="{{url('admin/blogEdit/'.$blogRow['blog_id'])}}">Edit</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
