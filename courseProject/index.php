<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course-Project</title>
</head>

<body>

    <main class="container mt-4">
        <h1>Team Roster</h1>

        <form action="process.php" method="post" class="mt-3">
            <label class="form-label" for="first_name">First Name</label>
            <input class="form-control" type="text" id="first_name" name="first_name">

            <label class="form-label mt-3" for="last_name">Last Name</label>
            <input class="form-control" type="text" id="last_name" name="last_name">

            <label class="form-label mt-3" for="email">Email Address</label>
            <input class="form-control" type="email" id="email" name="email">

            <label class="form-label mt-3" for="position">Position</label>
            <input class="form-control" type="text" id="position" name="position">

            <label class="form-label mt-3" for="phone">Phone Number</label>
            <input class="form-control" type="tel" id="phone" name="phone">

            <button class="btn btn-primary mt-4" type="submit">Add to Roster</button>
        </form>

        <p class="mt-4">
            <a href="roster.php">View Roster</a>
        </p>
    </main>
</body>

</html>