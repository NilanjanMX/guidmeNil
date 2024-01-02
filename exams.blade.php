@extends('site.layout.guideme')
@section('title') Follow Our Guidelines for Exam Success @stop
@section('description') Receive comprehensive exam guidance here! From preparation tips to important details, we provide you with the support you need for a successful academic journey. @stop
@section('content')
<section class="main_body">
    <div class="brdcrumb_area">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item home"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item">Exams</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="past_event_wrapper exam_content_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(count($exams))
                        @foreach ($exams as $k=>$exam)
                            <div class="col-md-6">
                                <div class="box box_upcomming_event">
                                    <div class="right">
                                        <div class="txt">
                                            <div class="content">
                                                <h3>{{ $exam->name }}</h3>
                                                <!-- <p style="border-bottom: none;">{!! str_limit($exam->description, 80) !!}</p> -->
                                                <p>{{$exam->short_name}}</p>
                                                <p><span>Application Date: </span>{{$exam->application_date}}</p>
                                                <p><span>Exam Date: </span>{{$exam->exam_date}}</p>
                                                <p>{!! str_limit($exam->short_description, 70) !!}</p>
                                                <a href="{{ url('exams/'.$exam->slug) }}" class="btn btn-primary">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else 
                        <h4>No record found!</h4>    
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection