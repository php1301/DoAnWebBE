
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

async function refetchTaskBoard() {
    const currentTaskBoard = window.location.pathname + '/update'
    console.log(currentTaskBoard)
    const options = {
        method: "get",
        url: currentTaskBoard
    }
   const data = await axios(options)
    $(".board").html(data?.data)
}

window.Echo.channel('refetchTaskBoard').listen('.refetchTaskBoard', (e) => {
    console.log(e)
    refetchTaskBoard()
})