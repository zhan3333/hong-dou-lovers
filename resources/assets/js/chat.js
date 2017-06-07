/**
 * Created by Administrator on 2017/6/2.
 */

let chat ={
    // 判断用户是否登陆
    isLogin: function () {
        if (Laravel.userId == false)
            return false;
        return true;
    },
    // 监听属于自己的频道
    listen: function () {
        if (this.isLogin()) {
            console.log('listen to:', 'chat.' + Laravel.userId)
            Echo.private('chat.' + Laravel.userId)
                .listen('SendMessage', (e) => {
                    let message = e.message
                    console.info('from:', message.user_id)
                    console.log('content:', message.content)
                })
        }
    },
    sendMessage: function (to, content, type = 1) {
        axios.post('/api/chat', {
            'to': to,
            'type': type,
            'content': content
        }).then(function (response) {
            console.log(response.data)
        }).catch(function (err) {
            console.error(err)
        })
    }
}
export default chat