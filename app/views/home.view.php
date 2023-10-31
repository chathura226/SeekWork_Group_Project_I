<?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/navForHome',$data) ?>
<link href="<?=ROOT?>/assets/css/home.styles.css" rel="stylesheet">
<section class="c-s-1 c-e-13 r-s-1">
		<img src="<?=ROOT?>/assets/images/home/stars.png" alt="stars" id="stars">
		<img src="<?=ROOT?>/assets/images/home/moon.png" alt="moon" id="moon">
		<!-- <img src="<?=ROOT?>/assets/images/home/mountains_behind.png" alt="mountains_behind" id="mountains_behind"> -->
		<h2 id="text">SeekWork</h2>
		<a href="<?=ROOT?>/tasks" id="btn">Explore</a>
		<img src="<?=ROOT?>/assets/images/home/mountains_front.png" alt="mountains_front" id="mountains_front">

	</section>

	<div class="sec c-s-1 c-e-13" id="sec">
		<h2>Who are we?</h2><br>
		 <p>Welcome to SeekWork, your gateway to a world of opportunities for undergraduate freelancers! 
			We understand the unique needs and talents of students, and that's why we've created a specialized 
			freelancing platform just for you. Whether you're looking to gain real-world experience, earn extra income, 
			or showcase your skills to potential employers, SeekWork is here to support you every step of the way.
			<br>
			<br>
			Our platform connects talented undergraduate students with a diverse range of freelance gigs and projects, 
			spanning various fields and industries. From graphic design to content creation, web development to social 
			media marketing, there's a freelance opportunity waiting for you here.
			<br>
			<br>
			At SeekWork, we believe that your academic journey should be complemented by practical, hands-on experiences 
			that help you build a strong portfolio and network with professionals in your field. With user-friendly features 
			and a supportive community, you can find projects that align with your interests and skills.
			<br>
			<br>
			So, whether you're a budding artist, tech whiz, wordsmith, or marketer, SeekWork is your key to turning your 
			talents into opportunities. Join our community today and embark on a freelancing adventure designed exclusively 
			for undergraduates. Start your journey to success with us!
			<br>
			<br>
		</p>
	</div>
    <div class="sec2 c-s-1 c-e-7 ">
        <img src="<?=ROOT?>/assets/images/home/smiling.png" >
    </div>
    <div class="sec2-text c-s-7 c-e-13">
        <h2>The best part?</h2>
        &#x2714; Skill Development <br>
        &#x2714; Portfolio Building <br>
        &#x2714; Real-World Experience <br>
        &#x2714; Flexibility <br>
        &#x2714; Location Independence <br>
        &#x2714; Income Generation <br>
    </div>
	<script>
		let stars=document.getElementById("stars");
		let moon=document.getElementById("moon");
		// let mountains_behind=document.getElementById("mountains_behind");
		let mountains_front=document.getElementById("mountains_front");
		let text=document.getElementById("text");
		let btn=document.getElementById("btn");
		let header = document.querySelector('header')
		window.addEventListener('scroll',function(){
			let value=window.scrollY;
			stars.style.left=value * 0.5+'px';
			moon.style.top=value * 1.05 +'px';
			// mountains_behind.style.top=value * 0.5 +'px';
			mountains_front.style.top=value * 0 +'px';
			text.style.marginRight=value *4 +'px';
			text.style.marginTop=value *1.5 +'px';
			btn.style.marginTop=value *1.5 +'px';
			header.style.top=value*0.5+'px';
		})
	</script>


</div>
<footer>





    <div class="container">
        <div class="row">
            <div class="footer-col">
                <h4>Categories</h4>
                <ul>
                    <li><a href="#">Graphics & Design</a></li>
                    <li><a href="#">Writing & Translation</a></li>
                    <li><a href="#">Video & Animation</a></li>
                    <li><a href="#">Logo Design</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Get Support</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Help & Safety</a></li>
                    <li><a href="#">Guides</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Learn</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Community</h4>
                <ul>
                    <li><a href="#">Forum</a></li>
                    <li><a href="#">Events</a></li>
                    <li><a href="#">Affiliates</a></li>
                    <li><a href="#">Success Stories</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>About Us</h4>
                <div class="social-links">

                    <!-- facebook -->
                    <a href="#"><svg height="1.1em" viewBox="0 0 512 512" class="svg-social">
                        <style>svg{fill:#ffffff}</style>
                        <path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/>
                    </svg></a>
                    
                    <!-- twitter x -->
                    <a href="#"><svg height="1.1em" viewBox="0 0 512 512" class="svg-social">
                        <style>svg{fill:#ffffff}</style>
                        <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                    </svg></a>

                    <!-- insta -->
                    <a href="#"><svg height="1.1em" viewBox="0 0 448 512" class="svg-social">
                        <style>svg{fill:#ffffff}</style>
                        <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/>
                    </svg></a>

                    <!-- tiktok -->
                    <a href="#"><svg height="1.1em" viewBox="0 0 448 512" class="svg-social">
                        <style>svg{fill:#ffffff}</style>
                        <path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/>
                    </svg></a>

                </div>
            </div>
        </div>
    </div>
</footer>


<script src="<?=ROOT?>/assets/js/alert.js"></script>

<script src="<?=ROOT?>/assets/js/loader.js"></script>
</body>
</html>