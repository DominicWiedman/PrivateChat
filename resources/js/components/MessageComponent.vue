<template>
    <div class="card card-default">
        <div class="card-header">Chats</div>
        <div class="card-body chat-box" v-chat-scroll>
            <p class="card-text" v-for="chat in chats" :key="chat.message">{{chat.message}}</p>
        </div>
        <form class="card-footer" @submit.prevent="send">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Write your message here...">
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                chats:[]
            }
        },
        methods:{
            send(){
                console.log('hello')
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
