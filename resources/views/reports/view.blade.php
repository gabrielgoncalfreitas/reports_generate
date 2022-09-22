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
            </div>

            <div class="container mt-1">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date of birth</th>
                            <th scope="col">Gender</th>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
