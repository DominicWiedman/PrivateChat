<template>
    <div class="card card-default chat-box">
        <div class="card-header">
            <b :class="{'text-danger':session_block}">
                {{friend.name}}
                <span v-if="session_block">(Blocked)</span>
            </b>
            <!-- Close Button -->
            <a href="" @click.prevent="close">
                <i class="fa fa-times float-right" aria-hidden="true"></i>
            </a>
            <!-- Close Button ends -->
            <!-- Options -->
            <div class="float-right mr-xl-4">
                <a href="" class="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <button class="dropdown-item" type="button" v-if="session_block" @click.prevent="unblock">UnBlock</button>
                    <button class="dropdown-item" type="button" v-else @click.prevent="block">Block</button>
                    <button class="dropdown-item" type="button" @click.prevent="clear">Clear Chat</button>
                </div>
            </div>
            <!-- Options ends-->
        </div>
        <div class="card-body" v-chat-scroll>
            <p class="card-text" :class="{'text-right': chat.type == 0, 'text-success':chat.read_at != null}" v-for="chat in chats" :key="chat.id">{{chat.message}}
                <br>
                <span style="font-size: 8px">{{chat.read_at}}</span>
            </p>
            <br>
        </div>
        <form class="card-footer" @submit.prevent="send">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Write your message here..." :disabled="session_block" v-model="message">
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props:['friend'],
        data(){
            return {
                chats:[],
                message:[],
                session_block:false
            }
        },
        methods:{
            send(){
                if (this.message){
                    this.pushToChats(this.message);
                    axios.post(`send/${this.friend.session.id}`, {
                        letter : this.message,
                        to_user : this.friend.id,
                    }).then(res => (this.chats[this.chats.length -1].id = res.data));
                    this.message = null;
                }
            },
            pushToChats(message){
                this.chats.push({ message:message, type:0, read_at:null, sent_at:'Just Now' });
            },
            close(){
                this.$emit('close');
            },
            clear(){
                axios.post(`session/${this.friend.session.id}/clear`).then(res => (this.chats =[]))
            },
            block(){
                this.session_block = true
            },
            unblock(){
                this.session_block = false
            },
            getAllMessages(){
                axios
                    .post(`session/${this.friend.session.id}/chats`)
                    .then(res => (this.chats = res.data.data));
            },
            read(){
                axios.post(`session/${this.friend.session.id}/read`)
            }
        },
        created(){
            this.read();
            this.getAllMessages();

            Echo.private(`Chat.${this.friend.session.id}`).listen('PrivateChatEvent', e => {
                    this.read();
                    this.chats.push({ message: e.letter, type:1, sent_at:'Just Now' });
                }
            );

            Echo.private(`Chat.${this.friend.session.id}`).listen('MsgReadEvent', e =>
                this.chats.forEach(
                    chat => (chat.id == e.chat.id ? (chat.read_at = e.chat.read_at):'')
                )
            );
        }
    }
</script>

<style>
.chat-box{
    height: 400px;
}
.card-body{
    overflow-y: scroll;
}
</style>
