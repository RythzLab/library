
<!DOCTYPE html>
<html>
<head>
	<title>multi-user role-based-login-system</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<!-- <body>
</body> -->

    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <div class="container-fluid">
            <!-- <a class="navbar-brand" href="javascript:void(0)">National Library</a> -->
            <a class="navbar-brand" href="./home.php">National Library</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./home.php">Home</a>
                    </li>
                </ul>
                <form class="d-flex" action="./search_books.php" method="post">
                    <input class="form-control me-2" type="text" name="search" id="search" placeholder="Type book, author, desc...">
                    <button class="btn btn-info me-4" type="submit">Search</button>
                    <a href="logout.php" class="btn btn-dark">Logout</a>
                </form>
            </div>
        </div>
    </nav>
</html>
