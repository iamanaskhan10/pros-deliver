<script src="<?php echo e(asset('assets/frontend/js/pusher.min.js')); ?>"></script>

<script>
    class LiveChat {
        pusher;
        channel;
        logEnable;
        appCluster;
        appKey;
        appUrl;

        constructor() {
            this.appKey ="<?php echo e(env('PUSHER_APP_KEY')); ?>";
            this.appCluster ="<?php echo e(env('PUSHER_APP_CLUSTER')); ?>";
            this.appUrl ="<?php echo e(env('APP_URL')); ?>";
            this.pusher = this.createInstance();
            this.channel = null;
        }

        createInstance(){
            this.pusher = null;
            return new Pusher(this.appKey, {
                cluster: this.appCluster,
                channelAuthorization: { endpoint: `${this.appUrl}/broadcasting/auth` }
            });
        }

        enableLog(){
            Pusher.logToConsole = true;
        }

        createChannel(client_id, freelancer_id, type) {
            if(type === 'client')
                this.channel = this.pusher.subscribe(`private-livechat-freelancer-channel.${client_id}.${freelancer_id}`);
            else
                this.channel = this.pusher.subscribe(`private-livechat-client-channel.${freelancer_id}.${client_id}`);
        }

        removeChannel(client_id, freelancer_id, type){
            if(type === 'client')
                this.channel = this.pusher.unsubscribe(`private-livechat-freelancer-channel.${client_id}.${freelancer_id}`);
            else
                this.channel = this.pusher.unsubscribe(`private-livechat-client-channel.${freelancer_id}.${client_id}`);
        }

        bindEvent(eventName, callback) {
            this.channel.bind(eventName, callback);
        }

        //user push notification
        createNotificationChannel(user_id) {
            this.notificationChannel = this.pusher.subscribe(`project-private-notifications-${user_id}`);
            this.notificationChannel.bind('App\\Events\\UserNotificationEvent', function(data) {

                // stop execution if chatbox is open
                if (isChatboxOpen() && isPageVisible) {
                    notification_sound();
                    $(".navbar-right-notification").load(location.href + " .navbar-right-notification");
                    return;
                } else {
                    toastr_notification_js(data.message);
                    notification_sound();
                    $(".navbar-right-notification").load(location.href + " .navbar-right-notification");
                    $(".reload_unseen_message_count").load(location.href + " .reload_unseen_message_count");
                }
            });
        }
    }
</script>

<script>
    // Global variables
    let isPageVisible = true;
    // Document Ready Handler - Entry point
    document.addEventListener("DOMContentLoaded", function() {
        document.addEventListener("visibilitychange", function() {
            isPageVisible = !document.hidden;
        });
    });

    // check for mobile device
    function isMobile() {
        return /Android|iPhone|iPad|iPod/i.test(navigator.userAgent);
    }

    function isChatboxOpen() {
        let chatbox = document.querySelector(".chat-wrapper-details");
        if (!chatbox) {
            return false;
        }
        let style = window.getComputedStyle(chatbox);
        return style.display !== "none" && style.visibility !== "hidden" && style.opacity !== "0";
    }

    function notification_sound() {
        let audio = new Audio("<?php echo e(asset('assets/uploads/chat_image/sound/facebook_chat.mp3')); ?>");

        audio.play().then(() => {
        }).catch(error => {
            // Add an event listener to wait for a user interaction
            document.body.addEventListener("click", function playAudio() {
                audio.play();
                document.body.removeEventListener("click", playAudio);
            }, { once: true });
        });
    }

    // TOASTR NOTIFICATION FUNCTION
    function toastr_notification_js(msg) {
        Command: toastr["warning"](msg, "<?php echo e(__('New Notification!')); ?>")
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    }
</script>
<?php /**PATH /home/prosdeliver/public_html/core/Modules/Chat/Resources/views/components/livechat-js.blade.php ENDPATH**/ ?>