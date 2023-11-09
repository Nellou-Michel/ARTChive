window.addEventListener("scroll", function() {
    let scroll = this.window.scrollY;
    let btn_bot = document.getElementById("btn_bot");

    if(scroll <= 200)
    {
        btn_bot.style.display = "none";
    }
    else
    {
        btn_bot.style.display = "flex";
    }
});