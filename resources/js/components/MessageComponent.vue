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
            <p class="card-text" v-for="chat in chats" :key="chat.message">{{chat.message}}</p>
        </div>
        <form class="card-footer" @submit.prevent="send">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Write your message here..." :disabled="session_block">
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
                session_block:false
            }
        },
        methods:{
            send(){
                console.log('hello')
            },
            close(){
                this.$emit('close');
            },
            clear(){
                this.chats = []
            },
            block(){
                this.session_block = true
            },
            unblock(){
                this.session_block = false
            }
        },
        created(){
            this.chats.push(
                {message:'heyy'},
                {message:'How are you?'},
                {message:'how u dopisdn?'},
                {message:'how u dopsisdn?'},
                {message:'how u doosdin?'},
                {message:'how u doisdin?'},
                {message:'how u diosdin?'},
                {message:'how u deuoin?'},
                {message:'how u d1oyin?'},
                {message:'how u dto23in?'},
                {message:'how u dt3oin?'},
                {message:'how u dto54in?'},
                {message:'how u dtosi5n?'},
                {message:'how u dtoi5n?'},
                {message:'Bottom'},
                )
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
