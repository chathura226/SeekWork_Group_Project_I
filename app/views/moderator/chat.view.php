
<?php $this->view('moderator/moderator-header',$data) ?>
    <link href="<?=ROOT?>/assets/css/chats.styles.css" rel="stylesheet">

    <div class="pagetitle column-12">
        <h1>Chats</h1>
        <nav>

            <ul class="breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="<?=ROOT?>" class="breadcrumbs__link">Home</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="<?=ROOT?>/<?=Auth::getrole()?>" class="breadcrumbs__link">Dashboard</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="#" class="breadcrumbs__link breadcrumbs__link--active">Chats</a>
                </li>
            </ul>
        </nav>
    </div><!-- End Page Title -->


    <div class="chatbox-container c-s-1 c-e-13 ">

        <?php $this->view('includes/chat',$data) ?>

    </div>

<?php $this->view('moderator/moderator-footer',$data) ?>
