@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">

        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><span>Image List</span></li>
            </ul>
        </div>
        <div class="md-card">
            <div class="md-card-content">
                <button class="md-btn md-btn-primary" data-uk-modal="{target:'#modalImage'}">Add New Image</button>
                <div class="uk-modal" id="modalImage">
                    <div class="uk-modal-dialog">
                        <div class="uk-modal-header">
                            <h3 class="uk-modal-title">Images</h3>
                        </div>
                        <form id="form_validation" method="POST" action="{{ url('admin/storeImages') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2">
                                    <label for="banner_image">Image<span class="req" style="color: red">*</span></label>
                                    <div class="parsley-row">
                                        <input type="file" name="images[]" multiple
                                            onchange='multiple_attachment(this,{{ JPG_PNG_FORMATES }},{{ IMAGE_SIZE }})'
                                            required class="md-btn md-btn-primary md-input" />
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
                            <th>Image</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach ($years as $year)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    <a href="{{ url('admin/imageFolderByYear', $year['year']) }}">
                                        📁 {{ $year['year'] }}
                                    </a>
                                </td>
                                <td>{{ $year['count'] }} images </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
