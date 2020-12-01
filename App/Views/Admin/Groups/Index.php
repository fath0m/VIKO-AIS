<h1>
    Grupių sąrašas
</h1>

<div class="my-3">
    <a class="btn btn-outline-primary" href="/Admin/Groups/Create">
        Pridėti naują grupę
    </a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Pavadinimas</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($groups as $key => $group): ?>
        <tr>
            <td><?php echo $group->id; ?></td>
            <td><?php echo $group->name; ?></td>
            <td class="text-right">
                <a class="btn btn-sm btn-outline-primary" href="/Admin/Groups/<?php echo $group->id; ?>">
                    Peržiūra
                </a>
                <a class="btn btn-sm btn-outline-info" href="/Admin/Groups/<?php echo $group->id; ?>/Edit">
                    Keisti
                </a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>