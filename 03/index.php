<?php
/* What's the Problem? 
    - PHP logic + HTML in one file
    - Works, but not scalable
    - Repetition will become a problem

    How can we refactor this code so it’s easier to maintain?
*/

$items = ["Home", "About", "Contact"];



 include 'header.html'; 
?>
    <ul>
        <?php foreach ($items as $item): ?>
            <li><?= $item ?></li>
        <?php endforeach; ?>
    </ul>

<?php include 'footer.html'; ?>

/*
In this lab I learned how to effectively separate PHP logic from HTML structure by using includes for header and footer files to make 
repetive stuctures easier ro manage.
*/