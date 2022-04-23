<?php 
   session_start();
   include "db_conn.php";
   include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12 card">

<?php
if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
    if(isset($_POST['search'])){
        // echo '<script>alert("Searching....")</script>';
    
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $book_search_string = test_input($_POST['search']);

        if (empty($book_search_string)) {
            $sql = "SELECT * FROM books";
            $res = mysqli_query($conn, $sql);

            if (mysqli_num_rows($res) > 0) {?>
                <h4 class="display-4 fs-3 m-3 mt-4">All Books - (Count: <?php echo mysqli_num_rows($res) ?>)</h4>
                <table class="table m-3" ><!-- style="width: 32rem;"> -->
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">TITLE</th>
                            <th scope="col">DESC</th>
                            <th scope="col">AUTHOR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                            while ($rows = mysqli_fetch_assoc($res)) {?>
                                <tr>
                                    <th scope="row"><?=$i?></th>
                                    <td><?=$rows['BOOKTITLE']?></td>
                                    <td><?=$rows['BOOKDESC']?></td>
                                    <td><?=$rows['AUTHORNAME']?></td>
                                </tr>
                        <?php $i++; }?>
                    </tbody>
                </table>
            <?php }
            else{?>
                <h4 class="display-4 fs-3 mt-2">All Users - (Count: 0)</h4>
                <p>No Book Found</p>
            <?php }
        }
        else{?>
            <h4 class="display-4 fs-5 mt-3 text-primary">Your search keyword: <strong><?=$book_search_string ?></strong></h4>
            <?php
            $sql = "SELECT * FROM books WHERE CONCAT_WS(BOOKTITLE, BOOKDESC, AUTHORNAME) like '%$book_search_string%'";
            $res = mysqli_query($conn, $sql);

            if (mysqli_num_rows($res) > 0) {?>
                <h4 class="display-4 fs-4 mt-2 text-secondary">Books matching your search - (Count: <?php echo mysqli_num_rows($res) ?>)</h4>
                <table class="table mt-3" ><!-- style="width: 32rem;"> -->
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">TITLE</th>
                            <th scope="col">DESC</th>
                            <th scope="col">AUTHOR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                            while ($rows = mysqli_fetch_assoc($res)) {?>
                                <tr>
                                    <th scope="row"><?=$i?></th>
                                    <td><?=$rows['BOOKTITLE']?></td>
                                    <td><?=$rows['BOOKDESC']?></td>
                                    <td><?=$rows['AUTHORNAME']?></td>
                                </tr>
                        <?php $i++; }?>
                    </tbody>
                </table>
            <?php }
            else{?>
                <h4 class="display-4 fs-3 mt-2">All Users - (Count: 0)</h4>
                <p>No Book Found</p>
            <?php }
        }
    }
}else{
	header("Location: index.php");
}
?>
        </div>
    </div>
</div>
</body>
</html>
