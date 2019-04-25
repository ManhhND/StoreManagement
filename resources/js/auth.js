
export default {
    checkToken(){
        let token = localStorage.getItem('token');
        if(token == null){
            this.$router.push('/')
        }
    }
}