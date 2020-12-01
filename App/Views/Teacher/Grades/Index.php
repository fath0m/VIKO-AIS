<h1><?php echo $course->name ?></h1>

<?php $user = $student->User();?>
<h2><?php echo "{$user->first_name} {$user->last_name}"; ?> įvertinimai</h2>

<?php
$grades = $student->GradesGroupedByDate($course->id);
$total_grade_count = 0;
$total_grade_sum = 0;

foreach ($grades as $grade_group) {
    foreach ($grade_group as $grade) {
        $total_grade_count++;
        $total_grade_sum += $grade->value;
    }
}
?>

<table class="table table-bordered">
    <tbody>
        <tr>
            <th scope="row">Įvertinimo data</th>
            <?php foreach ($grades as $key => $grade_group): ?>
            <td><?php echo $key; ?></td>
            <?php endforeach;?>
            <th>Vidurkis</th>
        </tr>

        <tr>
            <th scope="row">Pažymiai</th>

            <?php foreach ($grades as $key => $grade_group): ?>
            <td>
                <?php foreach ($grade_group as $grade): ?>
                <div>
                    <a
                        href="/Teacher/Courses/<?php echo $course->id; ?>/Students/<?php echo $student->id; ?>/Grades/<?php echo $grade->id; ?>/Edit">
                        <?php echo $grade->value; ?>
                    </a>
                </div>
                <?php endforeach;?>
            </td>
            <?php endforeach;?>
            <td><?php echo $total_grade_sum / $total_grade_count; ?></td>
        </tr>
    </tbody>
</table>

<div>
    <a href="/Teacher/Courses/<?php echo $course->id; ?>/Students/<?php echo $student->id; ?>/Grades/Create"
        class="btn btn-sm btn-outline-primary">
        Naujas įvertinimas
    </a>
</div>