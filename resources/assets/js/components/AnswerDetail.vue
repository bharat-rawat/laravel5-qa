<script>
    export default{
        props: ['answer'],
        data (){
            return {
                editing: false,
                body: this.answer.body,
                body_html:this.answer.body_html,
                questionId:this.answer.question_id,
                answerId:this.answer.id,
                bodyCatch:null,
            }
        },
        methods:{
            edit (){
                this.bodyCatch = this.body;
                this.editing = true;
            },
            cancel (){
                this.body = this.bodyCatch;
                this.editing = false;
            },
            update (){
                axios.patch('/question/'+this.questionId+'/answer/'+this.answerId,{
                    body: this.body,
                })
                .then(res =>{
                    console.log(res);
                    this.body_html=res.data.body;
                    this.editing=false;
                })
                .catch(err =>{
                    console.log('something wrong');
                    
                });
            },
        },
    }
    
</script>