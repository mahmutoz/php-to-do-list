<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
    <link rel="stylesheet" href="css/style.css">
    <title>To Do List</title>
</head>
<body>

<!-- proccess.php dosyasını dahil etme -->
<?php require_once 'connect.php'; ?>
<?php require_once 'proccess.php'; ?>
<?php require_once 'check.php'; ?>


<?php

// Veritabanındaki verileri çağırma
$result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);

?>

<div class="wrap">
    <div class="header">
        <span>Todo List</span>
    </div>
    <div class="wrap-list">
        <div class="add-item">
            <form action="proccess.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="text" autocomplete="off" name="task" value="<?php echo $task; ?>" required placeholder="Enter a task">
                <?php if ( $update == true ): ?>
                    <button type="submit" name="update"><i class="fa fa-pencil-alt"></i>Update</button>
                <?php else: ?>
                    <button type="submit" name="save"><i class="fa fa-plus"></i>Add to task</button>
                <?php endif; ?>
            </form>
        </div>
        <ul class="list">
            <?php while ($row = $result->fetch_assoc()): ?>
            <li>
                <a data-title="Mark as done" href="check.php?switch=<?php echo $row['id'] ?>"></a>
                <div class="inner">
                        <span class="text<?=$row['done'] ? ' done' : '' ?>"><?php echo $row['task']; ?>
                            <time datetime="<?php echo $row['data_time']; ?>">Created: <?php echo $row['data_time']; ?></time>
                        </span>
                    <span class="actions">
                        <a href="index.php?edit=<?php echo $row['id'] ?>" class="edit">
                            <i data-title="edit" class="fa fa-edit"></i>
                        </a>
                        <a href="index.php?delete=<?php echo $row['id']; ?>" class="delete">
                            <i data-title="delete" class="fa fa-trash"></i>
                        </a>
                    </span>
                </div>
            </li>
                <hr class="dots">
            <?php endwhile; ?>
        </ul>
    </div>
</div>

</body>
</html>