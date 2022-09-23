<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profiles</title>
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
                    <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                        data-bs-title="Create profile">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#createProfileModal">
                            <i class="bi bi-plus-circle"></i>
                        </button>
                    </div>
                </div>

                <div class="modal fade" id="createProfileModal" tabindex="-1" aria-labelledby="createProfileModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createProfileModalLabel">Create profile</h5>
                                <button type="button" class="btn-close ajaxDisabled" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form>
                                <div class="modal-body">
                                    <div class="form-floating mb-3">
                                        <input required type="text" class="form-control ajaxDisabled"
                                            id="firstNameFloating" placeholder="First name" name="first_name">
                                        <label for="firstNameFloating" maxlength="250">First name</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input required type="text" class="form-control ajaxDisabled"
                                            id="lastNameFloating" placeholder="First name" name="last_name">
                                        <label for="lastNameFloating" maxlength="250">Last name</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input required type="date" class="form-control ajaxDisabled"
                                            id="dboFloating" placeholder="First name" name="dbo">
                                        <label for="dboFloating">Date of birth</label>
                                    </div>
                                    <select required class="form-select ajaxDisabled"
                                        aria-label="Default select example" name="gender">
                                        <option selected value="Not informed">I prefer not to inform</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary ajaxDisabled"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-success ajaxDisabled"
                                        onclick="disable(); ajaxProfile();">
                                        Save changes
                                        <span class="spinner-border spinner-border-sm" role="status"
                                            style="visibility: hidden;"></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-5">
                <table class="table table-dark table-striped table-hover" id="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Date of birth</th>
                            <th scope="col">Gender</th>
                            <th scope="col" class="actions"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $_data)
                            <tr>
                                <th scope="row">{{ $_data->id }}</th>
                                <td>
                                    <div class="col text-break">
                                        {{ $_data->first_name }}
                                    </div>
                                </td>
                                <td>
                                    <div class="col text-break">
                                        {{ $_data->last_name }}
                                    </div>
                                </td>
                                <td>{{ date('d/m/Y', strtotime($_data->dbo)) }}</td>
                                <td>{{ $_data->gender }}</td>
                                <td>
                                    <div class="hstack">
                                        <div data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-custom-class="custom-tooltip" data-bs-title="Edit profile">
                                            <button class="btn btn-primary mx-1" data-bs-toggle="modal"
                                                data-bs-target="#editProfile{{ $_data->id }}Modal">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </div>

                                        <div data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-custom-class="custom-tooltip" data-bs-title="Delete profile">
                                            <button class="btn btn-danger mx-1" data-bs-toggle="modal"
                                                data-bs-target="#deleteProfile{{ $_data->id }}Modal">
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
                    <div class="modal fade" id="deleteProfile{{ $_data->id }}Modal" tabindex="-1"
                        aria-labelledby="deleteProfile{{ $_data->id }}ModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteProfile{{ $_data->id }}ModalLabel">Delete
                                        '{{ $_data->first_name }} {{ $_data->last_name }}'?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="/profile/delete/{{ $_data->id }}" method="POST">
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

                    <div class="modal fade" id="editProfile{{ $_data->id }}Modal" tabindex="-1"
                        aria-labelledby="editProfile{{ $_data->id }}ModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editProfile{{ $_data->id }}ModalLabel">Edit
                                        profile</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="/profile/update/{{ $_data->id }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-floating mb-3">
                                            <input required type="text" class="form-control"
                                                id="firstNameFloating" placeholder="First name" name="first_name"
                                                maxlength="250" value="{{ $_data->first_name }}">
                                            <label for="firstNameFloating">First name</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input required type="text" class="form-control" id="lastNameFloating"
                                                placeholder="Last name" name="last_name" maxlength="250"
                                                value="{{ $_data->last_name }}">
                                            <label for="lastNameFloating">Last name</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input required type="date" class="form-control" id="dboFloating"
                                                placeholder="Date of birth" name="dbo"
                                                value="{{ $_data->dbo }}">
                                            <label for="dboFloating">Date of birth</label>
                                        </div>
                                        <select required class="form-select" aria-label="Default select example"
                                            name="gender">
                                            @switch($_data->gender)
                                                @case('Not informed')
                                                    <option selected value="Not informed">I prefer not to inform</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                @break

                                                @case('Male')
                                                    <option value="Not informed">I prefer not to inform</option>
                                                    <option selected value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                @break

                                                @case('Female')
                                                    <option value="Not informed">I prefer not to inform</option>
                                                    <option value="Male">Male</option>
                                                    <option selected value="Female">Female</option>
                                                @break
                                            @endswitch
                                        </select>
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
