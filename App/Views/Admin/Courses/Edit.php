<h1><?php echo $course->name ?></h1>

<div class="row mt-3">
    <div class="col-5">
        <?php include_once "./App/Views/Shared/Error.php";?>

        <form method="post">
            <div class="form-group">
                <label for="name">Pavadinimas</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $course->name ?>"
                    required>
            </div>

            <div class="form-group">
                <label for="description">Aprašymas</label>
                <textarea class="form-control" id="description" name="description" rows="5"
                    required><?php echo $course->description ?></textarea>
            </div>

            <div class="form-group">
                <label for="teacher_user_id">Dėstytojas</label>
                <select class="form-control" id="teacher_user_id" name="teacher_user_id">
                    <option value="" disabled selected>Pasirinkite destytoją</option>

                    <?php foreach ($teachers as $teacher): ?>
                    <option value="<?php echo $teacher->id ?>"
                        <?php if ($teacher->Teacher()->id === $course->teacher_id): echo "selected";endif;?>>
                        <?php echo "{$teacher->first_name} {$teacher->last_name} ($teacher->username)" ?></option>
                    <?php endforeach;?>
                </select>
            </div>

            <div class="form-group">
                <label for="groups[]">Grupės</label>
                <select multiple class="form-control" id="groups[]" name="groups[]" style="height: 200px;">
                    <?php foreach ($groups as $group): ?>
                    <option value="<?php echo $group->id ?>"
                        <?php if (in_array($group->id, $selected_groups)): echo "selected";endif;?>>
                        <?php echo $group->name; ?></option>
                    <?php endforeach;?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Atnaujinti</button>
        </form>

        <div class="mt-5">
            <form method="post" onsubmit="return confirm('Ar tikrai norite ištrinti dalyką?');"
                action="/Admin/Courses/<?php echo $course->id; ?>/Delete">
                <button type=" submit" class="btn btn-danger">
                    Ištrinti dalyką
                </button>
            </form>
        </div>
    </div>
</div>