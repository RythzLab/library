<?php 
   session_start();
   include "db_conn.php";
   include "navbar.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
	<!-- <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh"> -->
	<div class="container mt-5">
		<!-- <form class="border shadow p-4 rounded" action="" method=""> -->
      	<?php if ($_SESSION['role'] == 'admin') {?>
      		<!-- FOR ADMIN -->
			<div class="row mb-4">
				<!-- <div class="col-sm-11"> -->
					<div class="card bg-info text-white">
					<!-- <img src="img/admin-default.png" 
						class="card-img-top" 
						alt="admin image"> -->
						<div class="card-body ">
							<!-- text-center -->
							<h4 class="card-title">
								<?=$_SESSION['name']?>
							</h4>
							<h5 class="card-title text-secondary">
								Role: <?php if($_SESSION['role'] == "admin") echo "Admin"; else echo ""; ?>
							</h5>
						</div>
					<!-- <div class="card-body text-center">
						<a href="" class="btn btn-primary">Logout</a>
					</div> -->
					</div>
				<!-- </div> -->
			</div>
			<!-- <div class="p-3"> -->

			<form class="d-flex col-sm-5" action="./search_books_by_card.php" method="post">
				<input class="form-control me-2" type="text" name="searchbycard" id="searchbycard" placeholder="Type Card ID...">
				<button class="btn btn-primary btn-block col-sm-3" type="submit">Search</button>
			</form>



			<div class="row mt-4">
				<div class="col-sm-4 card me-0">
					<?php include './members.php';
					if (mysqli_num_rows($res) > 0) {?>
					
						<h4 class="display-4 fs-3 mt-2">All Users - (Count: <?php echo mysqli_num_rows($res) ?>)</h4>
						<table class="table" ><!-- style="width: 32rem;"> -->
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Name</th>
									<th scope="col">Username</th>
									<th scope="col">Role</th>
								</tr>
							</thead>
							<tbody>
								<?php $i =1;
									while ($rows = mysqli_fetch_assoc($res)) {?>
										<tr>
											<th scope="row"><?=$i?></th>
											<td><?=$rows['name']?></td>
											<td><?=$rows['username']?></td>
											<td><?=$rows['role']?></td>
										</tr>
								<?php $i++; }?>
							</tbody>
						</table>
					<?php }?>
				</div>


				<div class="col-sm-8 card">
					<?php include './overdue.php';
					if (mysqli_num_rows($res_books_overdue) > 0) {?>
					
					<h4 class="display-4 fs-3 mt-2">Books Overdue - (Count: <?php echo mysqli_num_rows($res_books_overdue) ?>)</h4>
					<table class="table" ><!-- style="width: 32rem;"> -->
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">EMP NO</th>
								<th scope="col">CARD ID</th>
								<th scope="col">ISBN</th>
								<th scope="col">PID</th>
								<th scope="col">ISSUED</th>
								<th scope="col">RETURNED</th>
								<!-- <th scope="col">RETURN_FLAG</th> -->
							</tr>
						</thead>
						<tbody>
							<?php $i =1;
								while ($rows = mysqli_fetch_assoc($res_books_overdue)) {?>
									<tr>
										<th scope="row"><?=$i?></th>
										<td><?=$rows['EMPNO']?></td>
										<td><?=$rows['CID']?></td>
										<td><?=$rows['ISBN']?></td>
										<td><?=$rows['PID']?></td>
										<td><?=$rows['ISSUEDATE']?></td>
										<td><?=$rows['RETURNDATE']?></td>
										<!-- <td><?=$rows['RETURN_FLAG']?></td> -->
									</tr>
							<?php $i++; }?>
						</tbody>
					</table>
					<?php }?>
				</div>
			</div>





      	<?php }else { ?>
      		<!-- FOR MEMBERS -->
      		<div class="card" style="width: 10rem;">
			  <img src="img/user-default.png" 
			       class="card-img-top" 
			       alt="admin image">
			  <div class="card-body text-center">
			    <h5 class="card-title">
			    	<?=$_SESSION['name']?>
			    </h5>
			    <a href="logout.php" class="btn btn-dark">Logout</a>
			  </div>
			</div>
      	<?php } ?>
		<!-- </form> -->
	</div>
</body>
</html>
<?php }else{
	header("Location: index.php");
} ?>