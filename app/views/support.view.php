
<?php $this->view('includes/header',$data) ?>
<?php $this->view('includes/nav',$data) ?>
<style>


    h1 {
        margin: 50px 0 30px;
        text-align: center;
    }

    .faq-container {
        margin: 0 auto;
        max-width: 600px;
    }

    .faq {
        background-color: transparent;
        border: 1px solid #9fa4a8;
        border-radius: 10px;
        margin: 20px 0;
        overflow: hidden;
        padding: 30px;
        position: relative;
        transition: 0.3s ease;
    }

    .faq.active {
        background-color: #fff;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1), 0 3px 6px rgba(0, 0, 0, 0.1);
    }

    .faq.active::before,
    .faq.active::after {
        color: #2ecc71;
        content: "\f075";
        font-size: 7rem;
        left: 20px;
        opacity: 0.2;
        position: absolute;
        top: 20px;
        z-index: 0;
    }

    .faq.active::before {
        color: #3498db;
        left: -30px;
        top: -10px;
        transform: rotateY(180deg);
    }

    .faq-title {
        margin: 0 35px 0 0;
    }

    .faq-text {
        display: none;
        margin: 30px 0 0;
    }

    .faq.active .faq-text {
        display: block;
    }

    .faq-toggle {
        align-items: center;
        background-color: transparent;
        border: 0;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        font-size: 1rem;
        height: 30px;
        justify-content: center;
        padding: 0;
        position: absolute;
        right: 30px;
        top: 30px;
        width: 30px;
    }
    .faq-toggle .fa-times,
    .faq.active .faq-toggle .fa-chevron-down {
        display: none;
    }

    .faq.active .faq-toggle .fa-times {
        color: #fff;
        display: block;
    }

    .faq-toggle .fa-chevron-down {
        display: block;
    }

    .faq.active .faq-toggle {
        background-color: #9fa4a8;
    }
    .chevron-down {
        display: inline-block;
        width: 10px;
        height: 10px;
        border-top: 1px solid black;
        border-right: 1px solid black;
        transform: rotate(45deg);
        cursor: pointer;
        transition: transform 0.2s ease-in-out;
    }

    /*.chevron-down:hover {*/
    /*    transform: rotate(135deg); !* Rotate on hover *!*/
    /*}*/




</style>
<div class="c-s-2 c-e-12">
    <h1>Frequently Asked Questions</h1>
    <div class="faq-container">
        <div class="faq active">
            <h3 class="faq-title">Why shouldn't we trust atoms?</h3>
            <p class="faq-text">They make up everything</p>
            <button class="faq-toggle" onclick="toggleFaq(event)">
                <span class="chevron-down"></span>
<!--                <span class="times"></span>-->
            </button>
        </div>
        <div class="faq">
            <h3 class="faq-title">Why shouldn't we trust atoms?</h3>
            <p class="faq-text">They make up everything</p>
            <button class="faq-toggle" onclick="toggleFaq(event)">
                <span class="chevron-down"></span>
                <!--                <span class="times"></span>-->
            </button>
        </div>
    </div>
</div>

<script>
    let faqs=document.querySelectorAll(".faq");
    function toggleFaq(e){
        console.log(e.currentTarget.parentElement)

        if(e.currentTarget.parentElement.classList.contains("active")) {
            faqs.forEach(item => {
                if(item.classList.contains("active")) item.classList.remove("active");
            })
        }else{
            faqs.forEach(item => {
                if(item.classList.contains("active")) item.classList.remove("active");
            })
            e.currentTarget.parentElement.classList.add("active");
        }
    }
</script>

<?php $this->view("includes/footer",$data);
