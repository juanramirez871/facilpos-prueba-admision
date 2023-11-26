const $loader = document.querySelector('.loader');
const $modal = document.querySelector('.modal');
const $name = document.querySelector('#name');
const $lenguage = document.querySelector('#lenguage');
const $title = document.querySelector('#title');
const $summary = document.querySelector('#summary');
const $poster = document.querySelector('#poster');
const $inputPoster = document.querySelector('#inputPoster');
const $formModal = document.querySelector('#formModal');
const movieEdit = {
    name: "",
    title: "",
    summary: "",
    lenguage: "",
    poster: ""
}

document.addEventListener("click", (e) => {
    // si se hace alguna accion en los siguientes id, se muestre la animacion de carga
    if(e.target.id == "addBillBoard" || e.target.id == "removeMovie" || e.target.id == "removeBillBoard") $loader.classList.add("visible");

    // manejo del cierre del modal
    if(e.target.id == "closeModal") $modal.classList.remove("flex");

    // renderisacion de datos en el modal
    if(e.target.id == "editMovie") {
        $formModal.action = `movies/${e.target.dataset.id}`
        $modal.classList.add("flex")
        console.log("🚀 ~ file: index.js:24 ~ document.addEventListener ~ e.target.dataset.id:", e.target.dataset.id)
        movieEdit.summary = (e.target.previousElementSibling).previousElementSibling.innerText;
        movieEdit.lenguage = (((e.target.previousElementSibling).previousElementSibling).previousElementSibling.innerText);
        movieEdit.title = (((e.target.previousElementSibling).previousElementSibling).previousElementSibling).previousElementSibling.previousElementSibling.innerText
        movieEdit.name = (((e.target.previousElementSibling).previousElementSibling).previousElementSibling).previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText;
        movieEdit.poster = e.target.parentNode.previousElementSibling.src
        $name.value = movieEdit.name;
        $title.value = movieEdit.title;
        $summary.value = movieEdit.summary;
        $lenguage.value = movieEdit.lenguage;
        $poster.src = movieEdit.poster
        $inputPoster.value = movieEdit.poster;
    };
});
