<h1>
    <?php echo "{$user->first_name} {$user->last_name}"; ?>
</h1>

<table class="table table-bordered w-50">
    <tbody>
        <tr>
            <th>ID</th>
            <td><?php echo $user->id ?></td>
        </tr>
        <tr>
            <th>Vardas</th>
            <td><?php echo $user->first_name ?></td>
        </tr>

        <tr>
            <th>Pavardė</th>
            <td><?php echo $user->last_name ?></td>
        </tr>

        <tr>
            <th>Prisijungimo vardas</th>
            <td><?php echo $user->username ?></td>
        </tr>

        <tr>
            <th>El. paštas</th>
            <td><?php echo $user->email ?></td>
        </tr>

        <tr>
            <th>Slaptažodis</th>
            <td><?php echo $user->password ?></td>
        </tr>

        <tr>
            <th>Telefonas</th>
            <td><?php echo $user->contact_number ?></td>
        </tr>

        <tr>
            <th>Rolė</th>
            <td><?php echo $user->GetRoleTranslated() ?></td>
        </tr>

        <!-- IF STUDENT -->
        <?php if ($user->role === "Student"): ?>
        <?php $student = $user->Student();?>
        <?php $group = $student->Group();?>

        <tr>
            <th>Grupė</th>
            <td><?php echo $group->name ?? "-"; ?></td>
        </tr>

        <?php endif;?>

        <!-- IF TEACHER -->
        <?php if ($user->role === "Teacher"): ?>
        <?php $teacher = $user->Teacher();?>
        <?php $courses = $teacher->Courses();?>

        <tr>
            <th>Dėstomi dalykai</th>
            <td>
                <ul>
                    <?php foreach ($courses as $course): ?>
                    <li><?php echo $course->name ?></li>
                    <?php endforeach;?>
                </ul>

            </td>
        </tr>
        <?php endif;?>
    </tbody>
</table>