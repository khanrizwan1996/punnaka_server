@extends('admin.layouts.main')
@section('main-container')
    <div id="page_content_inner">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <style>
        .toast-custom {
            background-color: #43a047 !important;
        }
    </style>
        <div id="top_bar">
            <ul id="breadcrumbs">
                <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('admin/imageFolder') }}">Image Folder</a></li>
                <li><span>Image Folder / {{ $year }}</span></li>
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
                            <th>Image Name</th>
                            <th>Copy Path</th>
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
                        @foreach ($images as $image)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    <a target="_blank" href="{{ $image }}">
                                        <img src="{{ $image }}" style="width: 90px;height: 50px;"/>
                                    </a>
                                </td>
                                <td>{{ basename($image) }}</td>
                                <td>
                                    <div class="card-content center-align">
                                        <button class="btn blue waves-effect waves-light"
                                            onclick="copyToClipboard('{{ $image }}')">
                                            Copy URL
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <div id="toast-container" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;"></div>
@endsection
