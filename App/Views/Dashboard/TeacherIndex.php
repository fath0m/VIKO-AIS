<h1>
    Dėstomi dalykai
</h1>

<div class="list-group mt-4">
    <?php foreach ($courses as $course): ?>
    <a href="/Teacher/Courses/<?php echo $course->id; ?>" class="list-group-item list-group-item-action">
        <?php echo $course->name; ?>
    </a>

    <?php endforeach;?>
</div>