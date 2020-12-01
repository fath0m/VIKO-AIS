<h1>
    Naujas įvertinimas
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
                <input type="number" min="0" max="10" class="form-control" id="value" name="value" required>
            </div>

            <div class="form-group">
                <label for="grade_date">Įvertinimo data</label>
                <input type="date" class="form-control" id="grade_date" name="grade_date" required>
            </div>
            <button type="submit" class="btn btn-primary">Sukurti</button>
        </form>
    </div>
</div>