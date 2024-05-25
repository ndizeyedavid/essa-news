let navs = document.querySelectorAll('.nav-link');
let main_out = document.querySelector('.card');
let news_cards = document.querySelectorAll('.news-card');
let right_container = document.querySelector('.right-container');

let menu_isVis =  false;

news_cards.forEach(news_card => {
	news_card.onclick = () => {
		news_cards.forEach(news_card => {
			news_card.classList.remove('active');
		});
		news_card.classList.add("active");
	}
});

// navigation links
navs.forEach(nav=>{
	nav.onclick = () =>{
		navs.forEach(nav=>{
			nav.classList.remove('active');
		});
		nav.classList.add('active');
	}
});


// fetching news
function fetch_news(id){
	if (window.screen.availWidth<720){
		right_container.style.display="flex";
	}

	if (window.screen.availWidth<720 && menu_isVis){
		nav_btn.style.right="0px";
		nav_btn.children[0].className='bi-justify';
		left_menu.style.display="none";
		menu_isVis = false;
	}

	main_out.innerHTML = "<div class='loading-bar'><div class='loading'></div></div>";
	const xhttp = new XMLHttpRequest();
	xhttp.onload=()=>{
		const res = xhttp.response;
		main_out.innerHTML = res;
	}
	xhttp.open("GET", `php/fetch_news.php?id=${id}`);
	xhttp.send();
}

//liking news
let liked = false;
function like_news(cont, news){
	const xhttp = new XMLHttpRequest();
	xhttp.onload = () =>{
		const res = xhttp.responseText;
		cont.children[0].className="bi-hand-thumbs-up-fill";
		var likes = document.querySelector('#likes');
		var likes_number = likes.innerHTML;

		likes.innerText = eval(Number(likes_number)+1);
		// console.log(likes_number);
		console.log(res);
	}
	if (!liked){
		xhttp.open("GET", `php/like.php?id=${news}`); // ES6 - Literal Templates
		xhttp.send();
		liked=true;
	}
}



// responsiveness
let nav_btn = document.querySelector('.nav-btn');
let left_menu = document.querySelector('.left-container');
nav_btn.onclick = () =>{
	if(!menu_isVis){
		nav_btn.style.right="-160px";
		nav_btn.children[0].className='bi-x-circle';
		left_menu.style.display="flex";
		menu_isVis = true;
	}else{
		nav_btn.style.right="0px";
		nav_btn.children[0].className='bi-justify';
		left_menu.style.display="none";
		menu_isVis = false;
	}
	
}
let news_close = document.querySelector('#news-close');
news_close.onclick = () =>{
	right_container.style.display="none";
}


// loading
let loading_container = document.querySelector('.loading-container');
let loading_bar = document.querySelector('.loading');
let i=0;

var loading = setInterval(()=>{
	if (loading_bar == null){
		clearInterval(loading);
	}
	if (i>=100){
		clearInterval(loading);
		reveal();
	}
	loading_bar.style.width=`${i}%`;

	i++;
}, 30);

function reveal(){
	document.querySelector('.loading-section').classList.add('reveal');
	setTimeout(()=>{
		document.querySelector('.loading-section').classList.add('hide');
	}, 1400);
}