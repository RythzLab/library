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
    if(isset($_POST['searchbycard'])){
        // echo '<script>alert("Searching....")</script>';
    
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $card_search_string = test_input($_POST['searchbycard']);

        if (empty($card_search_string)) {
            // echo $card_search_string;
            $sql = "SELECT BOOKTITLE, CATEGORY, AUTHORNAME, m.FIRSTNAME, ec.CID FROM books b, emp_book_card_relation ec, members m WHERE b.ISBN = ec.ISBN AND m.cid = ec.cid";
            $res = mysqli_query($conn, $sql);

            if (mysqli_num_rows($res) > 0) {?>
                <h4 class="display-4 fs-3 m-3 mt-4">Books by Card - (Count: <?php echo mysqli_num_rows($res) ?>)</h4>
                <table class="table m-3" ><!-- style="width: 32rem;"> -->
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">TITLE</th>
                            <th scope="col">CATEGORY</th>
                            <th scope="col">AUTHOR</th>
                            <th scope="col">FIRST NAME</th>
                            <th scope="col">CARD ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                            while ($rows = mysqli_fetch_assoc($res)) {?>
                                <tr>
                                    <th scope="row"><?=$i?></th>
                                    <td><?=$rows['BOOKTITLE']?></td>
                                    <td><?=$rows['CATEGORY']?></td>
                                    <td><?=$rows['AUTHORNAME']?></td>
                                    <td><?=$rows['FIRSTNAME']?></td>
                                    <td><?=$rows['CID']?></td>
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
            <h4 class="display-4 fs-5 m-3 mt-4 text-primary">Your search keyword: <strong><?=$card_search_string ?></strong></h4>
            <?php
            $sql = "SELECT BOOKTITLE, CATEGORY, AUTHORNAME, m.FIRSTNAME, ec.CID FROM books b, emp_book_card_relation ec, members m 
                WHERE b.ISBN = ec.ISBN AND m.cid = ec.cid AND ec.CID = (SELECT cid FROM card WHERE cid = $card_search_string)";
            $res = mysqli_query($conn, $sql);

            if (mysqli_num_rows($res) > 0) {?>
                <h4 class="display-4 fs-4 m-3 mt-2 text-secondary">Books by Card - (Count: <?php echo mysqli_num_rows($res) ?>)</h4>
                <table class="table m-3" ><!-- style="width: 32rem;"> -->
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">TITLE</th>
                            <th scope="col">CATEGORY</th>
                            <th scope="col">AUTHOR</th>
                            <th scope="col">FIRST NAME</th>
                            <th scope="col">CARD ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                            while ($rows = mysqli_fetch_assoc($res)) {?>
                                <tr>
                                    <th scope="row"><?=$i?></th>
                                    <td><?=$rows['BOOKTITLE']?></td>
                                    <td><?=$rows['CATEGORY']?></td>
                                    <td><?=$rows['AUTHORNAME']?></td>
                                    <td><?=$rows['FIRSTNAME']?></td>
                                    <td><?=$rows['CID']?></td>
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
