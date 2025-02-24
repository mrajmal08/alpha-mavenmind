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
                                <a role="button">Post Cas Application</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span>Update</span>
                            </li>
                        </ul>
                    </breadcrumb>
                </div>
                <div class="user">
                    <div class="container">
                        <div class="user-header">
                            <h4 class="user-role py-3">Update Post Cas Application</h4>
                            <a href="{{ route('postcas.index') }}" class="close-btn">x</a>
                        </div>
                        <div class="search-user">
                            <div class="form-container">
                                <div class="my-3">
                                    <span class="star-color">*</span><span class="label"> <i>Indicates required field</i></span>
                                </div>
                                <form method="POST" action="{{ route('postcas.update', [$postCas->id]) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row ">

                                        <div class="form-group">
                                            <label class="label" for="cas_no">Cas Number<span class="star-color">*</span></label>
                                            <input type="text" name="cas_no" class="form-control" value="{{ $postCas->cas_no }}" id="cas_no">
                                        </div>

                                        <div class="form-group">
                                            <label class="label" for="middleName">Cas Obsolete Visa Granted Date:<span class="star-color">*</span></label>
                                            <input type="date" name="cas_date" class="form-control" value="{{ $postCas->cas_date }}" id="cas_date">
                                        </div>
                                        <div class="form-group">
                                        </div>

                                    </div>

                                    <!-- Upload documents -->
                                    <div class="container-fluid mt-3" style="--bs-gutter-x: 0rem !important;">
                                        <div class="panel">
                                            <strong class="sub-title">Vignette Documents</strong>
                                            <div class="collapse-div mb-3">
                                                <div class="row extra-padding">
                                                    <div class="col-md-12 mt-1">
                                                        <label for="file1" class="pe-1 file-docs label">Vignette Once Visa Granted:</label>
                                                        <input type="file" id="file1" name="vignette_doc[]" accept="application/pdf, image/png, image/jpeg, image/jpg, image/webp" class="file file_style form-control"
                                                            onchange="displayFileNames(this)" data-file-name="file-name1" multiple>
                                                        <label for="file1" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload Files
                                                        </label>
                                                        <span id="file-name1" class="ms-2 label file-names-display" style="word-break: break-all;">No Files Chosen.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse-div mb-3">
                                                <div class="row extra-padding">
                                                    <div class="col-md-12 mt-1">
                                                        <label for="file2" class="pe-1 file-docs label">Copy Of Vignette Stamped (Date Of Entry):</label>
                                                        <input type="file" id="file2" name="vignette_stamp_doc[]" accept="application/pdf, image/png, image/jpeg, image/jpg, image/webp" class="file file_style form-control"
                                                            onchange="displayFileNames(this)" data-file-name="file-name2" multiple>
                                                        <label for="file2" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload Files
                                                        </label>
                                                        <span id="file-name2" class="ms-2 label file-names-display" style="word-break: break-all;">No Files Chosen.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row mt-3">
                                        <div class="form-group col-md-4">
                                            <label class="label">Did The Patient Enter After The Start Date Of The Vignette:<span class="star-color">*</span></label>
                                            <div class="radio-btn">
                                                <input type="radio" id="yes" name="after_vignette" value="yes" {{ $postCas->after_vignette == "yes" ? 'checked' : '' }}>
                                                <label class="label" for="yes">Yes</label>
                                                <input type="radio" id="no" name="after_vignette" value="no" {{ $postCas->after_vignette === "no" ? 'selected' : '' }}>
                                                <label class="label" for="no">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row mt-3">
                                        <div class="form-group col-md-6">
                                            <label class="label">Did The Patient Enter Before The Start Date Of The Vignette:<span class="star-color">*</span></label>
                                            <div class="radio-btn">
                                                <input type="radio" id="before_vignette_yes" name="before_vignette" value="yes" {{ $postCas->before_vignette == "yes" ? 'checked' : '' }}>
                                                <label class="label" for="yes">Yes ( <span style="color: red;">Refer case to head of Compliance</span> )</label>
                                                <input type="radio" id="before_vignette_no" name="before_vignette" value="no" {{ $postCas->before_vignette == "no" ? 'checked' : '' }}>
                                                <label class="label" for="no">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row mt-4">
                                        <div class="form-group ">
                                            <label class="label">Has The Patient Been Notified:<span class="star-color">*</span></label>
                                            <div class="radio-btn">
                                                <input type="radio" id="student_notified_yes" name="student_notified" value="yes" {{ $postCas->student_notified == "yes" ? 'checked' : '' }}>
                                                <label class="label" for="yes">Yes</label>
                                                <input type="radio" id="student_notified_no" name="student_notified" value="no" {{ $postCas->student_notified == "no" ? 'checked' : '' }}>
                                                <label class="label" for="no">No</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="date_of_entry">Date Of Entry<span class="star-color">*</span></label>
                                            <input type="date" name="date_of_entry" class="form-control" value="{{ $postCas->date_of_entry }}" id="date_of_entry">
                                        </div>
                                        <div class="form-group">
                                        </div>
                                    </div>

                                    <!-- Upload documents -->
                                    <div class="container-fluid mt-3" style="--bs-gutter-x: 0rem !important;">
                                        <div class="panel">
                                            <strong class="sub-title">E-Ticket Documents</strong>
                                            <div class="form-row mt-3">
                                                <div class="form-group col-md-4">
                                                    <label class="label">Did The Patient Enter Via E-Gates:<span class="star-color">*</span></label>
                                                    <div class="radio-btn">
                                                        <input type="radio" id="yes" name="is_egates" value="yes" {{ $postCas->is_egates == "yes" ? 'checked' : '' }}>
                                                        <label class="label" for="yes">Yes</label>
                                                        <input type="radio" id="no" name="is_egates" value="no" {{ $postCas->is_egates == "no" ? 'checked' : '' }}>
                                                        <label class="label" for="no">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse-div mb-3">
                                                <div class="row extra-padding">
                                                    <div class="col-md-12 mt-1">
                                                        <label for="file3" class="pe-1 file-docs label">E-Ticket:</label>
                                                        <input type="file" id="file3" name="e_ticket[]" accept="application/pdf, image/png, image/jpeg, image/jpg, image/webp" class="file file_style form-control"
                                                            onchange="displayFileNames(this)" data-file-name="file-name3" multiple>
                                                        <label for="file3" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload Files
                                                        </label>
                                                        <span id="file-name3" class="ms-2 label file-names-display" style="word-break: break-all;">No Files Chosen.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row mt-3">
                                        <div class="form-group">
                                            <label class="label" for="brp_received">BRP Received<span class="star-color">*</span></label>
                                            <input type="text" name="brp_received" class="form-control" value="{{ $postCas->brp_received }}" id="brp_received">
                                        </div>

                                        <div class="form-group me-2">
                                            <label class="label">Corrections Identified:<span class="star-color">*</span></label>
                                            <div class="radio-btn">
                                                <input type="radio" id="yes" name="correct_identified" value="yes" {{ $postCas->correct_identified == "yes" ? 'checked' : '' }}>
                                                <label class="label" for="yes">Pass</label>
                                                <input type="radio" id="no" name="correct_identified" value="no" {{ $postCas->correct_identified == "no" ? 'checked' : '' }}>
                                                <label class="label" for="no">Fail</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="brp_error">BRP Error<span class="star-color">*</span></label>
                                            <input type="text" name="brp_error" class="form-control" value="{{ $postCas->brp_error }}" id="brp_error">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="label" for="reporting_date">Date Of Home Office Reporting<span class="star-color">*</span></label>
                                            <input type="date" name="reporting_date" class="form-control" value="{{ $postCas->reporting_date }}" id="reporting_date">
                                        </div>
                                        <div class="form-group">
                                        </div>
                                        <div class="form-group">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="label" for="brp_start_date">BRP Start Date<span class="star-color">*</span></label>
                                            <input type="date" name="brp_start_date" value="{{ $postCas->brp_start_date }}" class="form-control" id="brp_start_date">
                                        </div>
                                        <div class="form-group">
                                            <label class="label" for="brp_end_date">BRP End Date<span class="star-color">*</span></label>
                                            <input type="date" name="brp_end_date" value="{{ $postCas->brp_end_date }}" class="form-control" id="brp_end_date">
                                        </div>
                                        <div class="form-group">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label class="label" for="sms_reporting_date">SMS Reporting Date<span class="star-color">*</span></label>
                                            <input type="date" name="sms_reporting_date" value="{{ $postCas->sms_reporting_date }}" class="form-control" id="sms_reporting_date">
                                        </div>
                                    </div>

                                    <div class="container-fluid mt-3" style="--bs-gutter-x: 0rem !important;">
                                        <div class="panel">
                                            <strong class="sub-title">Documents</strong>

                                            <div class="collapse-div mb-3">
                                                <div class="row extra-padding">
                                                    <div class="col-md-12 mt-1">
                                                        <label for="file4" class="pe-1 file-docs label">Screen Shot SMS Reporting:</label>
                                                        <input type="file" id="file4" name="sms_screen_shot[]" accept="application/pdf, image/png, image/jpeg, image/jpg, image/webp" class="file file_style form-control"
                                                            onchange="displayFileNames(this)" data-file-name="file-name4" multiple>
                                                        <label for="file4" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload Files
                                                        </label>
                                                        <span id="file-name4" class="ms-2 label file-names-display" style="word-break: break-all;">No Files Chosen.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse-div mb-3">
                                                <div class="row extra-padding">
                                                    <div class="col-md-12 mt-1">
                                                        <label for="file5" class="pe-1 file-docs label">BRP Documents:</label>
                                                        <input type="file" id="file5" name="brp_doc[]" accept="application/pdf, image/png, image/jpeg, image/jpg, image/webp" class="file file_style form-control"
                                                            onchange="displayFileNames(this)" data-file-name="file-name5" multiple>
                                                        <label for="file5" class="custom-file-upload">
                                                            <i aria-hidden="true" class="fa fa-upload"></i> Upload Files
                                                        </label>
                                                        <span id="file-name5" class="ms-2 label file-names-display" style="word-break: break-all;">No Files Chosen.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="my-2">
                                        <h4 class="address">
                                            Note On BRP Correction
                                        </h4>
                                    </div>

                                    <div class="form-row">
                                        <textarea class="form-control" name="brp_correction_note" id="exampleFormControlTextarea1" rows="3">{{ $postCas->brp_correction_note  }}</textarea>
                                    </div>

                            </div>
                        </div>

                        @php
                        $userRole = auth()->user()->role_id;
                        @endphp

                        <div class="form-buttons my-4">
                            <button type="submit" class="btn filter-btn">Submit</button>
                            <a href="{{ route('postcas.index') }}" type="submit" class="btn btn-cancel">Cancel</a>
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
    $(document).ready(function() {
        // Disable the fields on page load
        $('#student_notified_yes').prop('disabled', true);
        $('#student_notified_no').prop('disabled', true);
        $('#date_of_entry').prop('disabled', true);

        // Enable fields when 'before_vignette_yes' is checked
        $('#before_vignette_yes').on('change', function() {
            if ($(this).is(':checked')) {
                $('#student_notified_yes').prop('disabled', false);
                $('#student_notified_no').prop('disabled', false);
                $('#date_of_entry').prop('disabled', false);
            }
        });

        // Disable fields when 'before_vignette_no' is checked
        $('#before_vignette_no').on('change', function() {
            if ($(this).is(':checked')) {
                $('#student_notified_yes').prop('disabled', true);
                $('#student_notified_no').prop('disabled', true);
                $('#date_of_entry').prop('disabled', true);
            }
        });
    });
</script>


@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

@endpush
@endsection
