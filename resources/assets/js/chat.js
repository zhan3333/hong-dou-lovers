/**
 * Created by Administrator on 2017/6/2.
 */

console.log(user_id)
var Chat = {
    listen: function () {
        Echo.private('chat.1')
            .listen('SendMessage', (e) => {
                console.log(e.message)
            })
    }
}