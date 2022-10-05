<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment section</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 style="text-align:center ; font-weight:bold; font-size: 2rem">Comment section</h1>


<?php if(session()->has('info')): ?>
    <div class="alert alert-success col-8" style="margin: auto;" role="alert">
        <?php echo session('info') ?>
    </div> 
<?php endif; ?>

<?php if(session()->has('errors')): ?>
    <div class="alert alert-danger col-8" style="margin: auto;" role="alert">
        <?php $errors = session('errors'); ?>
            <ul>
                <?php foreach($errors as $error): ?>
                    <li><?= $error;  ?></li>
                <?php endforeach; ?>
            </ul>
    </div> 
<?php endif; ?>


<?php 
$NumberOfComments = 0;
$AvarageRating = 0.0;
$Ratings = [];
$SumOfRatings = 0;
?>

<?php foreach($comments as $comment): ?>

    <?php $NumberOfComments += 1; ?>

    <?php array_push($Ratings, $comment['rating']); ?>

<?php endforeach; ?>


<?php foreach($Ratings as $Rating):?> 

    <?php $SumOfRatings += $Rating; ?>

<?php endforeach; ?>

<?php
if( $NumberOfComments !== 0 ) 
{
    $AvarageRating = $SumOfRatings / $NumberOfComments;

    $AvarageRating = number_format($AvarageRating, 1, ',', '');
}

if( $NumberOfComments == 0 ) 
{
    $AvarageRating = 0;
}

?>


    <div class="container">
        <div class="row">
            <div class="mx-auto">
            <?= form_open(current_url(), ['method' => 'post']) ?>

                <div style="text-align:center">
                    <label style="text-align:center ; font-size:2rem ; " for="rating" class="form-label">Rating</label>

                    <input style="margin:auto" name="rating" class="rating" max="5" oninput="this.style.setProperty('--value', this.value)"
                     step="1" style="--value:3" type="range"> 
                </div>
            <p style="text-align:center; white-space:pre;">All: <?= $NumberOfComments ?>  , Avarage: <?= $AvarageRating; ?></p>

                <div>
                    <div class="form-group col-lg-6" style="margin:auto;display: flex">
                        <?= form_label('Name : ' , 'username', ['for' => 'username' , 'style' => 'font-weight: bold'])  ?>
                        <input type="text" class="form-control" name="username">
                    </div>
                </div>

                <div>
                    <div class="form-group col-lg-6" style="margin: 0.5rem auto;display: flex">
                        <?= form_label('Comment : ' , 'comment', ['for' => 'comment' , 'style' => 'font-weight: bold'])  ?>
                        <input type="text" class="form-control" name="comment">
                    </div>
                </div>


                <?= form_submit('submit', 'Submit', ['class' => 'btn btn-primary btn-lg col-4 d-flex justify-content-center' , 'style' => 'margin: 2rem auto']) ?>
                
            <?= form_close(); ?>

        </div>
        </div>
        <?php foreach($comments as $comment): ?>
            <table class="table">
                <tbody>

                        <tr>
                            <td style="width:7rem">Rating: </td>
                            <td> 
                            
                            <input name="rating" class="rating" max="5" oninput="this.style.setProperty('--value', this.value)"
                     step="1" style="--value:<?php echo esc($comment['rating']); ?>  " type="range" > 
                            
                            </td>
                        </tr>
                        <tr>
                            <td>Name: </td>
                            <td><?php echo esc($comment['username']); ?></td>
                        </tr>
                        <tr>
                            <td>Comment: </td>
                            <td><?php echo esc($comment['comment']); ?></td>
                        </tr>
                        <tr>
                            <td>Date: </td>
                            <td><?php echo esc($comment['created_at']); ?></td>
                        </tr>
                </tbody>
            </table>     
        <?php endforeach; ?>
    </div>
</body>
</html>