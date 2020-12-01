<h1>
    <?php echo $group->name; ?>
</h1>

<div class="row mt-3">
    <div class="col-5">
        <?php include_once "./App/Views/Shared/Error.php";?>

        <form method="post">
            <div class="form-group">
                <label for="name">Pavadinimas</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $group->name; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Atnaujinti</button>
        </form>

        <div class="mt-5">
            <form method="post" onsubmit="return confirm('Ar tikrai norite ištrinti grupę?');"
                action="/Admin/Groups/<?php echo $group->id; ?>/Delete">
                <button type=" submit" class="btn btn-danger">
                    Ištrinti grupę
                </button>
            </form>
        </div>
    </div>
</div>