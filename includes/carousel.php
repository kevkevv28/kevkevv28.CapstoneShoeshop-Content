<?php

function renderCarousel($id, $tableName, $pdo) {
    $i = 0;
    $statement = $pdo->prepare("SELECT * FROM $tableName");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    echo '<div id="' . $id . '" class="carousel slide" data-bs-ride="carousel">';
    
    // Indicators
    echo '<ol class="carousel-indicators">';
    foreach ($result as $row) {
        echo '<li data-bs-target="#' . $id . '" data-bs-slide-to="' . $i . '"';
        if ($i == 0) echo ' class="active"';
        echo '></li>';
        $i++;
    }
    echo '</ol>';

    // Carousel Items
    echo '<div class="carousel-inner mt-2 mb-3">';
    $i = 0;
    foreach ($result as $row) {
        echo '<div class="carousel-item ';
        if ($i == 0) echo 'active';
        echo '" style="background-image:url(assets/img/' . $row['photo'] . '); background-size: cover; background-repeat: no-repeat; background-position: center;">';

        echo '<div class="bs-slider-overlay"></div>';
        echo '<div class="container"><div class="row">';
        echo '<div class="slide-text ';
        if ($row['position'] == 'Left') echo 'slide_style_left';
        elseif ($row['position'] == 'Center') echo 'slide_style_center';
        elseif ($row['position'] == 'Right') echo 'slide_style_right';
        echo '">';
        echo '<h1 data-animation="animated ';
        if ($row['position'] == 'Left') echo 'zoomInLeft';
        elseif ($row['position'] == 'Center') echo 'flipInX';
        elseif ($row['position'] == 'Right') echo 'zoomInRight';
        echo '" class="text-stroke-slider ">' . $row['heading'] . '</h1>';
        echo '<h4 data-animation="animated ';
        if ($row['position'] == 'Left') echo 'fadeInLeft';
        elseif ($row['position'] == 'Center') echo 'fadeInDown';
        elseif ($row['position'] == 'Right') echo 'fadeInRight';
        echo '" class="text-stroke-slider-b ">' . nl2br($row['content']) . '</h4>';
        echo '<a href="' . $row['button_url'] . '" target="_blank" class="btn btn-primary" data-animation="animated ';
        if ($row['position'] == 'Left') echo 'fadeInLeft';
        elseif ($row['position'] == 'Center') echo 'fadeInDown';
        elseif ($row['position'] == 'Right') echo 'fadeInRight';
        echo '">' . $row['btn_text'] . '</a>';
        echo '</div></div></div></div>';
        $i++;
    }
    echo '</div>';
    echo '<a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#' . $id . '" role="button" data-bs-slide="prev"><i class="fas fa-chevron-left"></i></a>';
    echo '<a class="carousel-control-next text-decoration-none w-auto pe-3" href="#' . $id . '" role="button" data-bs-slide="next"><i class="fas fa-chevron-right"></i></a>';
    echo '</div>';
}




function renderMiddleHeaderAndBestSellers($pdo) {
    // Fetch middle header content
    $statement = $pdo->prepare("SELECT header, content FROM tbl_middle_header LIMIT 1");
    $statement->execute();
    $middleHeader = $statement->fetch(PDO::FETCH_ASSOC);

    // Output the middle header section
    echo '<section class="container py-5">';
    if ($middleHeader) {
        echo '<div class="row text-center pt-3">';
        echo '<div class="col-lg-6 m-auto">';
        echo '<h1 class="h1">' . htmlspecialchars($middleHeader['header']) . '</h1>';
        echo '<p>' . htmlspecialchars($middleHeader['content']) . '</p>';
        echo '</div>';
        echo '</div>';
    }

    // Fetch top 3 best-selling shoes of the current month
    $sql = "
        SELECT sp.id AS shoe_id, sp.product_name AS name, sp.product_img_name AS image, SUM(so.shoe_quantity) AS total_sales
        FROM shoes_order AS so
        INNER JOIN shoeproduct AS sp ON so.shoes_id = sp.id
        WHERE MONTH(so.order_date) = MONTH(CURRENT_DATE()) AND YEAR(so.order_date) = YEAR(CURRENT_DATE())
        GROUP BY sp.id
        ORDER BY total_sales DESC
        LIMIT 3
    ";
    $shoes = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    // Output the best-selling shoes section
    echo '<div class="row">';
    $i = 0;
    foreach ($shoes as $shoe) {
       echo '<div class="col-12 col-md-4 p-5 ' . ($i == 1 ? 'mt-n3' : 'mt-5') . '">';

        echo '<a href="product_single.php?prodid=' . $shoe['shoe_id'] . '">';
        echo '<img src="assets/shoesphotos/'. htmlspecialchars($shoe['image']) .'" class="rounded-circle img-fluid border fixed-image-month">';

        echo '</a>';
        echo '<h5 class="text-center mt-3 mb-3">' . htmlspecialchars($shoe['name']) . '</h5>';
        echo '<p class="text-center"><a href="product_single.php?prodid=' . $shoe['shoe_id'] . '" class="btn btn-success">Go Shop</a></p>';
        echo '</div>';
        $i++;
    }
    echo '</div>';
    echo '</section>';
}
