<?php
require 'config.php';
require 'header.php';
if(isset($_GET['msg_login'])){
    echo '
    <div class="alert alert-success">
            <p>Login successful</p>
    </div>
';

}
?>
    <div class="container">
        <div class="row">
            <!-- pull all products data from db -->
            <!-- loop  through the data and display -->
            <?php
            $sql = "SELECT * FROM `products`";
            $products = mysqli_query($conn, $sql);
            while($row=  mysqli_fetch_assoc($products)){
                echo "<tr>";
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $time = $row['time_posted'];
                $image = $row['image'];
                require 'card.php';

                // echo "<div class='col-md-3 col-lg-3 col-xl-3'>";
                // 	echo "<div class='card'>";
                // 		 echo "<img src=static/images/$image class='card-img'>";
                // 		 echo "<div class='card-body'>";
                // 		 	echo "<h4>$title</h4>";
                // 		 	echo "<span> Ksh. $price</span>"
                // 		 	echo "<button class='btn btn-info'>View</button>";
                // 		 	echo "<button class='btn btn-info'>Add to cart</button>";
                // 		  echo "</div>";
                // 	 echo "</div>";
                // echo "</div>";


            }



            ?>
        </div>
    </div>





<?php
require 'footer.php';
?>