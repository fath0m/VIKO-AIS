<div class="row justify-content-center">
    <div class="col-5">
        <div class="card">
            <div class="card-body">
                <?php include_once "./App/Views/Shared/Error.php";?>

                <h3 class="text-center">Prisijungti prie AIS</h3>

                <hr />

                <form method="post">
                    <div class="form-group">
                        <label for="username">Prisijungimo kodas</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Slaptažodis</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Prisijungti prie sistemos</button>
                </form>
            </div>
        </div>
    </div>
</div>