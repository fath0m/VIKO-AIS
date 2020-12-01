<h1>Sukurti naują dalyką</h1>

<div class="row mt-3">
    <div class="col-5">
        <?php include_once "./App/Views/Shared/Error.php";?>

        <form method="post">
            <div class="form-group">
                <label for="name">Pavadinimas</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="description">Aprašymas</label>
                <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <label for="teacher_user_id">Dėstytojas</label>
                <select class="form-control" id="teacher_user_id" name="teacher_user_id">
                    <option value="" disabled selected>Pasirinkite destytoją</option>

                    <?php foreach ($teachers as $teacher): ?>
                    <option value="<?php echo $teacher->id ?>">
                        <?php echo "{$teacher->first_name} {$teacher->last_name} ($teacher->username)" ?></option>
                    <?php endforeach;?>
                </select>
            </div>

            <div class="form-group">
                <label for="groups[]">Grupės</label>
                <select multiple class="form-control" id="groups[]" name="groups[]" style="height: 200px;">
                    <?php foreach ($groups as $group): ?>
                    <option value="<?php echo $group->id ?>"><?php echo $group->name; ?></option>
                    <?php endforeach;?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Sukurti</button>
        </form>
    </div>
</div>