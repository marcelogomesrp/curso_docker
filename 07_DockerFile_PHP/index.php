<!DOCTYPE html>
<html lang="pt-br">
<?php include 'connection.php';?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Aula</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    
</head>

<body>
    <main class="main">
        <div class="container-fluid">
            <div class="content">
            
                <h1 class="display-3">Aulas do curso de Docker</h1>

                <?php
                $conn = new mysqli($host, $user, $password, $database, $port);

                $query = 'SELECT aula_id, nome, link FROM aula';
                $res = $conn->query($query);
                ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Link</th>                    
                        </tr>
                    </thead>    
                    <tbody>
                    <?php
                    while ($row = $res->fetch_assoc()) { 
                    ?>
                        <tr>
                            <th scope="row"><?php echo $row["aula_id"]; ?></th>
                            <td><?php echo $row["nome"]; ?></td>
                            <td><a href='<?php echo $row["link"]; ?> '> <?php echo $row["link"]; ?> </a> </td>
                        </tr>                
                    <?php
                    }        
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>
