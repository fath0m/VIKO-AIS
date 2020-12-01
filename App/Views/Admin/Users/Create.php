<script>
function createUser() {
    return {
        first_name: '',
        last_name: '',
        password: '',
        role: "Student",
        username: '',
        generatePassword() {
            this.password = Math.random().toString(36).slice(2);
        },
        generateUsername() {
            if (!this.first_name || !this.last_name) {
                return alert("Įveskite vardą ir pavardę");
            }

            var formatted_first_name = this.first_name.trim().replace(" ", "").toLowerCase();
            var formatted_last_name = this.last_name.trim().replace(" ", "").toLowerCase();

            this.username = formatted_first_name + "." + formatted_last_name;
        },
    }
}
</script>

<h1>Sukurti naują vartotoją</h1>

<div class="row mt-3">
    <div class="col-5">
        <?php include_once "./App/Views/Shared/Error.php";?>

        <form method="post" x-data="createUser()">
            <div class="form-group">
                <label for="name">Vardas</label>
                <input type="text" class="form-control" id="first_name" name="first_name" x-model="first_name" required>
            </div>

            <div class="form-group">
                <label for="name">Pavardė</label>
                <input type="text" class="form-control" id="last_name" name="last_name" x-model="last_name" required>
            </div>

            <div class="form-group">
                <label for="username">Prisijungimo vardas</label>

                <div class="input-group">
                    <input type="text" class="form-control" id="username" name="username" x-model="username" required>

                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button"
                            @click="generateUsername">Generuoti</button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="name">Elektroninis paštas</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Slaptažodis</label>

                <div class="input-group">
                    <input type="text" class="form-control" id="password" name="password" x-model="password" required>

                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button"
                            @click="generatePassword">Generuoti</button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="name">Kontaktinis telefonas</label>
                <input type="text" class="form-control" id="contact_number" name="contact_number" required>
            </div>

            <div class="form-group">
                <label for="role">Rolė</label>
                <select class="form-control" id="role" name="role" x-model="role" required>
                    <option value="" disabled selected>Pasirinkite rolę</option>
                    <option value="Student">Studentas</option>
                    <option value="Teacher">Dėstytojas</option>
                    <option value="Admin">Administratorius</option>
                </select>
            </div>

            <div class="mt-5" x-show="role === 'Student'" style="display: none;">
                <h3>Studento informacija</h3>

                <div class="form-group">
                    <label for="group">Grupė</label>
                    <select class="form-control" id="group" name="group" x-bind:required="role === 'Student'">
                        <option value="" disabled selected>Pasirinkite grupę</option>

                        <?php foreach ($groups as $key => $group): ?>
                        <option value="<?php echo $group->id ?>"><?php echo $group->name ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Sukurti</button>
        </form>
    </div>
</div>