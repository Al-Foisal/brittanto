@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Popular Course Area' }} @stop


@section('css')

<style>

  /** The wrapper that will contain our two forms **/
    .content-wrapper {
        border-left: 5px solid white;
        padding: 1.5rem 0.5rem;
        border-radius: 30px;
    }
    .card{
        border-radius: 5px;
    }

    .table td { font-size: 20px; }
    tbody { font-family: 'Ubuntu', sans-serif; }
    /**** Styling the form elements **/
.card .card-title {
    color: #787878;
    margin-bottom: 1.2rem;
    text-transform: uppercase;
    font-size: 0.975rem;
    font-weight: 500;
    font-family: 'Ubuntu', sans-serif;
}
.card-title-resize{
    border-right: 2px solid;
    margin: 0 30px;
    border-radius: 4px;
    padding: 10px;
}
#hint{
    overflow-x: auto;
    white-space: pre-wrap;
    white-space: -moz-pre-wrap;
    white-space: -pre-wrap;
    white-space: -o-pre-wrap;
    word-wrap: break-word;
}
</style>

@stop
@section('foisal')

<ul style="width: 15%;padding-left: 0;list-style: none;">
    <li class="nav-item">
        <a class="nav-link btn btn-secondary" href="{{ route('popular-courses.create') }}">
            <i class="material-icons">add</i>
            <span class="menu-title">Add Courses</span>
        </a>
    </li>
</ul>


@foreach($courses as $course)
    <div class="row">
        <ul>
            <div style="width: 50%;float: left;margin-right: 10%;">
                <h3>Popular Course Details</h3>
                <li>Title: {{ $course->course_title}}</li>
                <li><img src="{{ asset('storage/storage/'.$course->inst_identity.'/course/'.$course->course_banar)}}" alt="{{ $course->course_title}}" height="200" width="400"></li>
                <li>Label: {{ $course->course_label}}</li>
                <li>Seats: {{ $course->total_seat}}</li>
                <li>Duration: {{ $course->course_duration}}</li>
                <li>Fees: {{ $course->course_fee}}</li>
            </div>

            <div style="width: 40%;float: left;">
                @php
                $course_categories = \App\Models\Coaching\Fornt\CoachingForntPopularCourseFeature::where('course_id',$course->id)->get();   
                @endphp

                <h3>Category List and Value</h3>

                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>Title Name</th>
                            <th>Value</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($course_categories as $course_category)
                        <tr>
                            <td>{{$course_category->course_category_title}}</td>
                            <td>{{ $course_category->course_category_value }}</td>
                            <td>
                                <form action="{{ route('delete.course.category',$course_category) }}" method="post">
                                    @method('GET')
                                    @csrf
                                    <button title="delete" onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-danger btn-xs">X</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </ul>
            <ul>
            <li><pre id="hint">
                {{ $course->course_description}}
            </pre></li>
            <hr>
            <li>
                <a href="{{ route('popular-courses.edit',$course) }}" class="btn btn-primary">EDIT</a>
                <a href="{{ route('create.course.category',$course) }}" class="btn btn-primary">Add Category</a>
                <form action="{{ route('popular-courses.destroy',$course) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </li>
        </ul>
    </div>
    <hr>
@endforeach


@stop