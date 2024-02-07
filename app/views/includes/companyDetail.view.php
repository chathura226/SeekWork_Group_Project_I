<div class="comp-details c-s-8 c-e-13">
    <h2>About the company</h2>
    <div class="comp-img">
        <img src="<?= ROOT ?><?= (!empty($profilePic)) ? "/" . $profilePic : "/assets/images/noImage.png" ?>" alt="Profile Picture">
    </div>
    <h3><?= ucfirst($companyName) ?> <small>(2000 tasks)</small></h3>
    <?php $this->view('includes/stars', ['nStars'=>$final_rating,'nReviews'=>$nReviews]) ?>


    Company Description : <?= $description ?></br>
    Location : <?= ucfirst($address) ?></br>
    <?php if (!empty($website)) echo "Website : " . $website; ?></br>
    Joined Date: <?= $createdAt ?></br>

</div>