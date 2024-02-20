<div class="comp-details c-s-8 c-e-13">
    <?php if(!empty($assigned)):?>
        <h2>About the Assigned Student</h2>
    <?php else:?>
        <h2>About the Student</h2>
    <?php endif;?>
    <div class="comp-img">
        <img src="<?= ROOT ?><?= (!empty($profilePic)) ? "/" . $profilePic : "/assets/images/noImage.png" ?>" alt="Profile Picture">
    </div>
    <style>
        .linkForStudent:visited{
            color: var(--secondary-color);
        }

        .rateNew .half:before{
            display: none;
        }
    </style>
    <h3><a class="linkForStudent" style="text-decoration: none;" href="<?=ROOT?>/<?=Auth::getrole()?>/viewstudents/<?=$studentID?>"><?=ucfirst($firstName)." ".ucfirst($lastName)?> <?=($nTasks==0)?'<svg width="30px" style="fill: black !important;" fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 37.4 37.4" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M33.917,18.7l2.268-3.492c0.438-0.678,0.551-1.518,0.302-2.287c-0.25-0.768-0.833-1.383-1.587-1.674l-3.888-1.492 l-0.22-4.158c-0.043-0.807-0.446-1.551-1.101-2.024c-0.653-0.476-1.486-0.629-2.269-0.42l-4.021,1.075L20.78,0.993 C20.273,0.365,19.508,0,18.699,0c-0.808,0-1.571,0.365-2.082,0.992l-2.621,3.235L9.975,3.152c-0.778-0.207-1.613-0.056-2.268,0.42 C7.054,4.048,6.649,4.793,6.606,5.598L6.388,9.754l-3.887,1.492c-0.754,0.291-1.337,0.906-1.587,1.674 c-0.25,0.771-0.139,1.609,0.302,2.287L3.482,18.7l-2.267,3.492c-0.439,0.678-0.551,1.518-0.302,2.284 c0.25,0.771,0.833,1.386,1.587,1.675l3.887,1.491l0.219,4.158c0.042,0.81,0.447,1.553,1.101,2.026 c0.654,0.476,1.487,0.631,2.269,0.42l4.021-1.075l2.621,3.233c0.509,0.63,1.273,0.995,2.082,0.995s1.572-0.365,2.082-0.994 l2.621-3.232l4.021,1.074c0.778,0.211,1.612,0.057,2.269-0.42c0.653-0.477,1.058-1.219,1.102-2.025l0.219-4.158l3.888-1.492 c0.754-0.289,1.337-0.904,1.587-1.674c0.249-0.77,0.138-1.607-0.302-2.285L33.917,18.7z M10.067,22.717l-0.776-3.099 c-0.216-0.858-0.426-1.895-0.533-2.836l-0.04,0.012c-0.273,1.062-0.593,2.191-0.99,3.503l-0.733,2.42H5.326l2.436-8.032h2.121 l0.775,2.943c0.221,0.847,0.394,1.847,0.477,2.753h0.036c0.202-1.062,0.495-2.146,0.859-3.349l0.712-2.348h1.668l-2.435,8.031 h-1.908V22.717z M20.491,16.173h-3.134l-0.505,1.67h2.955l-0.448,1.477h-2.956l-0.578,1.904h3.301l-0.451,1.49h-5.124l2.435-8.031 h4.958L20.491,16.173z M27.566,22.717h-1.966l0.368-3.455c0.091-0.812,0.188-1.562,0.37-2.479h-0.023 c-0.416,0.904-0.779,1.668-1.217,2.479l-1.811,3.455H21.3l0.527-8.032h1.942l-0.396,3.313c-0.11,0.953-0.258,1.99-0.372,2.801 h0.023c0.395-0.869,0.877-1.834,1.38-2.823l1.676-3.289h1.931l-0.382,3.385c-0.107,0.939-0.237,1.799-0.389,2.691h0.022 c0.391-0.895,0.854-1.834,1.312-2.788l1.651-3.289h1.848L27.566,22.717z"></path> </g> </g></svg>':'<small>('.$nTasks.' tasks)</small>'?></a></h3>
    <?php $this->view('includes/stars', ['nStars'=>$final_rating,'nReviews'=>$nReviews]) ?>

    University : <?=$university->universityName?></br>
    <?php if(!empty($description)):?>Description : <?=ucfirst($description)?><?php endif;?></br>
    <div class="btn-container" style="margin: 0;padding: 0;">
        <div class="btn-effect" style="margin: 0;padding: 0;">
            <a style="font-size:15px;background-color:black;padding: 5px 0px;width:155px" class="effect" href="<?=ROOT?>/<?=Auth::getrole()?>/chats/<?=$userID?>" title="Contact"><svg xmlns="http://www.w3.org/2000/svg" fill="white" height="1em" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M208 352c114.9 0 208-78.8 208-176S322.9 0 208 0S0 78.8 0 176c0 38.6 14.7 74.3 39.6 103.4c-3.5 9.4-8.7 17.7-14.2 24.7c-4.8 6.2-9.7 11-13.3 14.3c-1.8 1.6-3.3 2.9-4.3 3.7c-.5 .4-.9 .7-1.1 .8l-.2 .2 0 0 0 0C1 327.2-1.4 334.4 .8 340.9S9.1 352 16 352c21.8 0 43.8-5.6 62.1-12.5c9.2-3.5 17.8-7.4 25.3-11.4C134.1 343.3 169.8 352 208 352zM448 176c0 112.3-99.1 196.9-216.5 207C255.8 457.4 336.4 512 432 512c38.2 0 73.9-8.7 104.7-23.9c7.5 4 16 7.9 25.2 11.4c18.3 6.9 40.3 12.5 62.1 12.5c6.9 0 13.1-4.5 15.2-11.1c2.1-6.6-.2-13.8-5.8-17.9l0 0 0 0-.2-.2c-.2-.2-.6-.4-1.1-.8c-1-.8-2.5-2-4.3-3.7c-3.6-3.3-8.5-8.1-13.3-14.3c-5.5-7-10.7-15.4-14.2-24.7c24.9-29 39.6-64.7 39.6-103.4c0-92.8-84.9-168.9-192.6-175.5c.4 5.1 .6 10.3 .6 15.5z"/></svg>
                Chat Now </a>
        </div>

    </div>
</div>