
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link rel="stylesheet" href="app.css">
<script src="https://kit.fontawesome.com/8cb6cb1095.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<?php
include("header.php");
require("connections.php");
$rs = $conn->query('SELECT * FROM userdata ');
for ($i = 0; $i < $rs->columnCount(); $i++) {
    $col = $rs->getColumnMeta($i);
    $columns[] = $col['name'];
}
?>
<br>
<br>
<br>
<table class="table table-bordered w-75">
    <thead class="thead-dark">
<tr>
    <?php
foreach($columns as $column){
?> <th scope="col">  <?php  echo $column; ?> </th>
<?php }?>
</tr>
</thead>
    <tbody>
<?php
foreach($rs as $value){
    ?>
<tr>       
           <th scope="row"><?php echo $value ['id']; ?> </th>
		   <td><?php echo $value ['FullName']; ?></td>
		   <td><?php echo $value ['UserName']; ?></td>
		   <td><?php echo $value ['UserEmail']; ?></td>
		   <td><?php echo $value ['UserMobileNumber']; ?></td>  
           <td><?php echo $value ['LoginPassword']; ?></td>  
           <td><?php echo $value ['RegDate']; ?></td> 
           <td>
           <button type="button" class="btn btn-primary"><i class="far fa-eye"></i></button>
              <button type="button" class="btn btn-success"><i class="fas fa-edit"></i></button>
            <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
            </td> 				   				   				  
    </tr>
    </tbody>
<?php
}
?>

<table>
</div>

</body>
</html>

