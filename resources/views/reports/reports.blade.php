<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid d-flex justify-content-center">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Profiles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/reports">Reports</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="container mt-5">
                <div class="d-flex justify-content-end align-items-center">
                    <a href="/reports/create">
                        <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                            data-bs-title="Create report">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#createReportModal">
                                <i class="bi bi-plus-circle"></i>
                            </button>
                        </div>
                    </a>
                </div>
            </div>

            <div class="container mt-5">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col" class="actions"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $_data)
                            <tr>
                                <th scope="row">{{ $_data->id }}</th>
                                <td>
                                    <div class="row">
                                        <div class="col text-break">
                                            {{ $_data->title }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col text-break">
                                            {{ $_data->description }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="hstack">
                                        <a href="/reports/view/{{ $_data->id }}">
                                            <div data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-custom-class="custom-tooltip" data-bs-title="View Report">
                                                <button class="btn btn-secondary mx-1">
                                                    <i class="bi bi-binoculars"></i>
                                                </button>
                                            </div>
                                        </a>

                                        <a href="/sendreport/{{ $_data->id }}">
                                            <div data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-custom-class="custom-tooltip"
                                                data-bs-title="Send report to email">
                                                <button class="btn btn-outline-secondary mx-1">
                                                    <i class="bi bi-file-earmark-pdf"></i>
                                                </button>
                                            </div>
                                        </a>

                                        <a href="/reports/linkprofile/{{ $_data->id }}">
                                            <div data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-custom-class="custom-tooltip"
                                                data-bs-title="Link and edit profiles">
                                                <button class="btn btn-outline-primary mx-1">
                                                    <i class="bi bi-person-plus"></i>
                                                </button>
                                            </div>
                                        </a>

                                        <div data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-custom-class="custom-tooltip" data-bs-title="Edit Report">
                                            <button class="btn btn-primary mx-1" data-bs-toggle="modal"
                                                data-bs-target="#editReport{{ $_data->id }}Modal">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </div>

                                        <div data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-custom-class="custom-tooltip" data-bs-title="Delete Report">
                                            <button class="btn btn-danger mx-1" data-bs-toggle="modal"
                                                data-bs-target="#deleteReport{{ $_data->id }}Modal">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @foreach ($data as $_data)
                    <div class="modal fade" id="deleteReport{{ $_data->id }}Modal" tabindex="-1"
                        aria-labelledby="deleteReport{{ $_data->id }}ModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteReport{{ $_data->id }}ModalLabel">Delete
                                        '{{ $_data->title }}'?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="/reports/delete/{{ $_data->id }}" method="POST">
                                    @csrf
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">
                                            Yes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="editReport{{ $_data->id }}Modal" tabindex="-1"
                        aria-labelledby="editReport{{ $_data->id }}ModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editReport{{ $_data->id }}ModalLabel">Edit
                                        report</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="/reports/update/{{ $_data->id }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="firstNameFloating"
                                                placeholder="Title" name="title" maxlength="250"
                                                value="{{ $_data->title }}">
                                            <label for="firstNameFloating">Title</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea required class="form-control ajaxDisabled" placeholder="Description"
                                                id="descriptionTextarea"name="description" maxlength="500">{{ $_data->description }}</textarea>
                                            <label for="descriptionTextarea">Description</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">
                                            Save changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="/assets/js/script.js"></script>
</body>

</html>
