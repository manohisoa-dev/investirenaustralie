@extends('admin.layouts.app')

@section('title', 'Configuration site')

@section('breadcrumb')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>@lang('app.translation')</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('V2/admin')}}">@lang('app.home')</a>
                </li>
                <li class="breadcrumb-item">
                    <a>@lang('app.config')</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>@lang('app.translation')</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>@lang('app.translation') <small>@lang('app.txt.lang_update')</small></h5>
                </div>
                <div class="ibox-content">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form class="search-form">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <!-- Search form -->
                                                <div class="input-group">
                                                    <input class="form-control py-2 border-right-0 border" type="search" placeholder="@lang('app.txt.search_all_translation')" id="search" name="search">
                                                    <span class="input-group-append">
                                                        <div class="input-group-text bg-transparent"><i class="fa fa-search"></i></div>
                                                    </span>
                                                  </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <select class="form-control" name="lang" id="lang">
                                                    <option value="">{{ strtoupper(app()->getLocale()) }}</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3">
                                                <select class="form-control" name="type" id="type">
                                                    <option value="">VALIDATION</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> @lang('app.btn.add')</button>
                                                {{-- <div style="clear:both"></div> --}}
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="ibox-content">
                            <table class="table table-striped grid-view-tbl">
                                <thead>
                                    <tr class="header-row">
                                        <th>GROUP/SINGLE</th>
                                        <th>KEY</th>
                                        <th>EN</th>
                                        <th>EN</th>
                                    </tr>
                                </thead>
                
                                <tbody>
                                    <tr>
                                        <td>validation</td>
                                        <td>accepted</td>
                                        <td>The :attribute must be accepted.</td>
                                        <td>
                                            <span class="btn_edit">
                                                <a href="javascript:void(0)" title="@lang('app.txt.edit')" class="btn btn-default btn-circle">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                            </span> 
                                            The :attribute must be accepted.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection