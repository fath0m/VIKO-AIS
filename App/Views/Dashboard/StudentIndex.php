<h1>
    Dalykai
</h1>

<div class="list-group mt-4">
    <?php foreach ($courses as $course): ?>
    <a href="/Student/Courses/<?php echo $course->id; ?>" class="list-group-item list-group-item-action">
        <?php echo $course->name; ?>
    </a>

    <?php endforeach;?>
</div>

<?php if (sizeof($courses) === 0): ?>

<p>
    Šiuo metu jokių dalykų neturite.
</p>

<?php endif;?>