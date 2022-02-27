<?php $__env->startSection('content'); ?>
    <div class="products-con1 ask-qus-wrap d-flex">
        <div class="chat-wrap">
            <div class="welcome-chat text-center">
                <p>Welcome to Sortiment LiveChat. Please choose one of<br> the following questions or write your own</p>
            </div><!-- Welcome chat -->

            <div class="chat-content" id="chat-content">
                <ul class="chats" id="chat-body">
                    <li>
                        <span class="default-msg">This is an auto question</span>
                    </li>
                    <li>
                        <span class="default-msg">I need help with my products</span>
                    </li>
                    <?php $__currentLoopData = $chats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($chat->sender == 'admin'): ?>
                            <li class="admin-user">
                                <img src="<?php echo e(asset($admin->profile_photo_path)); ?>" class="user-img" alt="" width="50">
                                <span class="msg-cotainer">
                                    <?php if($chat->attachment == 1): ?>
                                        <img src="<?php echo e($chat->message); ?>" alt="chat-attachment" class="chat-attachment">
                                    <?php else: ?>
                                        <?php echo e($chat->message); ?>

                                    <?php endif; ?>
                                    <small class="msg-time">
                                        <?php
                                            $date = new \DateTime();
                                            $today = $date->format('Y-m-d');
                                            $yesterday = $date->sub(new DateInterval('P1D'))->format('Y-m-d');

                                            $msg_date = date('Y-m-d', strtotime($chat->datetime));
                                            $msg_time = date('g:i A', strtotime($chat->datetime));
                                        ?>
                                        <?php if($today == $msg_date): ?>
                                            <?php echo e($msg_time); ?>, Today
                                        <?php elseif($yesterday == $msg_date): ?>
                                            <?php echo e($msg_time); ?>, Yesterday
                                        <?php else: ?>
                                            <?php echo e($msg_date); ?>, <?php echo e($msg_time); ?>

                                        <?php endif; ?>
                                    </small>
                                </span>
                            </li>
                        <?php else: ?>
                            <li class="employee-user">
                                <img src="<?php echo e(asset($user->profile_photo_path)); ?>" class="user-img" alt="" width="50">
                                <span class="msg-cotainer">
                                    <?php if($chat->attachment == 1): ?>
                                        <img src="<?php echo e($chat->message); ?>" alt="chat-attachment" class="chat-attachment">
                                    <?php else: ?>
                                        <?php echo e($chat->message); ?>

                                    <?php endif; ?>
                                    <small class="msg-time-received">
                                        <?php
                                            $date = new \DateTime();
                                            $today = $date->format('Y-m-d');
                                            $yesterday = $date->sub(new DateInterval('P1D'))->format('Y-m-d');

                                            $msg_date = date('Y-m-d', strtotime($chat->datetime));
                                            $msg_time = date('g:i A', strtotime($chat->datetime));
                                        ?>
                                        <?php if($today == $msg_date): ?>
                                            <?php echo e($msg_time); ?>, Today
                                        <?php elseif($yesterday == $msg_date): ?>
                                            <?php echo e($msg_time); ?>, Yesterday
                                        <?php else: ?>
                                            <?php echo e($msg_date); ?>, <?php echo e($msg_time); ?>

                                        <?php endif; ?>
                                    </small>
                                </span>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                </ul>
            </div><!-- Chat content -->
            <div class="chat-foot" id="chat-foot">
                <div action="" class=" d-flex justify-content-between">
                    <input type="text" class="form-control" placeholder="Write your message here" id="chatInput">
                    <a onclick="sendAttachment()" class="btn btn-blue attach-file"><i class="fas fa-images"></i></a>
                    <button type="button" class="btn btn-blue send-msg-btn" id="send-button">Send message <i class="fas fa-paper-plane"></i></button>
                </div>
            </div><!-- Chat footer -->
        </div><!-- Chat box container -->
        <div class="right-product-col text-center">
            <h4>Your products</h4>
                <div class="product-item shadow-box text-center">
                    <span class="badge-default pending">Pending approval</span>
                    <a href="#" class="product-img"><img src="<?php echo e(asset('frontend/assets/img/product-img01.png')); ?>" alt="Product"></a>
                    <h5><a href="#">Name of product</a></h5>
                    <p class="price">Price from: 500 DKK</p>
                </div><!-- Product item -->
                <div class="product-item shadow-box text-center">
                    <span class="badge-default approved">Approved</span>
                    <a href="#" class="product-img"><img src="<?php echo e(asset('frontend/assets/img/product-img02.png')); ?>" alt="Product"></a>
                    <h5><a href="#">Name of product</a></h5>
                    <p class="price">Price from: 500 DKK</p>
                </div><!-- Product item -->
                <div class="product-item shadow-box text-center">
                    <span class="badge-default">Ordered</span>
                    <a href="#" class="product-img"><img src="<?php echo e(asset('frontend/assets/img/product-img04.png')); ?>" alt="Product"></a>
                    <h5><a href="#">Name of product</a></h5>
                    <p class="price">Price from: 500 DKK</p>
                </div><!-- Product item -->
        </div><!-- Right product col -->
    </div><!-- Ask question wrapper -->
    <script src="https://cdn.socket.io/4.0.1/socket.io.min.js" integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU" crossorigin="anonymous"></script>
    <script src="<?php echo e(asset('backend/js/datetime.js')); ?>"></script>
    <script type="text/javascript">
        (() => {
            let ip_address = "<?php echo e(env('APP_HOST')); ?>";
            let socket_port = "<?php echo e(env('APP_PORT')); ?>";
            let socket = io(ip_address + ':' + socket_port);
            let chatInput = document.getElementById('chatInput');

            chatInput.addEventListener('keypress', function(e) {

                let message = chatInput.value;

                if (message.trim().length) {
                    if(e.which === 13 && !e.shiftKey) {
                        e.preventDefault();
                        sendMessage(message)
                        return false;
                    }
                }
            });

            sendMessage = (message, attachment = 0) => {
                let userel = document.querySelector('[chat-user-id].active');
                let messageObj = {
                    message: message,
                    attachment: attachment,
                    admin_id: <?php echo e($admin->id); ?>,
                    employee_id: <?php echo e($employee->id); ?>,
                    sender: 'user'
                };

                socket.emit('sendChatToServerAdminAndEmployee', messageObj);

                let chat_body = document.getElementById('chat-body');
                let chat_element = document.createElement('li');
                chat_element.setAttribute('class', 'employee-user');
                let msg_html = '';

                msg_html += '<img src="<?php echo e(asset($employee->profile_photo_path)); ?>" class="user-img" alt="" width="50">';
                msg_html += '<span class="msg-cotainer">' + messageObj.message;

                let message_date = new Date();
                let datetime = formatTime(message_date) + ', Today';

                msg_html += '     <small class="msg-time">' + datetime + '</small>';

                msg_html += '</span>'
                // attachment section
                chat_element.innerHTML = msg_html;

                chat_body.appendChild(chat_element);
                chatInput.value = '';
                chat_body.scrollTop = 10000;
            }

            socket.on('sendChatToClientAdminAndEmployee', (msgArr) => {
                for (let c in msgArr) {
                    let chat = msgArr[c];
                    console.log('user received message', chat);
                    if (chat.user_id == <?php echo e($employee->id); ?> && chat.admin_id == <?php echo e($admin->id); ?>) {
                        let chat_body = document.getElementById('chat-body');
                        let chat_element = document.createElement('li');
                        chat_element.setAttribute('class', 'admin-user');
                        let msg_html = '';

                        msg_html += '<img src="<?php echo e(asset($admin->profile_photo_path)); ?>" class="user-img" alt="" width="50">';
                        msg_html += '<span class="msg-cotainer">'
                        if (chat.attachment == 1) {
                            msg_html += '<img src="' + chat.message + '" alt="chat-attachment" class="chat-attachment">';
                        } else {
                            msg_html += chat.message;
                        }

                        let message_date = new Date(chat.datetime);
                        let datetime = chat.datetime;

                        if (isToday(message_date)) {
                            datetime = formatTime(message_date) + ', Today';
                        } else if (isYesterday(message_date)) {
                            datetime = formatTime(message_date) + ', Yesterday';
                        } else {
                            datetime = formatDateTime(message_date);
                        }

                        msg_html += '        <small class="msg-time-received">' + datetime + '</small>';

                        msg_html += '</span>'
                        // attachment section
                        chat_element.innerHTML = msg_html;

                        chat_body.appendChild(chat_element);
                        chat_body.scrollTop = 10000;
                    }
                }
            });

            // set chat box bottom position
            document.querySelector('ul.chats').scrollTop = 10000;
        })();

        let send_button = document.getElementById('send-button');
        send_button.addEventListener('click', () => {
            let chatInput = document.getElementById('chatInput');
            console.log(chatInput.value);
            if (chatInput.value.trim() != '') {
                sendMessage(chatInput.value);
            }
        });


        sendAttachment = () => {
            let chat_foot = document.querySelector('#chat-foot');
            if (document.querySelector('#attachment-file')) {
                chat_foot.removeChild(document.querySelector('#attachment-file'));
            }

            let input = document.createElement('input');
            input.type = 'file';
            input.id = 'attachment-file';
            input.classList.add('d-none');
            input.accept = 'image/*';
            chat_foot.appendChild(input);
            document.querySelector('#attachment-file').click();
            document.querySelector('#attachment-file').addEventListener('change', (event) => {
                const file = event.target.files[0];
                const reader = new FileReader();
                reader.onloadend = () => {
                    sendMessage(reader.result, 1);
                };
                reader.readAsDataURL(file);
            })
        };
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('employee.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/employee/ask-question-form.blade.php ENDPATH**/ ?>