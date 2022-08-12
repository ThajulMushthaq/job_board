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
    <link rel="stylesheet" type="text/css"
        href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">

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
    </style>
</head>

<body>
    <div class="container mt-5 mb-3">

        <div class="row mb-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Details</div>
                    </div>
                    <div class="card-body">


                        <div class="row p-2">
                            <div class="col-md-8">
                                <div class="row mb-2">
                                    <label class="col-lg-4 fw-bold text-muted">COMPANY NAME</label>
                                    <div class="col-lg-8">
                                        <span class="sub-text">{{ @$res->company }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 fw-bold text-muted">EMAIL</label>
                                    <div class="col-lg-8">
                                        <span class="sub-text">{{ @$res->email }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 fw-bold text-muted">PHONE</label>
                                    <div class="col-lg-8">
                                        <span class="sub-text">{{ @$res->phone }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 fw-bold text-muted">LOCATION</label>
                                    <div class="col-lg-8">
                                        <span class="sub-text">{{ @$res->location }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 fw-bold text-muted">JOB TITLE</label>
                                    <div class="col-lg-8">
                                        <span class="sub-text">{{ @$res->job_title }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 fw-bold text-muted">JOB TYPE</label>
                                    <div class="col-lg-8">
                                        <span class="sub-text">{{ @$res->job_type }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 fw-bold text-muted">JOB DESCRIPTION</label>
                                    <div class="col-lg-8">
                                        <span class="sub-text">{{ @$res->job_description }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-4 fw-bold text-muted">POSTED AT</label>
                                    <div class="col-lg-8">
                                        <span class="sub-text">{{ date('d M Y', strtotime(@$res->created_at)) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>


                        <div class="d-flex">
                            <h3 class="text-dark mb-4">Applied Candidates </h3>
                        </div>

                        <div class="table-responsive border-top">
                            @if (@$candidates->isEmpty())
                                <div class="text-center my-4">No candidates applied</div>
                            @else
                                <table class="table table-striped table-hover" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Applied Date</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Resume</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach (@$candidates as $c)
                                            <tr>
                                                <td>{{ date('d M Y', strtotime(@$c->created_at)) }}</td>
                                                <td>{{ @$c->name }}</td>
                                                <td>{{ @$c->email }}</td>
                                                <td>{{ @$c->phone }}</td>
                                                <td>
                                                    @if (@$c->resume)
                                                        <a href="{{ asset('resume/' . @$c->resume) }}"
                                                            class="btn btn-sm btn-secondary mx-5"
                                                            target="_blank">Open</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>




                    </div>
                </div>

            </div>
        </div>

    </div>



</body>
<script type="text/javascript" charset="utf8"
    src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {

        $('#myTable').DataTable();

    });
</script>

</html>
