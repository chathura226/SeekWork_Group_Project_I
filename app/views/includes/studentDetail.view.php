<div class="comp-details c-s-8 c-e-13">
    <h2>About the Student</h2>
    <div class="comp-img">
        <img src="<?= ROOT ?><?= (!empty($profilePic)) ? "/" . $profilePic : "/assets/images/noImage.png" ?>" alt="Profile Picture">
    </div>
    <h3><?=ucfirst($firstName)." ".ucfirst($lastName)?> <small>( 10 tasks )</small></h3>
    <?php $this->view('includes/stars', ['nStars'=>$final_rating,'nReviews'=>$nReviews]) ?>

    University : <?=$university->universityName?></br>
    <?php if(!empty($description)):?>Description : <?=ucfirst($description)?><?php endif;?></br>

</div>