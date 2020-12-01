<?php

if (!isset($student)) {
    throw new Exception("Student parameter is missing");
}

$grades = $student->GradesGroupedByDate();
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
            <td>Vidurkis</td>
        </tr>

        <tr>
            <th scope="row">Pažymiai</th>

            <?php foreach ($grades as $key => $grade_group): ?>
            <td>
                <?php foreach ($grade_group as $grade): ?>
                <?php echo $grade->value; ?>
                <br />
                <?php endforeach;?>
            </td>
            <?php endforeach;?>
            <td><?php echo $total_grade_sum / $total_grade_count; ?></td>
        </tr>
    </tbody>
</table>