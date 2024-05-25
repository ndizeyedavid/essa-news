let modal_container, modal;
modal_container = document.querySelector('.modal-container');
modal = modal_container.querySelector('.modal');

function display_news(id){
    // modal.innerHTML = '<div class="loading" style="margin-top: 180px"></div>';
    modal.innerHTML = '<div class="loading"></div>';
    modal_container.style.display = 'flex';
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
        const res = this.response;
        modal.innerHTML = res;
    }
    xhttp.open('GET', `php/view.php?id=${id}`);
    xhttp.send();
}

modal_container.addEventListener('click', function(e){
    if (e.target.classList.contains('modal-container')){
        modal_container.style.display = 'none';
    }
});