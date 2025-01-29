@extends('backend.layouts.app')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('assets/css/select.css') }}" rel="stylesheet" />
@push('css')
@endpush
@section('content')
<section class="filters">
    <div class="main">
        <div class="main-container">
            <div id="main" class="my-4">
                <div class="my-3 ms-3">
                    <breadcrumb>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a role="button">Pre Cas Application</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span>Add</span>
                            </li>
                        </ul>
                    </breadcrumb>
                </div>
                <div class="user">
                    <div class="container">
                        <div class="user-header">
                            <h4 class="user-role py-3">Add Pre Cas Application</h4>
                            <a href="{{ route('precas.index') }}" class="close-btn">x</a>
                        </div>
                        <div class="search-user">
                            <div class="form-container">
                                <div class="my-3">
                                    <span class="star-color">*</span><span class="label"> <i>Indicates required field</i></span>
                                </div>
                                <form method="POST" action="{{ route('precas.insert') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row mt-3">
                                        <div class="form-group col-md-4">
                                            <label class="label" for="passport">Course Applied For:<span class="star-color">*</span></label>
                                            <select name="course_id[]" id="course-select" class="js-select2 form-control">
                                            <option selected disabled>--select one--</option>
                                                @foreach ($courses as $item)
                                                <option value="{{ $item->id }}" data-badge>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row ">
                                        <div class="form-group col-md-4 me-2">
                                            <label class="label">Does the patient require a Pre Cas compliance interview:<span class="star-color">*</span></label>
                                            <div class="radio-btn">
                                                <input type="radio" id="yes" name="check" value="yes" onclick="toggleFields(true)">
                                                <label class="label" for="yes">Yes</label>
                                                <input type="radio" id="no" name="check" value="no" onclick="toggleFields(false)">
                                                <label class="label" for="no">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row ">

                                        <div class="form-group">
                                            <label class="label" for="date_of_interview">Date Of Interview<span class="star-color">*</span></label>
                                            <input type="date" name="date_of_interview" class="form-control" id="date_of_interview">
                                        </div>

                                        <div class="form-group">
                                            <label class="label" for="middleName">Name Of Interviewer:<span class="star-color">*</span></label>
                                            <input type="text" name="name_of_interviewer" class="form-control" id="name_of_interviewer">
                                        </div>
                                        <div class="form-group">
                                        </div>

                                    </div>
                                    <div class="my-2">
                                        <h4 class="address">
                                            Interview Notes
                                        </h4>
                                    </div>
                                    <div class="form-row">
                                        <textarea class="form-control" name="note" id="note" rows="3"></textarea>
                                    </div>

                                    <div class="form-row me-3">
                                        <div class="form-group col-md-4 me-2">
                                            <label class="label">Interview:<span class="star-color">*</span></label>
                                            <div class="radio-btn">
                                                <input type="radio" id="yes_option" name="check" value="pass">
                                                <label class="label" for="pass">Pass</label>
                                                <input type="radio" id="no_option" name="check" value="fail">
                                                <label class="label" for="fail">Fail</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <div class="form-group">
                                            <label class="label" for="date_of_referral">Date Of Referrel<span class="star-color">*</span></label>
                                            <input type="date" name="date_of_referral" class="form-control" id="date_of_referral">
                                        </div>
                                        <div class="form-group">
                                        </div>
                                        <div class="form-group">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-group col-md-4 me-2">
                                            <label class="label">Has The Patient Been Notified:<span class="star-color">*</span></label>
                                            <div class="radio-btn" id="radioBtn">
                                                <input type="radio" id="notified_yes" name="student_notified" value="yes">
                                                <label class="label" for="notified_yes">Yes</label>
                                                <input type="radio" id="notified_no" name="student_notified" value="no">
                                                <label class="label" for="notified_no">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    </div>
                            </div>
                        </div>


                        <!-- Upload documents -->
                        <div class="container-fluid mt-5" style="--bs-gutter-x: 0rem !important;">
                            <div class="panel">
                                <strong class="sub-title">Documents to be submitted: </strong>
                                <div class="collapse-div mb-3">
                                    <div class="row extra-padding">

                                        <div class="col-md-12 mt-1">
                                            <label for="file1" class="pe-1 file-docs label">Interview Questions:</label>
                                            <input type="file" id="file1" name="interview_questions[]" accept="application/pdf, image/png, image/jpeg, image/jpg, image/webp" class="file file_style form-control"
                                                onchange="displayFileNames(this)" data-file-name="file-name1" multiple>
                                            <label for="file1" class="custom-file-upload">
                                                <i aria-hidden="true" class="fa fa-upload"></i> Upload Files
                                            </label>
                                            <span id="file-name1" class="ms-2 label file-names-display" style="word-break: break-all;">No Files Chosen.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @php
                        $userRole = auth()->user()->role_id;
                        @endphp

                        <!-- Upload documents -->
                        <div class="container-fluid mt-5" style="--bs-gutter-x: 0rem !important;">
                            <div class="panel">
                                <strong class="sub-title" style="color:red">For compliance purposes only: </strong>

                                <div class="collapse-div mb-3">
                                    <div class="row extra-padding">

                                        <div class="form-row mt-3">

                                            <div class="form-group">
                                                <label class="label" for="date_of_interview">Date Of Interview 2<span class="star-color">*</span></label>
                                                <input type="date" name="date_of_interview2" class="form-control" id="date_of_interview">
                                            </div>

                                            <div class="form-group">
                                                <label class="label" for="middleName">Name Of Interviewer 2:<span class="star-color">*</span></label>
                                                @if($userRole == 1)
                                                <input type="text" name="name_of_interviewer2" class="form-control" id="name_of_interviewer">
                                                @else
                                                <input type="text" name="name_of_interviewer2" class="form-control" id="name_of_interviewer" disabled>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                            </div>

                                        </div>
                                        <div class="my-2">
                                            <h4 class="address">
                                                Interview Notes:
                                            </h4>
                                        </div>
                                        <div class="form-row">
                                            @if($userRole == 1)
                                            <textarea class="form-control" name="note2" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            @else
                                            <textarea class="form-control" name="note2" id="exampleFormControlTextarea1" rows="3" disabled></textarea>
                                            @endif
                                        </div>

                                        <div class="my-2">
                                            <h4 class="address">
                                                Outcome:
                                            </h4>
                                        </div>
                                        <div class="form-row">
                                            @if($userRole == 1)

                                            <textarea class="form-control" name="outcome" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            @else
                                            <textarea class="form-control" name="outcome" id="exampleFormControlTextarea1" rows="3" disabled></textarea>
                                            @endif

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-buttons my-4">
                            <button type="submit" class="btn filter-btn">Submit</button>
                            <a href="{{ route('precas.index') }}" type="submit" class="btn btn-cancel">Cancel</a>

                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="footer">
    </div>
</section>

<script>
    function displayFileNames(input) {
        const fileNameId = input.getAttribute('data-file-name');
        const fileNameSpan = document.getElementById(fileNameId);
        if (input.files && input.files.length > 0) {
            const fileNames = Array.from(input.files).map(file => file.name).join(' || ');
            fileNameSpan.textContent = fileNames;
        } else {
            fileNameSpan.textContent = 'No Files Chosen.';
        }
    }
</script>

<script>
    (function($) {
        $(function() {

            //  open and close nav
            $('#navbar-toggle').click(function() {
                $('nav ul').slideToggle();
            });

            $('#navbar-toggle').on('click', function() {
                this.classList.toggle('active');
            });

            $('nav ul li a:not(:only-child)').click(function(e) {
                $(this).siblings('.navbar-dropdown').slideToggle("slow");

                $('.navbar-dropdown').not($(this).siblings()).hide("slow");
                e.stopPropagation();
            });

            $('html').click(function() {
                $('.navbar-dropdown').hide();
            });
        });
    })(jQuery);
</script>


<script>
    // Function to toggle the fields
    function toggleFields(isEnabled) {
        document.getElementById('date_of_interview').disabled = !isEnabled;
        document.getElementById('name_of_interviewer').disabled = !isEnabled;
        document.getElementById('note').disabled = !isEnabled;
    }

    // Disable the fields on page load
    document.addEventListener('DOMContentLoaded', function() {
        toggleFields(false); // Set false to disable the fields
    });
</script>


<script>
    $(document).ready(function() {

        $('#notified_yes').prop('disabled', true);
        $('#notified_no').prop('disabled', true);
        $('#date_of_referral').prop('disabled', true);

        $('#yes_option').on('change', function() {
            if ($(this).is(':checked')) {
                $('#notified_yes').prop('disabled', false);
                $('#notified_no').prop('disabled', false);
                $('#date_of_referral').prop('disabled', false);

            }
        });

        $('#no_option').on('change', function() {
            if ($(this).is(':checked')) {
                $('#notified_yes').prop('disabled', true);
                $('#notified_no').prop('disabled', true);
                $('#date_of_referral').prop('disabled', true);

            }
        });
    });
</script>


@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

@endpush
@endsection
