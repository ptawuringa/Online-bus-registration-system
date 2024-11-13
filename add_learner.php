<?php include 'header.php'; ?>

<div class="container mt-5">
    <h2>Add Learner</h2>
    <form action="process_add_learner.php" method="POST">
        <div class="form-group">
            <label for="learner_name">Learner's Name</label>
            <input type="text" class="form-control" id="learner_name" name="learner_name" required>
        </div>
        <div class="form-group">
            <label for="grade_level">Grade Level</label>
            <input type="text" class="form-control" id="grade_level" name="grade_level">
        </div>
        <button type="submit" class="btn btn-primary">Add Learner</button>
    </form>
</div>

<?php include 'footer.php'; ?>
