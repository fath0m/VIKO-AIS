<h1>
    Keisti įvertinimą
</h1>

<div class="row">
    <div class="col-5">
        <form method="post">
            <div class="form-group">
                <label>Studentas</label>

                <?php $user = $student->User();?>
                <input class="form-control" disabled value="<?php echo "{$user->first_name} {$user->last_name}"; ?>">
            </div>

            <div class="form-group">
                <label>Dalykas</label>

                <input class="form-control" disabled value="<?php echo $course->name; ?>">
            </div>

            <div class="form-group">
                <label for="value">Pažymys</label>
                <input type="number" min="0" max="10" class="form-control" id="value" name="value"
                    value="<?php echo $grade->value; ?>" required>
            </div>

            <div class="form-group">
                <label for="grade_date">Įvertinimo data</label>
                <input type="date" class="form-control" id="grade_date" name="grade_date" required>
            </div>

            <script>
            var gradeDateInput = document.getElementById("grade_date");

            gradeDateInput.valueAsDate = new Date("<?php echo $grade->grade_date; ?>");
            </script>

            <button type="submit" class="btn btn-primary">Redaguoti</button>
        </form>


        <div class="mt-5">
            <form method="post" onsubmit="return confirm('Ar tikrai norite ištrinti įvertinimą?');"
                action="/Teacher/Courses/<?php echo $course->id; ?>/Students/<?php echo $student->id; ?>/Grades/<?php echo $grade->id; ?>/Delete"">
                <button type=" submit" class="btn btn-danger">
                Ištrinti įvertinimą
                </button>
            </form>
        </div>
    </div>
</div>