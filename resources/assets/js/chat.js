/**
 * Created by Administrator on 2017/6/2.
 */

var Chat = {
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
    }
}
Chat.listen()

$(document).ready(function () {
    $('#sendMessage').click(function () {
        axios.post('/api/chat', {
            'to': $('#inputTo').val(),
            'type': $('#inputType').val(),
            'content': $('#inputContent').val()
        }).then(function (response) {
                console.log(response.data)
            }).catch(function (err) {
                console.error(err)
            })
    })
})