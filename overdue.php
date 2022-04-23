<?php  

if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
    
    $sql = "select * from emp_book_card_relation where return_flag = 'F' and date_format(str_to_date(RETURNDATE,'%d/%m/%Y'),'%d-%m-%Y') < Date(Now())";
    $res_books_overdue = mysqli_query($conn, $sql);
}else{
	header("Location: index.php");
} 