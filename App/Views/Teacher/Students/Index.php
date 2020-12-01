<h1><?php echo $course->name ?></h1>

<h2>Studentų sąrašas</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">Vardas</th>
            <th scope="col">Pavardė</th>
            <th scope="col">Prisijungimo vardas</th>
            <th scope="col">Grupė</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($students as $student): ?>
        <tr>
            <?php $user = $student->User();?>
            <?php $group = $student->Group();?>

            <td><?php echo $user->first_name; ?></td>
            <td><?php echo $user->last_name; ?></td>
            <td><?php echo $user->username; ?></td>
            <td><?php echo $group->name; ?></td>

            <td class="text-right">
                <a href="/Teacher/Courses/<?php echo $course->id; ?>/Students/<?php echo $student->id; ?>/Grades/Create"
                    class="btn btn-sm btn-outline-primary">
                    Įvertinti
                </a>

                <a href="/Teacher/Courses/<?php echo $course->id; ?>/Students/<?php echo $student->id; ?>/Grades"
                    class="btn btn-sm btn-outline-info">
                    Pažymiai
                </a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>