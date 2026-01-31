@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><span>News Letter List</span></li>
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
                <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Email</th>
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
                        </tr>
                    </tfoot>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($newsLetterData as $newsLetterRow)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $newsLetterRow['nl_email']}}</td>
                                <td>
                                    @if (!empty($newsLetterRow['nl_added_time']))
                                        {{ date('j F Y h:i:s', strtotime($newsLetterRow['nl_added_time'])) }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/newsLetterDelete/' . $newsLetterRow['nl_id']) }}">Remove</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
