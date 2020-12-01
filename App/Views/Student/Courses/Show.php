<h1><?php echo $course->name ?></h1>

<div>
    <?php $teacher_user = $course->Teacher()->User();?>
    <strong>Dėstytojas:</strong> <?php echo "{$teacher_user->first_name} {$teacher_user->last_name}"; ?>
</div>

<div>
    <strong>Aprašymas:</strong> <?php echo $course->description; ?>
</div>

<h2 class="mt-4">
    Įvertinimai
</h2>

<?php $grades = $student->GradesGroupedByDate($course->id);?>

<table class="table table-bordered">
    <tbody>
        <tr>
            <th scope="row">Įvertinimo data</th>
            <?php foreach ($grades as $key => $grade_group): ?>
            <td><?php echo $key; ?></td>
            <?php endforeach;?>
        </tr>

        <tr>
            <th scope="row">Pažymiai</th>

            <?php foreach ($grades as $key => $grade_group): ?>
            <td>
                <?php foreach ($grade_group as $grade): ?>
                <div>
                    <?php echo $grade->value; ?>
                </div>
                <?php endforeach;?>
            </td>
            <?php endforeach;?>
        </tr>
    </tbody>
</table>