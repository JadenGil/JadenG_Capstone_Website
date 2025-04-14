<!DOCTYPE html>
<html>
<head>
<title>WNFC Esports Dojo</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="icon" type="image/png" href="{{ asset('/images/logoblack.png') }}">
<style>
body, h1, h2, h3, h4, h5, h6 {
    font-family: "Raleway", sans-serif;
    margin: 0;
    padding: 0;
}

body, html {
    height: 100%;
    line-height: 1.8;
}

.bgimg-1 {
    position: relative;
    background: url('/images/insidedojo.png') center/cover no-repeat;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.black-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: rgba(0, 0, 0, 0.7);
    width: 90%;
    max-width: 1200px;
    padding: 20px;
    border-radius: 10px;
    margin: 0 auto;
}

.video-container {
    flex: 1;
    max-width: 50%;
}

.video-container iframe {
    width: 100%;
    aspect-ratio: 16 / 9;
}

.text-right {
    flex: 1;
    color: white;
    font-size: 32px;
    font-weight: bold;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-end;
    text-align: right;
    padding-left: 20px;
}

@media (max-width: 1024px) {
    .black-bar {
        flex-direction: column;
        text-align: center;
        padding: 15px;
        margin-top: 20px;
    }

    .video-container {
        max-width: 100%;
    }

    .text-right {
        align-items: center;
        text-align: center;
        padding-left: 0;
        margin-top: 10px;
    }
}

.about-section {
    text-align: center;
    width: 80%;
    margin: 0 auto;
    max-width: 1000px;
    padding: 20px;
}

.about-header {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin-bottom: 20px;
}

.about-heading {
    font-size: 2em;
    font-weight: bold;
    line-height: 1.2;
}

.about-subheading {
    font-size: 1.25em;
    color: #666;
    margin-top: 10px;
}

.about-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 30px;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
}

.about-item:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
}

.about-text {
    flex: 1;
    max-width: 45%;
    padding-right: 10px;
}

.about-text h3 {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 10px;
}

.about-text h4 {
    font-size: 1rem;
    color: #666;
    margin-bottom: 10px;
    color: inherit;
    text-decoration: none;
}

.about-text a h4:hover {
    color: blue; /* Change color to blue on hover */
    background-color: rgba(0, 0, 255, 0.1); /* Optional: Add a subtle background color for hover effect */
    padding: 0.2em; /* Optional: Add padding to give a slight "highlight" effect */
}

.about-text p {
    font-size: 1rem;
    line-height: 1.6;
    margin-top: 10px;
}

.about-image {
    flex: 1;
    max-width: 45%;
}

.about-image img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: 10px;
}

@media (max-width: 768px) {
    .about-item {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }

    .about-text {
        max-width: 100%;
        padding: 0 10px;
    }

    .about-image {
        max-width: 100%;
    }

    .about-image img {
        height: auto;
        max-height: 250px;
    }

    .headline-bar h1 {
        font-size: 5vw;
        white-space: normal;
    }
}

.headline-bar {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    width: 100%;
}

.sponsor-section {
    position: relative;
    background: url('/images/AOF3-Gas.png') center/cover no-repeat;
    height: 300px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
}

.sponsor-link {
    text-decoration: none;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.sponsor-text {
    color: black;
    font-size: 24px;
    font-weight: 300;
    margin-bottom: 28px;
    text-shadow: 1px 1px 3px rgba(255,255,255,0.8);
}

.sponsor-logo {
    max-width: 200px;
    height: auto;
    transition: transform 0.3s ease;
}

.sponsor-logo:hover {
    transform: scale(1.05);
}

#startgg-hub {
    margin: 20px auto;
    padding: 20px;
    max-width: 800px;
    background-color: #1e1e1e;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
}

#startgg-hub h2 {
    color: #ffffff;
    font-size: 24px;
    margin-bottom: 10px;
}

.startgg-button {
    display: inline-block;
    background-color: #d91a60;
    color: white;
    padding: 10px 20px;
    font-size: 18px;
    font-weight: bold;
    text-decoration: none;
    border-radius: 5px;
    transition: 0.3s ease;
}

.startgg-button:hover {
    background-color: #b31550;
}

</style>
</head>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-card" id="myNavbar">
    <a href="#home" class="w3-bar-item w3-button w3-wide">
        <img src="/images/logowhit.png" alt="logo" style="height: 40px;">
    </a>
    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small">
      <a href="#about" class="w3-bar-item w3-button">ABOUT</a>
      <a href="#pricing" class="w3-bar-item w3-button"><i class="fa fa-usd"></i> PRICING</a>
      <a href="#contact" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i> CONTACT</a>
      <a href="{{ route('login') }}" class="w3-bar-item w3-button"><i class="fa fa-user"></i> LOGIN</a>
      <a href="{{ route('register') }}" class="w3-bar-item w3-button"><i class="fa fa-user"></i>REGISTER</a>
    </div>
    <!-- Hide right-floated links on small screens and replace them with a menu icon -->
    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
  <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button">ABOUT</a>
  <a href="#pricing" onclick="w3_close()" class="w3-bar-item w3-button">PRICING</a>
  <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button">CONTACT</a>
</nav>

<!-- Header with full-height image -->
<header class="bgimg-1 w3-display-container w3-grayscale-min" id="home">
  <!-- Black bar in the center -->
  <div class="w3-display-middle black-bar">
    <!-- Left side (YouTube Video) -->
    <div class="video-container">
      <iframe src="https://www.youtube.com/embed/10Ag5BhROC0?si=3DpmUaXj7PHY4ZvP" title="WNFC esports Dojo - Launch Video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>
    <!-- Right side (Text) -->
    <div class="text-right">
        <p class="vertical-text">
            Community.<br>
            Camaraderie.<br>
            Competition.<br>
            Everyone Belongs.
        </p>
    </div>
</header>

<!-- About Section -->
<div class="about-section" id="about">
    <p class="about-subheading">No matter who you are or how you identify.</p>
    <h2 class="about-heading size-custom">There’s a place here for you.</h2>


    <div class="about-container">
        <div class="about-item">
            <div class="about-image">
                <img src="/images/insidedojo.png" alt="Main Room">
            </div>
                <div class="about-text">
                    <h4>An Extracurricular Activity</h4>
                    <h3 class="sh-heading-contect size-1 text-left">FOR FUTURE LEADERS AND WINNERS </h3>
                    <p>We’re building a community of kids and teens that push one another to be their best selves in an environment that focuses on fun. It’s more than pushing buttons, it’s giving our students experience in how to handle hardship and conquer challenge while being surrounded by “their own kind.”</p>
                </div>
            </div>
        </div>

        <div class="about-item">
            <div class="about-text">
                <h4>The Road To The World Stage</h4>
                <h3>BEGINS IN YOUR OWN NEIGHBORHOOD</h3>
                <p>We focus on arcade-style “versus” games, the genre that first popularized direct competitive play. Today, these games are played at tournaments that are watched live by thousands of fellow players, plus millions of streaming viewers around the globe. <b>This is the world we’re ambassadors of.</b></p>
            </div>
            <div class="about-image">
                <img src="/images/evomain.png" alt="FG Tournament">
            </div>
        </div>

        <div class="about-item">
            <div class="about-image">
                <img src="/images/players.png" alt="Players Competing">
            </div>
            <div class="about-text">
                <h4>Go Beyond The Game</h4>
                <h3>INTO A FUTURE OF POSSIBILITIES</h3>
                <p>We have the privilege of being partnered with Champlain College esports, one of the best collegiate esports programs in the country. This lets us introduce our dojo students to a wide array of paths for their college career, including game design, electronic hardware, webcasting, video production, software development, esports scholarships, and more. <b>This can be life-altering.</b></p>
            </div>
        </div>

        <div class="about-item">
            <div class="about-text">
                <h4>We Foster Inclusion & Diversity</h4>
                <h3>BECAUSE COMMUNITY IS STRENGTH</h3>
                <p>It doesn’t matter how you identify or what sort of experience or skill level you have, <b>you’re welcome here,</b> with no limits on who can participate. Our instructors will meet you where you are, and our curriculum is designed to let students work through concepts and towards goals at their own pace.</p>
            </div>
            <div class="about-image">
                <img src="/images/community.png" alt="community photo">
            </div>
        </div>
    </div>
</div>

<!-- Headline bar -->
<div class="w3-container w3-light-blue" style="padding:128px 16px">
  <div class="w3-row-padding">
    <div class="w3-col m12 headline-bar">
        <h1><i><b>WNFC esports Dojo is making headlines!</i></b></h1>
    </div>
  </div>
</div>

<!-- Headline Section -->
<div class="about-section" id="headlines">
    <div class="about-container">
        <div class="about-item">
            <div class="about-image">
                <img src="/images/mychamp.png" alt="My Champlain">
            </div>
                <div class="about-text">
                    <a href="https://www.mychamplainvalley.com/news/local-news/esports-dojo-arena-looks-to-build-grassroots-gaming-community-in-vermont/" target="_blank"><h4>MyChamplainValley.com</h4></a>
                    <h3 class="sh-heading-contect size-1 text-left">ABC22 - WVNY</h3>
                    <p>"The dojo aims to provide an avenue for players to hone their skills and become part of a community. With a growing number of colleges adopting esports programs…"</p>
                </div>
            </div>
        </div>

        <div class="about-item">
            <div class="about-text">
                <a href="https://www.vermontpublic.org/show/vermont-edition/2024-03-12/how-vermont-gamers-are-expanding-the-esports-industry" target="_blank"><h4>Vermont Public</h4></a>
                <h3>VPR - WVPS 107.9FM </h3>
                <p>"It takes a village to create a video game. From narrative designers to programmers to marketers, many people have to work together. We learn about what it takes to design a successful video game, which something that Vermonters can learn at Champlain College in Burlington. We also talk to the head of WNFC esports Dojo in Essex Junction about the opportunities for kids and teens to get into competitive gaming."</p>
            </div>
            <div class="about-image">
                <img src="/images/vtpub.png" alt="Vermont Public">
            </div>
        </div>

        <div class="about-item">
            <div class="about-image">
                <img src="/images/family.png" alt="Grant and Daves Kids">
            </div>
            <div class="about-text">
                <a href="https://www.vermontpublic.org/2024-10-04/vermonts-fighting-video-game-scene-spurs-competition-and-camaraderie" target="_blank"><h4>Vermont Public Digital</h4></a>
                <h3>VERMONTPUBLIC.COM</h3>
                <p>"I spoke with three grade-school-aged students who turned the interview around on me, asking me what character I’d like to see in Super Smash Brothers. That’s a timeless hypothetical question, one that I have been thinking about since 2001"</p>
            </div>
        </div>
        </div>
    </div>
</div>

<!-- Sponsor Shoutout! -->
<div class="sponsor-section">
    <a href="https://esports.champlain.edu/" class="sponsor-link">
        <p class="sponsor-text"><b>Graciously Sponsored By</b></p>
        <img src="/images/CCE-Logo.png" alt="Champlain Esports" class="sponsor-logo">
    </a>
</div>

<!-- Start.gg Integration -->
<div id="startgg-hub">
    <h2>Check out our upcoming events!</h2>
    <a href="https://www.start.gg/hub/wednesday-night-fight-club-2025-bi-weekly-series" target="_blank" class="startgg-button">
        Visit Our Start.gg Hub
    </a>
</div>


<!-- Modal for full size images on click-->
<div id="modal01" class="w3-modal w3-black" onclick="this.style.display='none'">
  <span class="w3-button w3-xxlarge w3-black w3-padding-large w3-display-topright" title="Close Modal Image">×</span>
  <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
    <img id="img01" class="w3-image">
    <p id="caption" class="w3-opacity w3-large"></p>
  </div>
</div>

<!-- Pricing Section -->
<div class="w3-container w3-center w3-dark-grey" style="padding:128px 16px" id="pricing">
  <div class="w3-row-padding" style="margin-top:64px; display: flex; justify-content: center; align-items: center; text-align: center;">
    
    <!-- Left Side Text -->
    <div class="w3-half" style="text-align: center; margin-right: 20px;"> <!-- Added margin-right to push the text closer to the box -->
      <p class="w3-xlarge" style="margin-bottom: 10px;">Ready to begin?</p>
      <p style="font-size: 80px; font-weight: bold; line-height: 0.9; margin-top: 0; transition: color 0.3s;" 
         class="w3-hover-text-light-blue">
        <span style="display: block;">THE</span>
        <span style="display: block;">JOURNEY</span>
        <span style="display: block;">STARTS</span>
        <span style="display: block;">HERE.</span>
      </p>
    </div>

    <!-- Pricing Box -->
    <div class="w3-third" style="text-align: center;">
      <ul class="w3-ul w3-white w3-hover-shadow" style="margin-top: 0;">
        <li class="w3-red w3-xlarge w3-padding-48">Tue / Wed / Thu</li>
        <li class="w3-padding-16"><i><b>MASSIVE VALUE!</b></i> - Under $7/hr for most 3d/wk students!</li>
        <li class="w3-padding-16"><i><b>Grades 4 - 12</b></i> (ages 9 - 17)</li>
        <li class="w3-padding-16"><b>2pm - 6pm</b></li>
        <li class="w3-padding-16"><i><b>Three Days of Instruction</b></i> Per Week</li>
        <li class="w3-padding-16">
          <h1 class="w3-wide">$200</h1>
          <span class="w3-opacity">(per month)</span>
        </li>
        <li class="w3-light-grey w3-padding-24">
        </li>
      </ul>
    </div>

  </div>
</div>

<!-- Contact Section -->
<div class="w3-container w3-light-blue" style="padding:128px 16px" id="contact">
  <h2 style="text-align: center;"><i>Don't hesitate!</i> Call or email us today about getting started!</h2>

    <!-- Contact Info in a Row -->
    <div style="margin-top:48px; display: flex; justify-content: center; gap: 40px; align-items: center; flex-wrap: wrap;">
    <p>
        <i class="fa fa-map-marker fa-fw w3-xxlarge"></i> 
        <a href="https://www.google.com/maps/dir//46+Pearl+Street,+Essex+Junction+VT+05452" target="_blank" style="text-decoration: none; color: inherit;">
        46 Pearl Street, Essex Junction VT 05452
        </a>
    </p>
    <p><i class="fa fa-phone fa-fw w3-xxlarge"></i> (802) 310-3550</p>
    <p><i class="fa fa-envelope fa-fw w3-xxlarge"></i> dojo@wnfcesd.com</p>
    </div>


  <!-- Business Hours -->
  <div style="margin-top: 48px; text-align: center;">
    <h3><i class="fa fa-clock-o"></i> Open Hours</h3>
    <p><strong>Afterschool Program</strong><br>Tuesday – Thursday, 2pm – 6pm</p>
    <p><strong>Field Trips / In-School Events</strong><br>Monday & Friday, By Appointment Only</p>
    <p><strong>Wednesday Night Fight Club</strong> <br>(Fighting Game Community Weeklies) <br> Wednesday Nights, 6pm – 11pm <br> (16+ w/ parent permission, 18+ otherwise)</p>
  </div>
</div>

<!-- Footer -->
<footer class="w3-center w3-black w3-padding-64">
  <a href="#home" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
  <div class="w3-xlarge w3-section">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
  </div>
  <p>© 2023 WNFC LLC</p>
</footer>
 
<script>
// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}


// Toggle between showing and hiding the sidebar when clicking the menu icon
var mySidebar = document.getElementById("mySidebar");

function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
  } else {
    mySidebar.style.display = 'block';
  }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
}
</script>

</body>
</html>