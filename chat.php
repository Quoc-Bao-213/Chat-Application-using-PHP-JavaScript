<?php include_once 'header.php'; ?>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="https://via.placeholder.com/150" alt="">
                <div class="details">
                    <span>Coder Cyrus</span>
                    <p>Active now</p>
                </div>
            </header>
            <div class="chat-box">
                <div class="chat outgoing">
                    <div class="details">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, quasi!</p>
                    </div>
                </div>
                <div class="chat incoming">
                    <img src="https://via.placeholder.com/150" alt="">
                    <div class="details">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, quasi!</p>
                    </div>
                </div>
            </div>
            <form action="#" class="typing-area">
                <input type="text" class="incoming_id" name="incoming_id" value="" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>
</body>

</html>