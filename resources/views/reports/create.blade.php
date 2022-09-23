<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="/assets/img/logo.svg">
    <title>Reports - Create</title>
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
                        <a class="nav-link" aria-current="page" href="/">Profiles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/reports">Reports</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="container-fluid p-5">
            <div class="container mt-5 ml-5 mr-5 p-5">
                <form class="mx-5">
                    @csrf

                    <div class="form-floating mb-3">
                        <input required type="text" class="form-control ajaxDisabled" id="firstNameFloating"
                            placeholder="Title" name="title" maxlength="250">
                        <label for="firstNameFloating">Title</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea required class="form-control ajaxDisabled" placeholder="Description" id="descriptionTextarea"
                            style="height: 212px;" name="description" maxlength="500"></textarea>
                        <label for="descriptionTextarea">Description</label>
                    </div>

                    <div class="d-flex justify-content-end">
                        <div>
                            <a href="/reports">
                                <button type="button" class="btn btn-secondary ajaxDisabled">Close</button>
                            </a>
                            <button type="button" class="btn btn-success ajaxDisabled" onclick="ajaxReport();">
                                Save changes
                                <span class="spinner-border spinner-border-sm" role="status"
                                    style="visibility: hidden;"></span>
                            </button>
                        </div>
                    </div>
                </form>
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
