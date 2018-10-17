<template>
    <div class="input-group message-sender-input">
        <span class="input-group-btn">
            <span class="btn btn-success upload_file" title="upload file" type="button" @click="chooseFile"><i class="fa fa-file"></i></span>
        </span>
        <input type="file" @change="onFlieChange" id="file">
        <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage"> 
        <span class="input-group-btn">
            <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
                Send
            </button>
        </span>
    </div> 
</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                newMessage: '', 
                type:4,
                allowedExtensions:['pdf','jpg','jpeg','png','zip','mp4'] 
            }
        },

        methods: {
            sendMessage() {
                let time = moment().format('YYYY-MM-DD HH:mm:ss');
                let data = {message:this.newMessage,type:1};
                if(this.newMessage != "") {

                    this.$emit('messagesent', {
                        user: this.user,
                        message: this.newMessage,
                        time:time, 
                        type:'1',
                    });
                }

                this.newMessage = ''
            }   
    }
</script>
