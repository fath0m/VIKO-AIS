<h1><?php echo $course->name ?></h1>

<table class="table table-bordered w-50">
    <tr>
        <th>Id</th>
        <td><?php echo $course->id ?></td>
    </tr>

    <tr>
        <th>Pavadinimas</th>
        <td><?php echo $course->name ?></td>
    </tr>

    <tr>
        <th>Aprašymas</th>
        <td><?php echo $course->description ?></td>
    </tr>

    <tr>
        <th>Grupės</th>
        <td>
            <?php $groups = $course->Groups();?>

            <ul>
                <?php foreach ($groups as $group): ?>
                <li><?php echo $group->name ?></li>
                <?php endforeach;?>
            </ul>
        </td>
    </tr>
</table>

<div>
    <a href="/Teacher/Courses/<?php echo $course->id; ?>/Students" class="btn btn-outline-primary">
        Studentų sąrašas
    </a>
</div>