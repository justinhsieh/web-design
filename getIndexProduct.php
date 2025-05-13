<?php 
    include'config.php';

    $result = $conn->query('SELECT * FROM product ORDER BY pid LIMIT 3');
    $html = '';
    while($row = $result->fetch_assoc()){
        $html .= '
        <div class="col-12 col-md-4 card" style="width: 18rem;">
            <a href="#"><img src="'.$row['pic'].'" class="card-img-top"></a>
            <div class="card-body text-center">
              <h5 class="card-title fw-bold">'.$row['name'].'</h5>
            </div>
        </div>';
    }

    echo $html;
    $conn->close();
?>