<?php

include ('../connection.php');

$user_id = $_GET['user_id'] ??1;
$item_id = $_GET['item_id'] ??1;
// $seller_id = $_GET['seller_id'] ??1;

$_SESSION["user_id"] = $user_id;
$_SESSION["item_id"] = $item_id;
// $_SESSION["seller_id"] = $seller_id;

$value0 = $_SESSION["user_id"];
$value1 = $_SESSION["item_id"];
// $value2 = $_SESSION["seller_id"];

$findresult1 = mysqli_query($con, "SELECT * FROM user WHERE user_id= '$value0'");

if($res = mysqli_fetch_array($findresult1)){
$id1 = $res['user_id'];
$fullname = $res['fullname'];
$email = $res['email'];
}

$findresult2 = mysqli_query($con, "SELECT * FROM product WHERE item_id= '$value1'");

if($res = mysqli_fetch_array($findresult2)){
$id2 = $res['item_id'];
$seller_id = $res['seller_id'];
$item_name = $res['item_name'];
$item_image = $res['item_image'];   
}

$get_rating = mysqli_query($con, "SELECT * FROM rating WHERE item_id= '$value1'");
$rating = mysqli_num_rows($get_rating);

$rate5 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= '$value1' AND user_rating = 5");
$r5 = mysqli_num_rows($rate5);

$rate4 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= '$value1' AND user_rating = 4");
$r4 = mysqli_num_rows($rate4);

$rate3 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= '$value1' AND user_rating = 3");
$r3 = mysqli_num_rows($rate3);

$rate2 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= '$value1' AND user_rating = 2");
$r2 = mysqli_num_rows($rate2);

$rate1 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= '$value1' AND user_rating = 1");
$r1 = mysqli_num_rows($rate1);

$ave= $r5 + $r4 + $r3 + $r2 + $r1 / 5; 

?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <title>Review & Rating System in PHP & Mysql using Ajax</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container">
        <h5 class="mt-5 mb-5">Logged in as
            <?php echo "<p style='text-decoration:underline;color:#0000FF;font-size:30px;'>" . $fullname . "</p>";?>
        </h5>
        <div class="card">
            <div class="card-header">Sample Product</div>
            <div class="card-body">
                <div class="row">

                    <div class="col-sm-3 mt-2 d-flex align-items-center justify-content-center">
                        <figure style="margin:auto;">
                            <img style="width:150px; height:auto; margin-bottom:10px;" src="../images/cars/<?php echo $item_image; ?>"
                                alt="product" class="img-fluid">
                                
                            <figcaption><p style="text-align:center;font-size:25px;font-weight:bold;"><?php echo $item_name;?><p></figcaption>
                        </figure>
                    </div>

                    <div class="col-sm-3 text-center">
                        <h1 class="text-warning mt-4 mb-4">
                            <b><span id="average_rating"><?php echo round($ave);?></span> / 5</b>
                        </h1>
                        <div class="mb-3">
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                        </div>
                        <h3><span id="total_review"><?php echo $rating;?></span> Review</h3>
                    </div>
                    <div class="col-sm-3">
                        <p>
                        <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_five_star_review"> <?php echo $r5;?></span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style = "width:<?php echo $r5;?>%" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100" id="five_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_four_star_review"><?php echo $r4;?></span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style = "width:<?php echo $r4;?>%" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100" id="four_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_three_star_review"><?php echo $r3;?></span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style = "width:<?php echo $r3;?>%" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100" id="three_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_two_star_review"><?php echo $r2;?></span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style = "width:<?php echo $r2;?>%" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100" id="two_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_one_star_review"><?php echo $r1;?></span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style = "width:<?php echo $r1;?>%" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100" id="one_star_progress"></div>
                        </div>
                        </p>
                    </div>
                    <div class="col-sm-3 text-center">
                        <h3 class="mt-4 mb-3">Write Review Here</h3>
                        <button type="button" name="add_review" id="add_review" class="btn btn-primary">Review</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5" id="review_content"></div>
    </div>
</body>

</html>

<div id="review_modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="text-center mt-2 mb-4">
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                </h4>

                <div class="form-group">
                    <input type="hidden" name="user_id" id="user_id" class="form-control" value="<?php echo $value0; ?>"
                        readonly>
                </div>

                <div class="form-group">
                    <input type="hidden" name="item_id" id="item_id" class="form-control" value="<?php echo $value1; ?>"
                        readonly>
                </div>

                <div class="form-group">
                    <input type="hidden" name="seller_id" id="seller_id" class="form-control"
                        value="<?php echo $seller_id; ?>" readonly>
                </div>

                <div class="form-group">
                    <input type="text" name="user_name" id="user_name" class="form-control"
                        value="<?php echo $fullname; ?>" readonly>
                </div>

                <div class="form-group">
                    <input type="text" name="car_name" id="car_name" class="form-control"
                        value="<?php echo $item_name; ?>" readonly>
                </div>

                <div class="form-group">
                    <textarea name="user_review" id="user_review" class="form-control"
                        placeholder="Type Review Here"></textarea>
                </div>

                <div class="form-group text-center mt-4">
                    <button type="button" class="btn btn-primary" id="save_review">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.progress-label-left {
    float: left;
    margin-right: 0.5em;
    line-height: 1em;
}

.progress-label-right {
    float: right;
    margin-left: 0.3em;
    line-height: 1em;
}

.star-light {
    color: #e9ecef;
}
</style>

<script>
$(document).ready(function() {

    var rating_data = 0;

    $('#add_review').click(function() {

        $('#review_modal').modal('show');

    });

    $(document).on('mouseenter', '.submit_star', function() {

        var rating = $(this).data('rating');

        reset_background();

        for (var count = 1; count <= rating; count++) {

            $('#submit_star_' + count).addClass('text-warning');

        }

    });

    function reset_background() {
        for (var count = 1; count <= 5; count++) {

            $('#submit_star_' + count).addClass('star-light');

            $('#submit_star_' + count).removeClass('text-warning');

        }
    }

    $(document).on('mouseleave', '.submit_star', function() {

        reset_background();

        for (var count = 1; count <= rating_data; count++) {

            $('#submit_star_' + count).removeClass('star-light');

            $('#submit_star_' + count).addClass('text-warning');
        }

    });

    $(document).on('click', '.submit_star', function() {

        rating_data = $(this).data('rating');

    });

    $('#save_review').click(function() {

        var user_id = $('#user_id').val();

        var item_id = $('#item_id').val();

        var seller_id = $('#seller_id').val();

        var car_name = $('#car_name').val();

        var user_name = $('#user_name').val();

        var user_review = $('#user_review').val();

        if (user_review == '') {
            alert("Please Write Your Review");
            return false;
        } else {
            $.ajax({
                url: "submit_rating.php",
                method: "POST",
                data: {
                    rating_data: rating_data,
                    user_id: user_id,
                    item_id: item_id,
                    seller_id: seller_id,
                    car_name: car_name,
                    user_name: user_name,
                    user_review: user_review
                },
                success: function(data) {
                    $('#review_modal').modal('hide');
                    location.reload();
                    load_rating_data();

                    alert(data);
                }
            })
        }

    });

    load_rating_data();

    function load_rating_data() {
        $.ajax({
            url: "submit_rating.php",
            method: "POST",
            data: {
                action: 'load_data'
            },
            dataType: "JSON",
            success: function(data) {
                $('#average_rating').text(data.average_rating);
                $('#total_review').text(data.total_review);

                var count_star = 0;

                $('.main_star').each(function() {
                    count_star++;
                    if (Math.ceil(data.average_rating) >= count_star) {
                        $(this).addClass('text-warning');
                        $(this).addClass('star-light');
                    }
                });

                $('#total_five_star_review').text(data.five_star_review);

                $('#total_four_star_review').text(data.four_star_review);

                $('#total_three_star_review').text(data.three_star_review);

                $('#total_two_star_review').text(data.two_star_review);

                $('#total_one_star_review').text(data.one_star_review);

                $('#five_star_progress').css('width', (data.five_star_review / data.total_review) *
                    100 + '%');

                $('#four_star_progress').css('width', (data.four_star_review / data.total_review) *
                    100 + '%');

                $('#three_star_progress').css('width', (data.three_star_review / data
                    .total_review) * 100 + '%');

                $('#two_star_progress').css('width', (data.two_star_review / data.total_review) *
                    100 + '%');

                $('#one_star_progress').css('width', (data.one_star_review / data.total_review) *
                    100 + '%');

                if (data.review_data.length > 0) {
                    var html = '';

                    for (var count = 0; count < data.review_data.length; count++) {
                        html += '<div class="row mb-3">';

                        html +=
                            '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">' +
                            data.review_data[count].user_name.charAt(0) + '</h3></div></div>';

                        html += '<div class="col-sm-11">';

                        html += '<div class="card">';

                        html += '<div class="card-header"><b>' + data.review_data[count].user_name +
                            '</b></div>';

                        html += '<div class="card-body">';

                        for (var star = 1; star <= 5; star++) {
                            var class_name = '';

                            if (data.review_data[count].rating >= star) {
                                class_name = 'text-warning';
                            } else {
                                class_name = 'star-light';
                            }

                            html += '<i class="fas fa-star ' + class_name + ' mr-1"></i>';
                        }

                        html += '<br />';

                        html += data.review_data[count].user_review;

                        html += '</div>';

                        html += '<div class="card-footer text-right">On ' + data.review_data[count]
                            .datetime + '</div>';

                        html += '</div>';

                        html += '</div>';

                        html += '</div>';
                    }

                    $('#review_content').html(html);
                }
            }
        })
    }

});
</script>