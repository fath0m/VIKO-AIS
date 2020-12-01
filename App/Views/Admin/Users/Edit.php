<h1>
    <?php echo "{$user->first_name} {$user->last_name}"; ?>
</h1>

<div class="row">
    <div class="col-5">
        <?php include_once "./App/Views/Shared/Error.php";?>

        <form method="post">
            <div class="form-group">
                <label for="name">Vardas</label>
                <input type="text" class="form-control" id="first_name" name="first_name"
                    value="<?php echo $user->first_name; ?>" required>
            </div>

            <div class="form-group">
                <label for="name">Pavardė</label>
                <input type="text" class="form-control" id="last_name" name="last_name"
                    value="<?php echo $user->last_name; ?>" required>
            </div>

            <div class="form-group">
                <label for="username">Prisijungimo vardas</label>
                <input type="text" class="form-control" id="username" name="username"
                    value="<?php echo $user->username; ?>" disabled>
            </div>

            <div class="form-group">
                <label for="name">Elektroninis paštas</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user->email; ?>"
                    required>
            </div>

            <div class="form-group">
                <label for="password">Slaptažodis</label>
                <input type="text" class="form-control" id="password" name="password"
                    value="<?php echo $user->password; ?>" required>
            </div>

            <div class="form-group">
                <label for="name">Kontaktinis telefonas</label>
                <input type="text" class="form-control" id="contact_number" name="contact_number"
                    value="<?php echo $user->contact_number; ?>" required>
            </div>

            <div class="form-group">
                <label for="role">Rolė</label>
                <select class="form-control" id="role" name="role" disabled>
                    <option value="Student" <?php if ($user->role === "Student"): echo "selected";endif;?>>
                        Studentas</option>
                    <option value="Teacher" <?php if ($user->role === "Teacher"): echo "selected";endif;?>>Dėstytojas
                    </option>
                    <option value="Admin" <?php if ($user->role === "Admin"): echo "selected";endif;?>>
                        Administratorius</option>
                </select>
            </div>

            <?php if ($user->role === "Student"): ?>
            <?php $student = $user->Student();?>
            <div class="form-group">
                <label for="group">Grupė</label>
                <select class="form-control" id="group" name="group" required>
                    <option value="" disabled selected>Pasirinkite grupę</option>

                    <?php foreach ($groups as $key => $group): ?>
                    <option value="<?php echo $group->id ?>"
                        <?php if ($student->group_id === $group->id): echo "selected";endif;?>>
                        <?php echo $group->name ?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <?php endif;?>

            <button type="submit" class="btn btn-primary">Atnaujinti</button>
        </form>

        <div class="mt-5">
            <form method="post" onsubmit="return confirm('Ar tikrai norite ištrinti vartotoją?');"
                action="/Admin/Users/<?php echo $user->id; ?>/Delete">
                <button type=" submit" class="btn btn-danger">
                    Ištrinti vartotoją
                </button>
            </form>
        </div>
    </div>
</div>