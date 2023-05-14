<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-3">
        <div class="card w-75 mx-auto">
            <div class="card-header bg-secondary text-white">
                Users Data
            </div>
            <div class="card-body">
                <form action="" method="GET">
                    <div class="input-group input-group-sm mb-3 w-50">
                        <input type="text" value="<?= $inputText; ?>" name="inputText" class="form-control"
                            placeholder="Enter text here to search" aria-label="Enter here to search"
                            aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </form>

                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#userFormModal">
                    Add new User
                </button>

                <table class="table table-striped mt-2">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Authority</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $u) {
                            $number++;
                            ?>
                            <tr>
                                <td>
                                    <?= $number ?>
                                </td>
                                <td>
                                    <?= $u['username'] ?>
                                </td>
                                <td>
                                    <?= $u['name'] ?>
                                </td>
                                <td>
                                    <?= $u['email'] ?>
                                </td>
                                <td>
                                    <?= $u['authority'] ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm py-0">Edit</button>&nbsp;
                                    <button type="button" class="btn btn-danger btn-sm py-0">Delete</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <?php
                $paginateLink = (string) $pager->links();
                $paginateLink = str_replace('<li class="active">', '<li class="page-item active">', $paginateLink);
                $paginateLink = str_replace('<li>', '<li class="page-item">', $paginateLink);
                $paginateLink = str_replace('<a', '<a class="page-link"', $paginateLink);

                echo $paginateLink;
                ?>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="userFormModal" tabindex="-1" aria-labelledby="userFormModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="userFormModalLabel">User Form</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="user__modal--close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success py-1 success" role="alert" style="display:none">
                        </div>
                        <div class="alert alert-danger py-1 error" role="alert" style="display:none">
                        </div>
                        <div class="mb-3 row">
                            <label for="inputUsername"
                                class="col-sm-3 col-form-label col-form-label-sm text-end">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm w-75" id="inputUsername">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputName" class="col-sm-3 col-form-label col-form-label-sm text-end">Full
                                Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="inputName">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputEmail"
                                class="col-sm-3 col-form-label col-form-label-sm text-end">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control form-control-sm w-75" id="inputEmail">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword"
                                class="col-sm-3 col-form-label col-form-label-sm text-end">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control form-control-sm w-75" id="inputPassword">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="selectAuthority"
                                class="col-sm-3 col-form-label col-form-label-sm text-end">Authority</label>
                            <div class="col-sm-9">
                                <select class="form-select form-select-sm w-50" aria-label="Select authority"
                                    id="selectAuthority">
                                    <option value="operator" selected>Operator</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"
                            id="user__modal--close">Close</button>
                        <button type="button" class="btn btn-primary btn-sm" id="userFormButtonSave">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/bootstrap.bundle.min.js"></script>

    <script src="/js/jquery-3.7.0.min.js"></script>

    <script src="/js/pages/user.js"></script>
</body>

</html>