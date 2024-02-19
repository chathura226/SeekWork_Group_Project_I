<?php $this->view('includes/header', $data) ?>
<?php $this->view('includes/nav', $data) ?>
    <style>
        .contactButton {
            margin: auto;
            background: var(--primary-color);
            color: white;
            font-family: inherit;
            padding: 0.5em;
            padding-left: 1.2em;
            font-size: 18px;
            font-weight: 600;
            border-radius: 1em;
            border: none;
            letter-spacing: 0.05em;
            display: flex;
            align-items: center;
            box-shadow: inset 0 0 1.8em -0.7em #2e8b57;
            overflow: hidden;
            position: relative;
            height: 3em;
            padding-right: 3.5em;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .iconButton {
            margin-left: 1.2em;
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 2.4em;
            width: 2.4em;
            border-radius: 1.2em;
            box-shadow: 0.15em 0.15em 0.8em 0.3em #32cd32;
            right: 0.4em;
            transition: all 0.3s;
        }

        .contactButton:hover {
            transform: translate(-0.05em, -0.05em);
            box-shadow: 0.2em 0.2em #228b22;
        }

        .contactButton:active {
            transform: translate(0.05em, 0.05em);
            box-shadow: 0.1em 0.1em #228b22;
        }

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
            content: "FAQ";
            font-size: 4rem;
            right: 60px;
            opacity: 0.2;
            position: absolute;
            top: 8px;
            z-index: 0;
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
            <div class="faq">
                <h3 class="faq-title">How do I create an account?</h3>
                <p class="faq-text">Creating an account is easy! Just click the "Sign Up" button and fill out the form
                    with
                    your basic information.</p>
                <button class="faq-toggle" onclick="toggleFaq(event)">
                    <span class="chevron-down"></span>
                </button>
            </div>
            <div class="faq">
                <h3 class="faq-title">What information do I need to provide on my profile?
                </h3>
                <p class="faq-text">To attract companies, showcase your skills and experience by including a compelling
                    bio,
                    relevant past projects in your portfolio, and your education and certifications.</p>
                <button class="faq-toggle" onclick="toggleFaq(event)">
                    <span class="chevron-down"></span>
                </button>
            </div>
            <div class="faq">
                <h3 class="faq-title">How do I search for projects?</h3>
                <p class="faq-text">Use our advanced search filters to find projects matching your skills, budget.
                    Browse
                    open project tasks and actively submit proposals to relevant ones.</p>
                <button class="faq-toggle" onclick="toggleFaq(event)">
                    <span class="chevron-down"></span>
                </button>
            </div>
            <div class="faq">
                <h3 class="faq-title">What should I include in my proposal?</h3>
                <p class="faq-text">Highlight your relevant skills and experience, address the companies's specific
                    needs,
                    and propose a clear scope of work and timeline with competitive rates.</p>
                <button class="faq-toggle" onclick="toggleFaq(event)">
                    <span class="chevron-down"></span>
                </button>
            </div>
            <div class="faq">
                <h3 class="faq-title">How do I get paid and what are the payment methods available?</h3>
                <p class="faq-text">Our secure payment system ensures safe and timely transactions. Choose your
                    preferred
                    payment method upon project completion.</p>
                <button class="faq-toggle" onclick="toggleFaq(event)">
                    <span class="chevron-down"></span>
                </button>
            </div>
            <div class="faq"">
                <h3 class="faq-title">How do I report a problem with a client or project?</h3>
                <p class="faq-text">Our dedicated support team is here to help. Use the "Disputes" feature within the
                    platform for prompt assistance.</p>
                                                                                                                                                                                                                                                        <button class="faq-toggle" onclick="toggleFaq(event)">
                    <span class="chevron-down"></span>
                </button>
            </div>
            <div class="faq">
                <h3 class="faq-title">What are the challenges of freelancing?</h3>
                <p class="faq-text">Market yourself effectively, manage your time efficiently, and be prepared for
                    potential
                    project fluctuations.</p>
                <button class="faq-toggle" onclick="toggleFaq(event)">
                    <span class="chevron-down"></span>
                </button>
            </div>
            <div class="faq">
                <h3 class="faq-title">How can I stay motivated and productive as a freelancer?</h3>
                <p class="faq-text">Set realistic goals, create a dedicated workspace, network with other freelancers,
                    and
                    celebrate your achievements.</p>
                <button class="faq-toggle" onclick="toggleFaq(event)">
                    <span class="chevron-down"></span>
                </button>
            </div>
        </div>
    </div>

    <div class="c-s-1 c-e-13" style="background-color: white;display: flex;justify-content:center;">

        <div><h1>Can't find what you're looking for?</h1>
            <h2 style="color: grey;margin: auto;text-align: center;">We can help you!</h2>
            <a href="<?=ROOT?>/support/help" style="text-decoration: none;cursor: pointer;">
            <button class="contactButton" style="cursor: pointer;">
                Contact Us
                <div class="iconButton">
                    <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                              fill="currentColor"></path>
                    </svg>
                </div>
            </button>
            </a>
        </div>
        <div>
            <img src="<?=ROOT?>/assets/images/help.jpg" alt="help" style="width:500px;">

        </div>
    </div>

    <script>
        let faqs = document.querySelectorAll(".faq");

        function toggleFaq(e) {
            console.log(e.currentTarget.parentElement)

            if (e.currentTarget.parentElement.classList.contains("active")) {
                faqs.forEach(item => {
                    if (item.classList.contains("active")) {
                        console.log("dcsd")
                        console.log(item.querySelector('.chevron-down'))
                        console.log("dcsd")

                        item.querySelector('.chevron-down').style.transform = "rotate(45deg)"
                        item.classList.remove("active");
                    }
                })
            } else {
                faqs.forEach(item => {
                    if (item.classList.contains("active")) {
                        item.classList.remove("active");
                        item.querySelector('.chevron-down').style.transform = "rotate(45deg)"

                    };

                })
                e.currentTarget.parentElement.classList.add("active");
                e.currentTarget.parentElement.querySelector('.chevron-down').style.transform = "rotate(135deg)"

            }
        }
    </script>

<?php $this->view("includes/footer", $data);
