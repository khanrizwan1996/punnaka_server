@extends('admin.layouts.main')
@section('main-container')
        <div id="page_content_inner">
            <div id="top_bar">
                <ul id="breadcrumbs">
                    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                    <li><a href="{{url('admin/pressReleaseAdd')}}">Press Release Add</a></li>
                    <li><span>Press Release Lisitng</span></li>
                </ul>
            </div>
            <h4 class="heading_a uk-margin-bottom">Press Release Listing</h4>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <a href="{{url('admin/pressReleaseAdd')}}" class="md-btn md-btn-primary">Add Press Release</a>
                    <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Main Category</th>
                            <th>Sub Category</th>
                            <th>Title</th>
                            <th>Publisher</th>
                            <th>Author</th>
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
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </tfoot>

                        <tbody>
                            @php $i=1; @endphp
                            @foreach ($PressReleaseArray as $PressReleaseRow)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$PressReleaseRow['pr_main_cat']}}</td>
                            <td>{{$PressReleaseRow['pr_sub_cat']}}</td>
                            <td>{{$PressReleaseRow['pr_title']}}</td>
                            <td>{{$PressReleaseRow['pr_publisher']}}</td>
                            <td>{{$PressReleaseRow['pr_author']}}</td>
                            <td> @if ($PressReleaseRow['pr_status'] == STATUS_INACTIVE)
                                    <span class="uk-badge uk-badge-primary">In Active</span>
                                @else
                                    <span class="uk-badge uk-badge-success">Active</span>
                                @endforelse
                            </td>
                            <td>{{$PressReleaseRow['pr_added_time']}}</td>
                            <td><a href="{{url('admin/pressReleaseEdit/'.$PressReleaseRow['pr_id'])}}">Edit</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
