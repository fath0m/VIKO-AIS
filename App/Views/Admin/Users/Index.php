<h1>
    Vartotojų sąrašas
</h1>

<div class="my-3">
    <a class="btn btn-outline-primary" href="/Admin/Users/Create">
        Pridėti naują vartotoją
    </a>
</div>

<table class="table table-bordered table-responsive">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Vardas</th>
            <th scope="col">Pavardė</th>
            <th scope="col">Prisijungimo vardas</th>
            <th scope="col">El. paštas</th>
            <th scope="col">Slaptažodis</th>
            <th scope="col">Telefonas</th>
            <th scope="col">Rolė</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $key => $user): ?>
        <tr>
            <td><?php echo $user->id; ?></td>
            <td><?php echo $user->first_name; ?></td>
            <td><?php echo $user->last_name; ?></td>
            <td><?php echo $user->username; ?></td>
            <td><?php echo $user->email; ?></td>
            <td>&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;</td>
            <td><?php echo $user->contact_number; ?></td>
            <td><?php echo $user->GetRoleTranslated(); ?></td>
            <td class="text-right">
                <a class="btn btn-sm btn-outline-primary" href="/Admin/Users/<?php echo $user->id; ?>">
                    Peržiūra
                </a>
                <a class="btn btn-sm btn-outline-info" href="/Admin/Users/<?php echo $user->id; ?>/Edit">
                    Keisti
                </a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>