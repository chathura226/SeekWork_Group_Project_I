<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SeekWork</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/newHome.styles.css">
</head>
<body>

<!--styles for search-->
<style>

.centerbox-cont{
    max-width: 620px;
}
    .centerbox {
        position: relative;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        /*width: 676px;*/
        min-height: 52px;
        /*z-index: 2*/
    }

    .centerbox h1 {
        margin-bottom: 25px;
        font-size: 36px;
        font-weight: normal;
        text-align: center;
    }

    .centerbox p.description {
        margin-bottom: 40px;
        text-align: center;
    }

    .description a {
        text-decoration: none;
    }

    .main-input {
        background: #fff;
        height: 50px;
        width: 327px;
        /*color: #a7b1ab;*/
        border: 1px solid #cccccc;
        margin-bottom: 0px;
        border-radius: 4px 0px 0px 4px;
        display: inline-block;
        text-align: left;
        font-size: 16px;
        font-weight: 500;
        padding: 0px 0px 0px 57px;
        font-size: 16px;
        border-right: 0px;
        background: #ffffff url("<?=ROOT?>/assets/images/search.png") 18px 15px no-repeat;
        background-size: 18px 18px;
        float: left;
    }

    .main-location {
        display: none;
    }

    #main-submit {
        background: #3cb13c;
        color: #fff;
        display: inline-block;
        font-size: 19px;
        font-weight: 500;
        text-align: center;
        cursor: pointer;
        margin-bottom: 0px;
        border-radius: 0px 4px 4px 0px;
        width: 141px;
        height: 50px;
        border: 0px;
        padding-top: 0px;
        float: left;
    }

    #main-submit:hover {
        background: #00a221;
        color: #fff !important;
    }

    #main-submit-mobile {
        display: none;
    }



    .main-btn {
        display: inline-block;
        width: 150px;
        height: 50px;
        border: 1px solid #cccccc;
        padding: 0px;
        position: relative;
        float: left;
        border-right: 0px;
        background: #ffffff url("<?=ROOT?>/assets/images/main-bullet.png") 122px 23px no-repeat;
        background-size: 6px 6px;
        cursor: pointer;
    }

    .search-small {
        font-size: 12px;
        margin: 0px;
        color: #9B9B9B;
        position: absolute;
        top: 6px;
        left: 16px;
        display: inline-block;
        width: 80px;
        height: 20px;
        text-align: left;
    }

    .search-large {
        font-size: 16px;
        margin: 0px;
        color: #4A4A4A;
        position: absolute;
        top: 19px;
        left: 16px;
        display: inline-block;
        width: 105px;
        height: 20px;
        font-weight: 900;
        text-align: left;
    }

    .main-form-container {
        height: 50px;
        position: relative;
    }

    ul.search-description {
        width: 150px;
        position: absolute;
        background: #fff;
        right: 143px;
        top: 55px;
        border-radius: 2px;
        padding: 14px 0px;
        border: 1px solid #E5E5E5;
        display: none;
        -webkit-box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.3);
        -moz-box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.3);
        box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.3);
    }

    .search-description li {
        font-size: 16px;
        color: #4A4A4A;
        font-weight: 900;
        padding: 6px 0px;
        display: block;
        padding-left: 16px;
        cursor: pointer;
    }

    .search-description li:hover {
        background: #f8f8f8;
    }

    .category_tabs{
        display: flex;
        background-color: white;
        justify-content: center;
        align-items: center;
        height:auto ;
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 20px;
        padding-right: 20px;
        text-align: center;
        border-bottom: solid thick transparent;

    }

    .category_tabs:hover{
        border-bottom: solid thick var(--primary-color-dark);
        cursor: pointer;
    }


@media screen and (max-width:900px) {

    .centerbox-cont{
        margin: auto;
        max-width: 477px;
    }
    #main-submit{
        width: 477px;
    }


}
</style>
<header>
    <nav class="navbar">
        <a href="<?= ROOT ?>" class="logo">
            <img src="<?= ROOT ?>/assets/images/logo.png" alt="SeekWork Logo">
        </a>
        <ul class="menu-links">
            <span id="close-btn"><svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg></span>
            <li><a href="<?= ROOT ?>">Home</a></li>
            <li><a href="<?= ROOT ?>/tasks"">Explore</a></li>
            <li><a href="<?= ROOT ?>/signup">Signup as a Company</a></li>
            <li><a href="<?= ROOT ?>/login">Login</a></li>
            <li><a href="<?= ROOT ?>/signup">Sign up</a></li>
        </ul>

        <span id="hamburger-btn"><svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg></span>
    </nav>
</header>

<section class="hero-section" style="background-image: url('<?=ROOT?>/assets/images/newHome/hero-img.jpg')">
    <div class="content">
        <h1>
            Find the right task, right away
        </h1>
        <div class="centerbox-cont" ">
            <div class="centerbox">

                <div class="main-form-container">
                    <form id="" class="search-form" method="post">
                        <input type="text" class="main-input main-name" name="searchField" placeholder="Search" onfocus="clearText(this)"
                               onblur="replaceText(this)"/>
                        <input type="text" id="searchType" name="searchType" style="display: none;" />

                        <button onclick="toggleDrop()" type="button" class="main-btn"><p class="search-small">SEARCH BY</p>
                            <p class="search-large">Title</p></button>
                        <ul class="search-description">
                            <li onclick="byValue('title')">By Title</li>
                            <li onclick="byValue('skill')">By Skill</li>
                            <li onclick="byValue('category')">By Category</li>
                        </ul>
                        <input id="main-submit" class="" type="submit" value="Search"/>
                    </form>

                </div>

            </div>
            <button type="button" id="main-submit-mobile">Search</button>
        </div>
        <div class="popular-tag">
            Popular:
            <ul class="tags">
                <li><a href="<?=ROOT?>/tasks/category/1">Design</a></li>
                <li><a href="<?=ROOT?>/tasks/category/2">Web Development</a></li>
                <li><a href="<?=ROOT?>/tasks/category/3">Animation</a></li>
                <li><a href="<?=ROOT?>/tasks/category/43">Marketing</a></li>
                <li><a href="<?=ROOT?>/tasks/category/39">Writing</a></li>
            </ul>
        </div>
    </div>
</section>
</body>

<!--search field-->

<script>
    searchType='title';
    document.getElementById('searchType').value=searchType;

    function toggleDrop(){
        doropM=document.querySelector('.search-description');
        doropM.style.display==='none'?doropM.style.display='block':doropM.style.display='none';
    }
    function byValue(str){
        toggleDrop();
        document.querySelector('.search-large').textContent=str.charAt(0).toUpperCase() + str.slice(1);
        searchType=str;
        document.getElementById('searchType').value=str;
    }

    function categorySearch(id){
        window.location.href = "<?=ROOT?>/tasks/category/"+id;

    }
</script>

<!--showing menu in mobile mode-->
<script>
    const header=document.querySelector("header");
    const hamburgerBtn=document.querySelector("#hamburger-btn");
    const closeBtn=document.querySelector("#close-btn");

    // show/hide menu
    hamburgerBtn.addEventListener("click",()=>{
        header.classList.toggle("show-mobile-menu");
    });

    //close menu
    closeBtn.addEventListener("click",()=>{
        hamburgerBtn.click();
    })
</script>
</html>
