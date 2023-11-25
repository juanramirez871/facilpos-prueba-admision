const $loader = document.querySelector('.loader');

// si se hace alguna accion en los siguientes id, se muestre la animacion de carga
document.addEventListener("click", (e) => {
    if(e.target.id == "addBillBoard" || e.target.id == "removeMovie" || e.target.id == "removeBillBoard") $loader.classList.add("visible");
});
