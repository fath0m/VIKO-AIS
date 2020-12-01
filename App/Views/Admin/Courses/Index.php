<h1>
    Dalykų sąrašas
</h1>

<div class="my-3">
    <a class="btn btn-outline-primary" href="/Admin/Courses/Create">
        Pridėti naują dalyką
    </a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Pavadinimas</th>
            <th scope="col">Aprašymas</th>
            <th scope="col">Dėstytojas</th>
            <th scope="col">Grupių kiekis</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($courses as $course): ?>
        <tr>
            <td><?php echo $course->id; ?></td>
            <td><?php echo $course->name; ?></td>
            <td><?php echo $course->description; ?></td>
            <td>
                <?php $teacher_user = $course->Teacher()->User();?>
                <?php echo "{$teacher_user->first_name} {$teacher_user->last_name}" ?>
            </td>
            <td>
                <?php $groups = $course->Groups();?>
                <?php echo sizeof($groups); ?>
            </td>
            <td class="text-right">
                <a class="btn btn-sm btn-outline-primary" href="/Admin/Courses/<?php echo $course->id; ?>">
                    Peržiūra
                </a>
                <a class="btn btn-sm btn-outline-info" href="/Admin/Courses/<?php echo $course->id; ?>/Edit">
                    Keisti
                </a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>