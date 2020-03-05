<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<style>
	html, body {
	  height: 100%;
	  min-width:320px;
	}
	body {
	  color: #ccc;
	}
	.hidden {
	  display: none;
	}
	.footer {
	  padding: 20px 0;
	  font-size: 10px;
	}
	.btn {
	  font-size: 16px;
	  text-transform: uppercase;
	  border-radius: 0;
	}
	.form-control {
	  border-radius: 0;
	}
	#convert-btn, #link {
	  background-color: #28c979;
	  border-color: #28c979;
	  border-radius: 22px;
	  color: #fff;
	}
	#inputUrl {
	  margin-bottom: 20px;
	}
	#convert-form {
	  width: 100%;
	}
	.title {
	  font-weight: bold;
	  font-size: 30px;
	  color: #000;
	}
	.description {
	  margin-bottom: 20px;
	}
	.header {
	  padding: 8px 0;
	  color: #fff;
	  background-color: #32afed;
	}
	.user_photo {
		border-radius:80px;
		width:160px;
		height:160px;
	}
	.tgme_page_description {
		color: #2b2d2e;
	}
	.tgme_page_description a {
		color: #3ca2d9;
	}
	#main{
		font-size: 1rem;
		height:100%;
	}
	</style>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<title>Переадресация Telegram</title>
</head>
<body class="text-center d-flex flex-column">
	<div class="header">
		Переадресация в Telegram!
	</div>
	<div class="container d-flex justify-content-center align-items-center flex-column flex-grow-1">
		<form id="convert-form" class="hidden align-items-center">
			<div class="row justify-content-center">
				<h1>ТУТ картинка</h1>
			</div>
			<div class="row">
				<div class="col">
					<h1 class="title">Генерация ссылки</h1>
				</div>
			</div>
			<div class="row justify-content-center text-center description">
				Введите ссылку в формате t.me/login или @login
			</div>
			<div class="row justify-content-center">
				<div class="col-md-5">
					<input type="inputUrl" id="inputUrl" class="form-control" placeholder="t.me/.." required="" autofocus="">
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-4">
					<button class="btn btn-lg btn-primary btn-block" onclick="handleUrl()" id="convert-btn" type="button">Сгенерировать ссылку</button>
				</div>
			</div>
			<div class="hidden row justify-content-center mt-4">
				<!---<div class="col banner">
					<a href="" target="_blank">
						<img src="" alt="" class="img-fluid">
					</a>
				</div>--->
			</div>
		</form>
		<div id="open-link" class="hidden w-100 justify-content-center">
			<div class="row justify-content-center">
				<div class="col-md-5">
					<a id="link" class="btn btn-lg btn-primary btn-block" href="">Открыть</a>
				</div>
			</div>
			<div class="hidden row justify-content-center mt-4">>
				<!---<div class="col banner">
					<a href="" target="_blank">
						<img src="" alt="" class="img-fluid">
					</a>
				</div>--->
			</div>
		</div>
	</div>
	<footer class="footer d-none">
		<div class="container">
			<span class="text-muted">
				Copyright © 2020 <a href="tg://resolve?domain=cpa_rip">@CPA_RIP</a>
			</span>
		</div>
	</footer>
	<script>
	pageUrl = '/';
	urlContents = location.pathname.split("/");
	isIndex = (((urlContents[urlContents.length-1] == "") || (urlContents[urlContents.length-1] == "index.php")) && (location.search == ''));
	blockId = isIndex ? 'convert-form' : 'open-link';
	block = document.getElementById( blockId );
	not_found = document.querySelector('.not_found_home');
	haveBanners = document.querySelector( '.banner' ) !== null;
	timeout = haveBanners ? 5000 : 500;
	block.classList.remove( 'hidden' );

	if (!isIndex && !not_found) {
		forward();
	}
	document.getElementById('convert-form').addEventListener('submit', function(e) {
		e.preventDefault();
	});
	document.getElementById('inputUrl').addEventListener('keyup', function(e) {
		if ( e.keyCode !== 13 ) {
			return;
		}
		e.preventDefault();
		handleUrl();
	});

	function handleUrl(){
		function setValue(val) {
			document.getElementById("inputUrl").value = val;
		}
		value = document.getElementById("inputUrl").value;
		if (value.match(/^[a-zA-Z\?=\d_-]+$/)) {
			return setValue(window.location.href + value);
		}
		value = value
		.replace(/.*t\.me/,window.location.href)
		//.replace("http://","https://")
		.replace("@",window.location.href);

		setValue(value);
	}
	function getLocation(url) {
		link = document.createElement( 'a' );
		link.href = url;
		return link;
	}
	function forward() {
		//var location = getLocation(pageUrl);
		info = location.pathname.split("/");
		if (+info[info.length-1] > 0) {
			domain = info[info.length-2];
			join_type = info[info.length-3];
		} else {
			domain = info[info.length-1];
			join_type = info[info.length-2];
		}
		str = '';
		switch (join_type) {
		case "socks":
			str = "tg://socks" + location.search;
			break;
		case "joinchat":
			str = "tg://join?invite=" + domain;
			break;
		case "addstickers":
			str = "tg://addstickers?set=" + domain;
			break;
		case "proxy":
			str = "tg://" + domain + location.search;
			break;
		default:
			str = "tg://resolve?domain=" + domain;
			if (+info[info.length-1] > 0) {
				str += "&post=" + info[info.length-1]
			}
		}

		document.getElementById("link").href = str;
		setTimeout(function() {
			window.location.replace(str);
		}, timeout );
	}
	</script>
</body>
</html>