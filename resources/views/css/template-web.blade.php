<style>
    /* 

Newline Template

https://templatemo.com/tm-503-newline

*/
:root {
  --color-0: #3d3d3d;
  --color-1: #E1B16A;
  --color-2: #FFBB00;
  --color-3: #fffef0;
  --color-4: #976f00;
  --color-5: #ffeec1;
  --color-6: #ff2600;
  --color-7: #925300;
}

body {
	font-family: 'Montserrat', sans-serif;
}

p {
  font-size: 14px;
  color: black;
  font-weight: 300;
  line-height: 25px;
}

a {
  font-size: 14px;
  color: #ffffff;
  font-weight: 300;
  line-height: 25px;
}
a:hover { color: cyan; text-decoration: none; word-wrap: break-word;}

.desaid       {  font-size: 13px; color: #2C5C94; text-decoration: none; font-weight: bold}
.desaid:hover {  font-size: 13px; color: #BC8F8F; text-decoration: none; font-weight: bold}

video { 
    position: fixed;
    top: 50%;
    left: 50%;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    z-index: -100;
    transform: translateX(-50%) translateY(-50%);
    background-size: cover;
    transition: 1s opacity;
}

video::-webkit-media-controls {
    display:none !important;
}

/* Background utama */
.overlay-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1;
  
  background-image: url({{ asset('web/img/background-utama.png') }}); /* tambahkan path yang benar ke gambar */
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
}

.overlay-color {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1;
  
  background-color: var(--color-0);
}
.primary-button a {
  display: inline-block;
  background-color: var(--color-1);
  color: #343434;
  font-size: 13px;
  padding: 10px 10px;
  border-radius: 3px;
  text-decoration: none;
  border: 1px solid transparent;
}

.primary-button a:hover {
  background-color: transparent;
  border: 1px solid var(--color-1);
  -moz-transition: all 0.2s linear;
  -o-transition: all 0.2s linear;
  -webkit-transition: all 0.2s linear;
}

.cd-hero {
  z-index: 2;
  position: relative;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.cd-hero-slider {
  position: relative;
  overflow: hidden;
  margin-top: -30px;
  padding: 0;
  list-style: none;
}
.cd-hero-slider .slider-item {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  -webkit-transform: translateX(100%);
  -moz-transform: translateX(100%);
  -ms-transform: translateX(100%);
  -o-transform: translateX(100%);
  transform: translateX(100%);
}
.cd-hero-slider .slider-item.selected {
  /* this is the visible slide */
  position: relative;
  -webkit-transform: translateX(0);
  -moz-transform: translateX(0);
  -ms-transform: translateX(0);
  -o-transform: translateX(0);
  transform: translateX(0);
}
.cd-hero-slider .slider-item.move-left {
  /* slide hidden on the left */
  -webkit-transform: translateX(-100%);
  -moz-transform: translateX(-100%);
  -ms-transform: translateX(-100%);
  -o-transform: translateX(-100%);
  transform: translateX(-100%);
}
.cd-hero-slider .slider-item.is-moving, .cd-hero-slider .slider-item.selected {
  /* the is-moving class is assigned to the slide which is moving outside the viewport */
  -webkit-transition: -webkit-transform 0.5s;
  -moz-transition: -moz-transform 0.5s;
  transition: transform 0.5s;
}
@media only screen and (min-width: 768px) {
  .cd-hero-slider {
  }
  
}
@media only screen and (min-width: 1170px) {
  .cd-hero-slider {
  }
  
}

@media only screen and (min-width: 992px) {
  .welcome-text{
    padding-right: 30px;
    word-wrap: break-word;
  }
  .welcome-text h1,
  .welcome-text h2,
  .welcome-text h3,
  .welcome-text h6{
    text-align: left;
    word-wrap: break-word;
  }
}
@media only screen and (max-width: 991px) {
  
  .welcome-text h1,
  .welcome-text h2,
  .welcome-text h3,
  .welcome-text h6{
    text-align: center;
    word-wrap: break-word;
  }
}
@media only screen and (min-width: 852px) and (max-width: 990px) {
  .welcome-text {
    padding: 0 50px 0 50px;
    word-wrap: break-word;
  }
}
@media only screen and (min-width: 992px) and (max-width: 1200px){
  .profile-image{
    border-bottom: 50px solid rgb(255, 255, 255);
  }  
}


.a-nav{
  padding-left: 5px; 
  color: var(--color-2);
}

.btn-nav {
    background: none;
    border: none;
    color: var(--color-2);
    cursor: pointer;
  }

.btn-nav:hover, .a-nav:hover {
  color: var(--color-4);
}
.cd-slider-nav {
  text-align: center;
}

.cd-slider-nav ul {
  padding: 0;
  margin: 0;
}

.cd-slider-nav ul li {
  display: inline-block;
  margin: 30px;
}

.cd-slider-nav ul li a {
  text-decoration: none;
}

.cd-slider-nav ul li h6 {
  font-size: 14px;
  text-transform: uppercase;
  text-align: center;
  font-weight: 400;
  color: var(--color-3);
}

/* ini nama icon utama di halaman home */
.cd-slider-nav ul .selected h6 {
  color: var(--color-1);
  text-decoration: none;
  word-wrap: break-word;
}

/* START kotak icon utama di halaman home */
.cd-slider-nav .image-icon {
  margin: 0 auto;
  display: block;
  width: 100px;
  height: 100px;
  display: flex;
  justify-content: center;
  align-items: center;
  line-height: 80px;
  border-radius: 10%;
  text-align: center;
  padding: 0px;
  background-color: var(--color-2);
  opacity: 0.40;
}

.cd-slider-nav .image-icon:hover {
  background-color: #fff;
  -moz-transition: all 0.2s linear;
  -o-transition: all 0.2s linear;
  -webkit-transition: all 0.2s linear;
  opacity: 0.99;
}

/* ini icon yang dipilih */
.cd-slider-nav ul .selected .image-icon {
  background-color: var(--color-2);
  opacity: 0.99;
}

/* Gambar icon profil, rumah, dan lain-lain */
.cd-slider-nav .image-icon img {
    width: 100px;
  }
/* END kotak icon utama di halaman home */

/* Garis di bawah judul profil desa*/
.content {
  margin-bottom: 20px;
  margin-top: -80px;
  background-color: #fff;
  border-top: 15px solid var(--color-2);
  box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2);
}


/*
=====================
----- TOP PART ------
=====================
*/

.top-part img {
  width: 100%;
  background-size: cover;
  position: absolute;
  overflow: hidden;
  top:0;
  left: 0;
}


/*
=======================
----- FIRST SLIDE -----
=======================
*/

.first-slide {
  text-align: center;
  word-wrap: break-word;
}

.first-slide {
  background-color: #fff;
  width: 100%;
}

.heading {
  text-align: center;
  margin-bottom: 100px;
  word-wrap: break-word;
}

.heading h1 {
  margin-top: 10px;
  font-size: 38px;
  text-transform: uppercase;
  color: #fff;
  font-weight: 900;
  letter-spacing: 1px;
  word-wrap: break-word;
}

.first-content h4 {
  font-size: 19px;
  text-transform: uppercase;
  color: #121212;
  letter-spacing: 1px;
  margin-top: 0px;
  margin-bottom: 10px;
  word-wrap: break-word;
}

.first-content {
  padding: 60px 0px;
  word-wrap: break-word;
}

/* .first-content p {
  padding: 0 300px 0 0;
} */

@media only screen and (min-width: 851px) {
  .profil-text {
    padding: 0 50px 0 50px;
    word-wrap: break-word;
  }
  
}
.justify-text{
  text-align: justify;
}

.normal-text p,
.normal-text li,
.normal-text a{
  font-size: 16px;
  font-weight: 300; /* Atau bisa diganti dengan angka yang lebih kecil dari 400 */
  word-wrap: break-word;
}
.phone-size{
    display: none;
}
@media only screen and (max-width: 510px) {
  .normal-text p,
  .normal-text li,
  .normal-text a{
      font-size: 14px;
  }
  .comment-btn p,
  .comment-btn a,
  .comment-btn i,
  .comment-btn b,
  .comment-btn li {
      font-size: 14px;
  }
  .pc-size{
    display: none;
  }
  .phone-size{
    display: block;
  }
}


.profil-text li {
  padding: 0 30px 0 20px;
  word-wrap: break-word;
}

.first-content .primary-button {
  margin-top: 30px;
}

/*
==============================================
----------------- FOOTER STYLE ---------------
==============================================
*/

footer {
  background-color: var(--color-0);
  position: relative;
  width: 100%;
  bottom: 0;
  /* z-index: 2; */
  margin-top: -1px;
}
footer p,
footer li,
footer a {
    font-size: 16px;
    color: #ffffff;
    margin: 0px;
    padding: 25px 0px;
    text-align: center;
    font-weight: 400;
}
@media only screen and (max-width: 600px) {
  footer p,
  footer li,
  footer a {
    font-size: 11px;
    color: #ffffff;
    margin: 0px;
    padding: 25px 0px;
    text-align: center;
    font-weight: 400;
  }
}

footer p em {
  font-style: normal;
  font-weight: 500;
}

/*
========================================
---------- RESPONSIVE STYLE ------------
========================================
*/

@media (max-width: 850px){
  .cd-slider-nav ul li h6 {
    font-size: 13px;
    text-transform: uppercase;
    text-align: center;
    font-weight: 400;
    color: #fff;
    margin-top: 15px;
    display: block;
    opacity: 0;
  }

  .cd-slider-nav .image-icon img {
    width: 60px;
  }

  .cd-slider-nav ul .selected img {
    border-bottom: 3px solid var(--color-2);
    padding-bottom: 10px;
    -moz-transition: all 0.2s linear;
    -o-transition: all 0.2s linear;
    -webkit-transition: all 0.2s linear;
  }

  .cd-slider-nav .image-icon {
    width: 0px;
    height: 0px;
    line-height: 40px;
    margin: 0 auto;
  }

  .cd-slider-nav {
    /* background-color: var(--color-2); */
    width: 100%;
    height: 100px;
    line-height: 100px;
    margin: 0 auto;
    text-align: center!important;
  }

  .cd-slider-nav ul {
    padding: 0;
    margin-top: 40px;
    text-align: center!important;
  }

  .cd-slider-nav ul li {
    display: inline-block;
    margin-top: 0px;
    margin-left: -3px;
    margin-right: -3px;
  }

  .heading h1 {
    margin-top: 60px;
    font-size: 24px;
    font-weight: 700;
    letter-spacing: 0px;
  }

  .heading span {
    font-size: 13px;
    letter-spacing: px;
  }

  .content {
    margin-bottom: 100px;
    margin-top: -100px;
    background-color: #fff;
    border-top: 15px solid var(--color-2);
    box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2);
  }

  .slider-item{
    margin-top: -50px;
  }

  .discussion-body{
    margin-top: -5px;
  }

  .first-content h4 {
    margin-left: 15px;
    margin-right: 15px; 
    word-wrap: break-word; /* Menggunakan 'break-word' untuk memastikan teks yang panjang dibungkus ke baris selanjutnya */
  }

  .first-content p {
    margin: 0px 30px;
    word-wrap: break-word; /* Menggunakan 'break-word' untuk memastikan teks yang panjang dibungkus ke baris selanjutnya */
  }

  .second-slide .left-image {
    padding-right: 15px!important;
  }

  .second-slide .right-image {
    padding-left: 15px!important;
  }

  .second-slide .right-about-text {
    text-align: left;
    margin-left: 15px;
    margin-left: 30px;
  }

  .second-slide .left-about-text {
    text-align: left;
    margin-left: 0px;
    margin-left: 30px;
    margin-bottom: 30px;
  }

  .fivth-content .left-info .social-icons {
    margin-top: 30px;
    margin-bottom: 60px;
  }

}


/*
========================================
----------- LIGHT BOX STYLE ------------
========================================
*/

/* Preload images */
body:after {
  content: url(../img/close.png) url(../img/loading.gif) url(../img/prev.png) url(../img/next.png);
  display: none;
}

body.lb-disable-scrolling {
  overflow: hidden;
}

.lightboxOverlay {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 9999;
  background-color: black;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=80);
  opacity: 0.8;
  display: none;
}

.lightbox {
  position: absolute;
  margin-top: 5%;
  left: 0;
  width: 100%;
  z-index: 10000;
  text-align: center;
  line-height: 0;
  font-weight: normal;
}

.lightbox .lb-image {
  display: block;
  height: auto;
  max-width: inherit;
  max-height: none;
  border-radius: 3px;

  /* Image border */
  border: 4px solid white;
}

.lightbox a img {
  border: none;
}

.lb-outerContainer {
  position: relative;
  *zoom: 1;
  width: 250px;
  height: 250px;
  margin: 0 auto;
  border-radius: 4px;

  /* Background color behind image.
     This is visible during transitions. */
  background-color: white;
}

.lb-outerContainer:after {
  content: "";
  display: table;
  clear: both;
}

.lb-loader {
  position: absolute;
  top: 43%;
  left: 0;
  height: 25%;
  width: 100%;
  text-align: center;
  line-height: 0;
}

.lb-cancel {
  display: block;
  width: 32px;
  height: 32px;
  margin: 0 auto;
  background: url(../img/loading.gif) no-repeat;
}

.lb-nav {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  z-index: 10;
}

.lb-container > .nav {
  left: 0;
}

.lb-nav a {
  outline: none;
  background-image: url('data:image/gif;base64,R0lGODlhAQABAPAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==');
}

.lb-prev, .lb-next {
  height: 100%;
  cursor: pointer;
  display: block;
}

.lb-nav a.lb-prev {
  width: 34%;
  left: 0;
  float: left;
  background: url(../img/prev.png) left 48% no-repeat;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
  opacity: 0;
  -webkit-transition: opacity 0.6s;
  -moz-transition: opacity 0.6s;
  -o-transition: opacity 0.6s;
  transition: opacity 0.6s;
}

.lb-nav a.lb-prev:hover {
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
}

.lb-nav a.lb-next {
  width: 64%;
  right: 0;
  float: right;
  background: url(../img/next.png) right 48% no-repeat;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
  opacity: 0;
  -webkit-transition: opacity 0.6s;
  -moz-transition: opacity 0.6s;
  -o-transition: opacity 0.6s;
  transition: opacity 0.6s;
}

.lb-nav a.lb-next:hover {
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
}

.lb-dataContainer {
  margin: 0 auto;
  padding-top: 5px;
  *zoom: 1;
  width: 100%;
  -moz-border-radius-bottomleft: 4px;
  -webkit-border-bottom-left-radius: 4px;
  border-bottom-left-radius: 4px;
  -moz-border-radius-bottomright: 4px;
  -webkit-border-bottom-right-radius: 4px;
  border-bottom-right-radius: 4px;
}

.lb-dataContainer:after {
  content: "";
  display: table;
  clear: both;
}

.lb-data {
  padding: 0 4px;
  color: #ccc;
}

.lb-data .lb-details {
  width: 85%;
  float: left;
  text-align: left;
  line-height: 1.1em;
  word-wrap: break-word;
}

.lb-data .lb-caption {
  font-size: 13px;
  font-weight: bold;
  line-height: 1em;
  word-wrap: break-word;
}

.lb-data .lb-caption a {
  color: #4ae;
}

.lb-data .lb-number {
  display: block;
  clear: left;
  padding-bottom: 1em;
  font-size: 12px;
  color: #999999;
}

.lb-data .lb-close {
  display: block;
  float: right;
  width: 30px;
  height: 30px;
  background: url(../img/close.png) top right no-repeat;
  text-align: right;
  outline: none;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=70);
  opacity: 0.7;
  -webkit-transition: opacity 0.2s;
  -moz-transition: opacity 0.2s;
  -o-transition: opacity 0.2s;
  transition: opacity 0.2s;
}

.lb-data .lb-close:hover {
  cursor: pointer;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
}
</style>