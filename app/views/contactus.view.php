<?php $this->view('includes/header', $data) ?>
<?php $this->view('includes/nav', $data) ?>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/warning.styles.css">

<style>
    .contactus-card {
        background-color: #fff;
        border-radius: 10px;
        padding: 30px !important;
        width: 80%;
        display: flex;
        flex-direction: column;
        margin: auto;
        margin-top:30px;
    }

    .title {
        font-size: 30px;
        font-weight: 600;
        text-align: center;
    }

    .contactus {
        margin-top: 20px;
        display: flex;
        flex-direction: column;
    }

    .group {
        position: relative;
    }

    .contactus .group label {
        font-size: 16px;
        color: rgb(99, 102, 102);
        position: absolute;
        top: -10px;
        left: 10px;
        background-color: #fff;
        transition: all .3s ease;
    }

    .contactus .group input,
    .contactus .group textarea {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid rgba(0, 0, 0, 0.2);
        margin-bottom: 20px;
        outline: 0;
        width: 100%;
        background-color: transparent;
    }

    .contactus .group input:placeholder-shown+ label, .contactus .group textarea:placeholder-shown +label {
        top: 10px;
        background-color: transparent;
    }

    .contactus .group input:focus,
    .contactus .group textarea:focus {
        border-color: var(--primary-color);
    }

    .contactus .group input:focus+ label, .contactus .group textarea:focus +label {
        top: -10px;
        left: 10px;
        background-color: #fff;
        color: var(--primary-color);
        font-weight: 600;
        font-size: 16px;
    }

    .contactus .group textarea {
        resize: none;
        height: 100px;
    }

    .contactus button {
        background-color: var(--primary-color);
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .contactus button:hover {
        background-color: var(--primary-color);
    }


</style>

    <div class="contactus-card c-s-1 c-e-13">
        <h1 class="title">We are here to help...</h1><br>
        <span style="font-size: 1.2em;">Share the most important info with us. We will get back to you as soon as possible!</span><br>
        <div class="warning">
            <div class="warning__icon">
                <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m13 14h-2v-5h2zm0 4h-2v-2h2zm-12 3h22l-11-19z" fill="#393a37"></path></svg>
            </div>
            <div class="warning__title">Do not share sensitive information. Ex. Your credit card details or personal ID numbers.</div>
<!--            <div class="warning__close"><svg height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="m15.8333 5.34166-1.175-1.175-4.6583 4.65834-4.65833-4.65834-1.175 1.175 4.65833 4.65834-4.65833 4.6583 1.175 1.175 4.65833-4.6583 4.6583 4.6583 1.175-1.175-4.6583-4.6583z" fill="#393a37"></path></svg></div>-->
        </div>
        <form class="contactus" method="post">
            <div class="group">
                <input placeholder="" type="text" required="" id="name" name="name">
                <label for="name">Name</label>
            </div>
            <div class="group">
                <input placeholder="" type="email" id="email" name="email" required="">
                <label for="email">Email</label>
            </div>
            <div class="group">
                <input placeholder="" type="text" id="subject" name="subject" required="">
                <label for="subject">Subject</label>
            </div>
            <div class="group">
                <textarea placeholder="" id="comment" name="comment" rows="5" required=""></textarea>
                <label for="comment">Describe your problem...</label>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>

<?php $this->view("includes/footer", $data);
