@extends('backEnd.master')
@section('title') 
@lang('homework.home_work_list')
@endsection
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('homework.home_work_list')</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">@lang('common.dashboard')</a>
                    <a href="#">@lang('homework.home_work')</a>
                    <a href="#">@lang('homework.home_work_list')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">

        <div class="row mt-40">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">@lang('homework.home_work_list')</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                            <thead>


                            <tr>
                                <th>@lang('common.class')</th>
                                <th>@lang('common.section')</th>
                                <th>@lang('homework.subject')</th>
                                <th>@lang('exam.marks')</th>
                                <th>@lang('homework.home_work_date')</th>
                                <th>@lang('homework.submission_date')</th>
                                <th>@lang('homework.evaluation_date')</th>
                                <th>@lang('homework.obtained_marks')</th>
                                <th>@lang('common.status')</th>
                                <th>@lang('common.action')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($homeworkLists as $value)
                                @php
                                    $student_result = $student_detail->homeworks->where('homework_id',$value->id)->first();
                                @endphp

                                <tr>
                                    <td>{{$value->classes  !=""?$value->classes->class_name:""}}</td>
                                    <td>{{$value->sections !=""?$value->sections->section_name:""}}</td>
                                    <td>{{$value->subjects !=""?$value->subjects->subject_name:""}}</td>
                                    <td>{{$value->marks}}</td>
                                    <td data-sort="{{strtotime($value->homework_date)}}">
                                        {{$value->homework_date != ""? dateConvert($value->homework_date):''}}
                                    </td>
                                    <td data-sort="{{strtotime($value->submission_date)}}">{{$value->submission_date != ""? dateConvert($value->submission_date):''}}</td>
                                    <td data-sort="{{strtotime($value->evaluation_date)}}">
                                        @if(!empty($value->evaluation_date))
                                            {{$value->evaluation_date != ""? dateConvert($value->evaluation_date):''}}

                                        @endif
                                    </td>


                                    <td>{{$student_result != ""? $student_result->marks:''}}</td>
                                    <td>
                                        @if($student_result != "")

                                            @if($student_result->complete_status == "C")
                                                <button class="primary-btn small bg-success text-white border-0">@lang('homework.completed')</button>
                                            @else
                                                <button class="primary-btn small bg-warning text-white border-0">@lang('homework.incompleted')</button>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('common.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                @if(userPermission(74))
                                                    <a class="dropdown-item modalLink" title="Homework View"
                                                       data-modal-size="modal-lg"
                                                       href="{{route('parent_homework_view', [$value->class_id, $value->section_id, $value->id])}}">@lang('common.view')</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection