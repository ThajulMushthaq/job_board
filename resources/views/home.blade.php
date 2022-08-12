<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Board</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        body {
            background-color: #eee
        }

        .card {
            border: none;
            border-radius: 10px
        }

        .c-details span {
            font-weight: 300;
            font-size: 13px
        }

        .text2 {
            color: #a5aec0
        }

        .form-control::placeholder {
            font-size: 0.95rem;
            color: #aaa;
            font-style: italic;
        }

        .form-control:focus {
            box-shadow: none;
        }

        .error {
            color: rgb(240, 83, 83);
            font-size: 80%;
        }

        .heading {
            text-decoration: none;
            color: #292929;
            font-weight: 600;
            font-size: 30px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container mt-5 mb-3">

        <div class="row mb-5">
            <div class="col-lg-10 mx-auto">
                <form action="">
                    <div class="p-1 bg-light rounded rounded-pill shadow-sm">
                        <input type="search" placeholder="Search here..." id="search"
                            aria-describedby="button-addon1" class="form-control border-0 bg-light">
                    </div>
                </form>
            </div>
            <div class="col-lg-2 mx-auto mt-1">
                <button type="button" class="btn btn-info w-100" data-bs-toggle="modal" data-bs-target="#myModal"
                    id="add_job">Add Job Openings</button>
            </div>
        </div>

        @if (Session::has('success'))
            <div class="alert alert-success">
                <strong>Done!</strong> {{ Session::get('success') }}
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row" id="data-row">

            @if (@$data)
                @foreach (@$data as $d)
                    <div class="col-md-4 data-col my-2">
                        <div class="card p-3 mb-2 ">
                            <div class="d-flex justify-content-between">
                                <a href="{{ url('jobs/show/' . $d->id) }}"
                                    class="heading c-details">{{ $d->job_title }}</a>
                                <a href="{{ url('jobs/show/' . $d->id) }}" class="btn btn-light text-warning">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                            <div class="text2">
                                <span class="fw-bold">{{ $d->company }}</span>, {{ $d->location }}
                            </div>
                            <div class="ms-2 mt-2">
                                <a href="tel:{{ $d->phone }}" style="text-decoration: none;color:#292929;">
                                    <h6>{{ $d->phone }}</h6>
                                </a>
                                <a href="mailto:{{ $d->email }}">
                                    <div class="mt-2 text2">{{ $d->email }}</div>
                                </a>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-secondary w-100 border shadow-sm" data-bs-toggle="modal"
                                    data-bs-target="#applyModal" id="apply_job"
                                    onclick="applyJob({{ $d->id }})">Apply</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>

    </div>



    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('/jobs/store') }}" method="POST" enctype="multipart/form-data"
                    id="job_create_form">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add Job</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 my-1">
                                <div class="form-group">
                                    <label>Company</label>
                                    <input type="text" class="form-control" name="company">
                                </div>
                            </div>
                            <div class="col-md-6 my-1">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email">
                                </div>
                            </div>
                            <div class="col-md-6 my-1">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" name="phone">
                                </div>
                            </div>
                            <div class="col-md-6 my-1">
                                <div class="form-group">
                                    <label>Location</label>
                                    <input type="text" class="form-control" name="location">
                                </div>
                            </div>
                            <div class="col-md-6 my-1">
                                <div class="form-group">
                                    <label>Job Title</label>
                                    <input type="text" class="form-control" name="job_title">
                                </div>
                            </div>
                            <div class="col-md-6 my-1">
                                <div class="form-group">
                                    <label>Job Type</label>
                                    <select name="job_type" class="form-control">
                                        <option value="" selected disabled>--select any--</option>
                                        <option value="Full Time">Full Time</option>
                                        <option value="Part Time">Part Time</option>
                                        <option value="Contract">Contract</option>
                                        <option value="Freelance">Freelance</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 my-1">
                                <div class="form-group">
                                    <label>Job Description</label>
                                    <textarea name="job_description" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal" id="applyModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('/candidates/store') }}" method="POST" enctype="multipart/form-data"
                    id="job_apply_form">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Apply Job</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 my-1">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="col-md-6 my-1">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email">
                                </div>
                            </div>
                            <div class="col-md-6 my-1">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" name="phone">
                                </div>
                            </div>
                            <div class="col-md-6 my-1">
                                <div class="form-group">
                                    <label>Resume</label>
                                    <input type="file" class="form-control" name="resume">
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="job" id="job_id">

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#data-row .data-col").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });


        $('#add_job').click(function() {
            $("#job_create_form").trigger("reset");
        })

        $('#apply_job').click(function() {

        })

    });

    function applyJob(id = 0) {
        $("#job_apply_form").trigger("reset");
        $('#job_id').val(id)

    }
</script>

<script>
    $("#job_create_form").validate({
        rules: {
            company: "required",
            email: "required",
            phone: "required",
            location: "required",
            job_title: "required",
        },
        messages: {
            company: "Company field is required.",
            email: "Email field is required.",
            phone: "Phone field is required.",
            location: "Location field is required.",
            job_title: "Job Title field is required.",
        }

    });
</script>

</html>
