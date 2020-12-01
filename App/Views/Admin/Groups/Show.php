<h1>
    <?php echo $group->name ?>
</h1>

<h2 class="mt-3">
    Dalykų sąrašas
</h2>

<ul>
    <?php $courses = $group->Courses();?>

    <?php foreach ($courses as $course): ?>
    <li><?php echo $course->name; ?></li>
    <?php endforeach;?>

</ul>

<h2 class="mt-3">
    Studentų sąrašas
</h2>

<table class="table table-bordered">
    <tr>
        <th>
            Vardas
        </th>
        <th>
            Pavardė
        </th>
        <th>
            Prisijungimo vardas
        </th>
        <th>
            El. paštas
        </th>
        <th>
            Kontaktinis telefonas
        </th>
    </tr>

    <?php $students = $group->Students();?>
    <?php foreach ($students as $student): ?>
    <?php $user = $student->User();?>
    <tr>
        <td>
            <?php echo $user->first_name; ?>
        </td>

        <td>
            <?php echo $user->last_name; ?>
        </td>

        <td>
            <?php echo $user->username; ?>
        </td>

        <td>
            <?php echo $user->email; ?>
        </td>

        <td>
            <?php echo $user->contact_number; ?>
        </td>
    </tr>
    <?php endforeach;?>

</table>