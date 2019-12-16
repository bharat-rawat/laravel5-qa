<template>
    <div>
        <p class="text-muted">{{postDate}}</p>
        <div class="media">
            <!-- <a  :href="user.url" -->
            <a  href="#" 
                class="pr-2">
                <!-- <img :src="user.avatar" alt="img"> -->
                <img src="#" alt="img">
            </a>
            <div class="media-body">
                <!-- <a :href="user.url">{{user.name}}</a> -->
                <a href="#">{{model.id}}</a>
        
            </div>
        </div>
    </div>
</template>
<script>
export default{
    // when we use this component somwhere, it will recive data from outside
    // props can be an array/object
    // usage ==> <user-info model="some_model" label="some_label"></user-info>
    props: ['model','label'],
    computed: {
                postDate (){
                    return this.label +" "+ this.model.created_date;
                },
    },
    data (){
        return {
            user:this.model.user,
        }
    }
}
</script>