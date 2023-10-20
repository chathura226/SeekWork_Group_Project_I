<?php $this->view('company/company-header',$data) ?>
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
            <a href="<?=ROOT?>/<?=Auth::getrole()?>/chats" class="breadcrumbs__link">Chats</a>
          </li>
          <li class="breadcrumbs__item">
            <a href="#" class="breadcrumbs__link breadcrumbs__link--active">Chat with PLACEHOLDER FOR STUDENT NAME</a>
          </li>
        </ul>
      </nav>
</div><!-- End Page Title -->


<div class="chatbox-container column-12 r-s-2">
    <div class="chat-box">
      <!-- client -->
      <div class="client">
        <img src="<?=ROOT?>/assets/images/profile1.png" alt="logo" />
        <div class="client-info">
          <h2>Chathura Lakshan</h2>
          <p>online</p>
        </div>
      </div>
      <div class="chats">
        <div class="client-chat">Hi!</div>
        <div class="my-chat">Hi</div>
        <div class="client-chat">How can i help you?</div>
        <div class="my-chat">How can i make payments?</div>
        <div class="client-chat">Watch the whole tutorial on "How to make payments"</div>
        <div class="client-chat">Hi!</div>
        <div class="my-chat">Hi</div>
        <div class="client-chat">How can i help you?</div>
        <div class="my-chat">How can i make payments?</div>
        <div class="client-chat">Watch the whole tutorial on "How to make payments"</div>
        
        <div class="client-chat">Hi!</div>
        <div class="my-chat">Hi</div>
        <div class="client-chat">How can i help you?</div>
        <div class="my-chat">How can i make payments?</div>
        <div class="client-chat">Watch the whole tutorial on "How to make payments"</div>
        <div class="client-chat">Hi!</div>
        <div class="my-chat">Hi</div>
        <div class="client-chat">How can i help you?</div>
        <div class="my-chat">How can i make payments?</div>
        <div class="client-chat">Watch the whole tutorial on "How to make payments"</div>
        
        <div class="client-chat">Hi!</div>
        <div class="my-chat">Hi</div>
        <div class="client-chat">How can i help you?</div>
        <div class="my-chat">How can i make payments?</div>
        <div class="client-chat">Watch the whole tutorial on "How to make payments"</div>
        <div class="client-chat">Hi!</div>
        <div class="my-chat">Hi</div>
        <div class="client-chat">How can i help you?</div>
        <div class="my-chat">How can i make payments?</div>
        <div class="client-chat">Watch the whole tutorial on "How to make payments"</div>
        
      </div>


      <!-- input field for chat-box -->
      <div class="chat-input">
        <input type="text" placeholder="Enter the message.."/>
        <button class="send-button">
          <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
            <path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480V396.4c0-4 1.5-7.8 4.2-10.7L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"/>
          </svg>
        </button>
      </div>
    </div>
  </div>



<?php $this->view('company/company-footer',$data) ?>
