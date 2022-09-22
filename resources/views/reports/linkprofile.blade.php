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
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/">Profiles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/reports">Reports</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container-fluid p-5">
            <div class="container mt-5">
                @foreach ($data as $_data)
                    <div class="form-floating mb-3">
                        <input readonly type="text" class="form-control ajaxDisabled" id="firstNameFloating"
                            placeholder="Title" name="title" value="{{ $_data->title }}">
                        <label for="firstNameFloating">Title</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea readonly class="form-control ajaxDisabled" placeholder="Description" id="descriptionTextarea"
                            style="height: 212px;" name="description">{{ $_data->description }}</textarea>
                        <label for="descriptionTextarea">Description</label>
                    </div>
                @endforeach

                <form class="d-flex justify-content-around align-items-center mb-2">
                    @foreach ($data as $_data)
                        <input disabled type="text" name="report_id" value="{{ $_data->id }}" hidden>
                    @endforeach

                    <select class="form-select me-3" aria-label="Default select example" name="profile_id">
                        <option selected value="null">Select a profile</option>
                        @foreach ($profiles as $_profiles)
                            <option value="{{ $_profiles->id }}">
                                {{ $_profiles->first_name }} {{ $_profiles->last_name }}
                            </option>
                        @endforeach
                    </select>

                    <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                        data-bs-title="Create profile">
                        <button type="button" class="btn btn-success" onclick="addProfile()">
                            <i class="bi bi-plus-circle"></i>
                        </button>
                    </div>
                </form>

                <div class="alert alert-danger alert-dismissible fade show" role="alert" hidden>
                    <div class="alert-text"></div>
                    <button type="button" class="btn-close"
                        onclick="document.querySelector('.alert').hidden = true"></button>
                </div>
            </div>

            <div class="container mt-1">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date of birth</th>
                            <th scope="col">Gender</th>
                            <th scope="col" class="actions"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($linkeds as $_linkeds)
                            <tr>
                                <th scope="row">
                                    {{ $_linkeds->profile_id }}
                                </th>
                                <td>
                                    <div class="row">
                                        <div class="col text-break">
                                            {{ $_linkeds->first_name }} {{ $_linkeds->last_name }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col text-break">
                                            {{ date('d/m/Y', strtotime($_linkeds->dbo)) }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col text-break">
                                            {{ $_linkeds->gender }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="hstack">
                                        <div data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-custom-class="custom-tooltip" data-bs-title="Delete profile">
                                            <button class="btn btn-danger mx-1" data-bs-toggle="modal"
                                                data-bs-target="#deleteProfile{{ $_linkeds->profile_id }}Modal">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @foreach ($linkeds as $_linkeds)
                    <div class="modal fade" id="deleteProfile{{ $_linkeds->profile_id }}Modal" tabindex="-1"
                        aria-labelledby="deleteProfile{{ $_linkeds->profile_id }}ModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteProfile{{ $_linkeds->profile_id }}ModalLabel">
                                        Remove
                                        '{{ $_linkeds->first_name }} {{ $_linkeds->last_name }}'?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form
                                    action="/reports/linkprofile/delete/{{ $_linkeds->id }}/{{ $_linkeds->profile_id }}"
                                    method="POST">
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
