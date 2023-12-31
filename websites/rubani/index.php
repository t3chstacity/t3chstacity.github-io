<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rubani";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch uploaded images from the database
$result = $conn->query("SELECT * FROM aircrafts ORDER BY aId ASC");

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, inital-scale=1.0">
	<title>Space Ya Rubani</title>
	<link rel="stylesheet"  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link type="image/png" sizes="96x96" rel="icon" href="gallery/icons8-airplane-90.png">
</head>

<style>
    
/* Google Fonts */

    *{
        font-family: 'Work Sans', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        scroll-padding-top: 4rem;
        scroll-behavior: smooth;
        list-style: none;
        text-decoration: none;

    }
    /* Variables */
    :root{
        --main-color: #000000;
        --btn-main-color: #00c3ff;
        --second-color: #edeae3;
        --text-color: #1b1b1b;
        --bg-color: #fff;
        --bg-color: #fff;
        /* Box Shadow */
        --box-shadow: 2px 2px 10px 4px rgb(14 55 54 / 15%);
    }
    section{
        padding: 50px 100px;
    }
    img{
        width: 100%;
    }
    body{
        color: var(--text-color);
    }
    header{
        position: fixed;
        width: 100%;
        top: 0;
        right: 0;
        z-index: 1000;
        display: flex;
        justify-content: space-between;
        color: !important var(--main-color);
        align-items: center;
        padding: 18px 100px;
        transition: 0.5s linear;
        background: var(--bg-color);
        box-shadow: var(--box-shadow);
    }
    .logo img{
        width: 60px;
    }
    .navbar{
        display: flex;
    }
    .navbar a{
        padding: 8px 17px;
        color: var(--main-color);
        font-size: 1rem;
        text-transform: uppercase;
        font-weight: 500;
    }
    .navbar a:hover{
        background: var(--main-color);
        color: var(--bg-color);
        border-radius: 0.2rem;
        transition: 0.2s all linear;
    }
    .header-icon{
        font-size: 22px;
        cursor: pointer;
        z-index: 1000;
        display: flex;
        column-gap: 0.8rem;
    }
    .header-icon .bx{
        color: var(--bg-color);
    }

    .header-icon .bx:hover{
        color: var(--main-color);
    }

    #menu-icon{
        color: var(--bg-color);
        font-size: 24px;
        z-index: 100001;
        cursor: pointer;
        display: none;
    }

    .search-box{
        position: absolute;
        top: -100%;
        left: 50%;
        transform: translate(-50%);
        background: var(--bg-color);
        width: 100%;
    }

    .search-box.active{
        top: 110%;
        box-shadow: var(--box-shadow);
        transition: 0.2s all linear; 
    }

    .search-box input{
        padding: 20px;
        border: none;
        outline: none;
        width: 100%;
        font-size: 1rem;
        color: var(--main-color);
    }

    .search-box input::placeholder{
        font-size: 1rem;
        font-weight: 500;
    }

    .home{
        width: 100%;
        min-height: 100vh;
        background-image: url('gallery/hero_image.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(17rem, auto));
        align-items: center;
        gap: 1.5rem;
    }
/* This is section that comes after the navbar */


    .home-text {
        /* background: rgba(0, 0, 0, 0.5); */
        /* border-radius: 2rem; */
        /* color: var(--bg-color); */
        padding: 0.1rem;
    }
    .home-text h1{
        font-size: 3rem;
        /* color: var(--main-color); */
        /* text-transform: uppercase; */
        letter-spacing: 1px;
        font-weight: bolder;
    }

    .home-text p{
        font-size: 0.98rem;
        color: var(--bg-color);
        margin: 4rem 3.3rem 1.4rem 6rem;
        font-weight: bold;
    }

    .btn{
        padding: 10px 40px;
        border-radius: 0.3rem;
        background: var(--btn-main-color);
        color: var(--bg-color);
        font-weight: 700;
    }

    .btn:hover{
    background: #006e7c;
    }

    .about{
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(17rem, auto));
        gap: 1.5rem;
    }

    .about-img img{
        border-radius: 0.5rem;
    }

    .about-text h2{
        font-size: 1.8rem;
        text-transform: uppercase;
        font-weight: 700;
        text-align: center;
    }

    .about-text p{
        text-align: center;
        font-size: 1.2rem;
        margin: 0.5rem 0 1.1rem;
    }

    .heading{
        text-align: center;
    }

    .heading h2{
        font-size: 1.8rem;
        text-transform: uppercase;
    }

    .products-container{
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, auto));
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .products-container .box{
        position: relative;
        padding: 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        border-radius: 0.5rem;
        box-shadow: var(--box-shadow);
    }

    .products-container img{
        width: 100%;
        height: 250%;
        object-fit: contain;
        object-position: center;
        padding: 20px;
        background: #f1f1f1;
        border-radius: 0.5rem;
    }

    .products-container .box h3{
        font-size: 1rem;
        font-weight: 600;
        text-transform: uppercase;
        margin: 0.5rem 0 0.5rem;
    }

    .products-container .box .content{
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    .products-container .box .content span{
        padding: 0 1rem;
        color: var(--bg-color);
        background: var(--main-color);
        border-radius: 4px;
        font-weight: 500;
    }

    .products-container .box .content a{
        padding: 0 1rem;
        color: var(--text-color);
        border: 2px solid var(--main-color);
        border-radius: 4px;
        text-transform: uppercase;
    }

    .products-container .box .content a:hover{
        background: var(--main-color);
        color: var(--bg-color);
        transition: 0.2s all linear;
    }

    .customers-container{
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, auto));
        gap: 1.5rem;
        margin-top: 2rem;
    }
    
    .customers-container .box{
        padding: 20px;
        box-shadow: var(--box-shadow);
        border-radius: 0.5rem;
        text-align: center;
    }

    .stars .bx{
        color: var(--main-color);
    }

    .customers-container .box h2{
        font-size: 1.2rem;
        font-weight: 600;
        margin: 0.5rem 0 0.5rem;
    }

    .customers-container .box p{
        font-size: 0.938rem;
    }

    .customers-container .box img{
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
    }

    .customers-container .box:hover{
        background: var(--second-color);
        transition: 0.2s all linear;
    }

    .footer{
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, auto));
        gap: 1.5rem;
    }

    .footer-box h2{
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 10px;
    }
    .footer-box p{
        font-size: 0.938rem;
        margin-bottom: 10px;
    }
    .social{
        display: flex;
        align-items: center;
        column-gap: 0.5rem;
    }
    .social a .bx{
        font-size: 24px;
        color: var(--text-color);
        padding: 10px;
        background: var(--second-color);
        border-radius: 0.2rem;
    }
    .social a .bx:hover{
        background: var(--main-color);
        color: var(--bg-color);
    }
    .footer-box h3{
        font-weight: 600;
        margin-bottom: 10px;
    }
    .footer-box li a{
        color: var(--text-color);
    }
    .footer-box li a:hover{
        color: var(--main-color);
    }
    .contact{
        display: flex;
        flex-direction: column;
        row-gap: 0.5rem;
    }
    .contact span{
        display: flex;
        align-items: center;
    }
    .contact i{
        font-size: 20px;
        margin-bottom: 1rem;
    }
    .copyright{
        padding: 20px;
        text-align: center;
        background: var(--second-color);
    }

    @media (max-width: 1058px) {
        header{
            padding: 16px 60px;
        }
        section{
            padding: 50px 60px;
        }
        .home-text h1{
            font-size: 2.4rem;
        }

    }

    @media (max-width: 991px) {
        header{
            padding: 16px 4%;
        }
        section{
            padding: 50px 4%;
        }
        .home-text h1{
            font-size: 2rem;
        }

        }
        @media (max-width: 768px){
        header{
            padding: 12px 4%;
        }
        #menu-icon{
            display: initial;
        }
        .navbar{
            position: absolute;
            top: -570px;
            left: 0;
            right: 0;
            display: flex;
            flex-direction: column;
            background: var(--second-color);
            row-gap: 1.4rem;
            padding: 20px;
            transition: 0.3s;
            text-align: center;
        }
        .navbar a{
            color: var(--text-color);
        }
        .navbar a:hover{
            color: var(--bg-color);
        }
        .navbar.active{
            top: 100%;
        }
        .about{
            align-items: center;
        }
    }
    @media (max-width: 360px){
        header{
            padding: 11px 4%;
        }

        .logo img{
            width: 45px;
        }

        .home-text{
            padding: 15px;
        }

        .home-text h1{
            font-size: 1.4rem;
        }

        .home-text p{
            font-size: 00.8rem;
            font-weight: 300;
        }

        .about-img{
            order: 2;
        }

        .about-text{
            text-align: center;
        }

        .about-text h2{
            font-size: 1.2rem;
        }

        .heading h2{
            font-size: 1.2rem;
        }
    }

    #notice-flights {
        text-align: center;
    }

#uploaded_img {
    width: 100%;
    object-fit: contain;
    object-position: center; 
    padding: 20px;
    background: #f1f1f1;
    border-radius: 0.5rem;
    }

</style>

<body>
	<!-- Navbar -->
	<header>
		<a href="#" class="logo">
            
			<!-- <img src="https://www.pngitem.com/pimgs/m/565-5659987_coffee-cup-coffee-milk-clip-art-creative-coffee.png"> -->
		</a>

		<!-- Menu-Icon -->
		<i class="bx bx-menu" id="menu-icon"></i>
		<!-- Links -->
		<ul class="navbar">
			<li><a href="#home">Home</a></li>
			<li><a href="#about">About</a></li>
			<li><a href="#products">Portfolio</a></li>
			<li><a href="upload.php">Upload an Aircraft</a></li>
		</ul>

		<!-- Icon -->
		<div class="header-icon">
			
		</div>
		<!-- Search Box -->
		
	</header>
	<!-- Home -->
	<section class="home" id="home">
		<div class="home-text">
			<h1>Karibu sana, Rubani</h1>
			<h3>You dream of flying, We make it happen.<br>
                The sky is not the limit, it's your playground.</h3>
		</div>
		<div class="home=img">
			<img src=" ">
		</div>
	</section>

    <!--About-->
    <section class="about" id="about">
        <div class="about-img">
            <img src="gallery/pilot.webp" alt="">
        </div>
        <div class="about-text">
            <h2>Quick Info: </h2>
            <p>Conquer the sky at the luxury of your budget. Our choice of airlines and airplanes have different specifications for different needs. A quick trip to London? A sneek peek at Cape Town? Or a special visit to MrBeast? We are here to help. Join us on this exhilarating journey through the skies, where every click takes you closer to the thrilling realm of aviation excellence. Space ya Rubani – where the love for flight takes flight!</p>
        </div>
    </section>
    <!-- Products -->
    <section class="products" id="products">
        <div class="heading">
            <h2 id ="more"> Our Big Boys</h2>
        </div>
        <!-- Container -->
        <div class="products-container">
            <!-- List of items starts here -->
            
        <?php
        // Display uploaded images in the table
        while ($row = $result->fetch_assoc()) {
            echo "<div class='box'><img id = 'uploaded_img' src='{$row['image']}'></img>{$row['fullname']}<br>{$row['description']}<br>{$row['price']}</div>";
        }
        ?>

            
            
        </div>
    </section>

    <!-- Copyright -->
    <div class="copyright">
        <p>(C) 2023 Techstacity. Not Affiliated with Aviator!</p>
    </div>

	<!-- Link to JS -->
	<script src="main.js"></script>
</body>
</html>
