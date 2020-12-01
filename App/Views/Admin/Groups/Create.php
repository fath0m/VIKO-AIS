<h1>Sukurti naują grupę</h1>

<div class="row mt-3">
    <div class="col-5">
        <?php include_once "./App/Views/Shared/Error.php";?>

        <form method="post">
            <div class="form-group">
                <label for="name">Pavadinimas</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Sukurti</button>
        </form>
    </div>
</div>