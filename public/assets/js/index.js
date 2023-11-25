const $loader = document.querySelector('.loader');
document.addEventListener("click", (e) => {
    if(e.target.id == "addBillBoard" || e.target.id == "removeMovie" || e.target.id == "removeBillBoard") $loader.classList.add("visible");
});
