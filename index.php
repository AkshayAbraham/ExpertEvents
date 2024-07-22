<!---index.php : Company details page/Landing page -->
<?php
session_start();
if (isset($_SESSION["user_id"])) {
    //If session variable contains user_id then home_header.html will execute for header part otherwise header.html will execute
    if($_SESSION["role"] == 1){
        include "includes/home_header.html";
    }else{
        include "includes/user_home_header.html";
    }   
} else {
    include "includes/header.html";
}
?>
<!---HTML part for about us page -->
<div class="card" style="background-color: #fff;">
    <div class="container">
        <h2 class="indexHeader"><img src="img/event1.png" class="indexImg" alt="Unable to load"><b><span style="color:#910bea;">Your Event</span> <div class="indexP">Our <span class="indexSpan" style="">Expertise.</span></div></b><br><br><div><p class="indexP">Expert Events specalizes in professional event management services. Our experienced team brings CREATIVITY, PRECISION, and  ATTENTION to all detail to every event we manage, from corporate functions to weddings and beyond. Let us turn your vision into a flawless and unforgettable experience.</p></div></h2>     
    </div>
        <div><h1><b style="color: #e8b715;">Our Specialities</b></h1></div>
    <div class="container">
        <img class="assetImg" src="img/Asset3.png" alt="Unable to load">
    </div>

</div>
<h1 style="
    padding-top: 45px;
"><b><span class="indexP">Explore Us</span> </b></h1>
<div class="row exploreUsRow">
    <div class="column exploreUsColumn">
        <div class="card cardFont">
            <img src="img/party1.jpg" alt="Unable to load">
            <p class="exploreClass"><b>SUNBURN 2023</b></p>
            <p class="explorePara">One of the largest music festival in the UK attracting thousands of visitors from all over the world.</p>
        </div>
    </div>
    <div class="column exploreUsColumn">
        <div class="card cardFont">
            <img src="img/wedding1.jpg" alt="Unable to load">
            <p class="exploreClass"><b>CELEBRATION OF LOVE</b></p>
            <p class="explorePara">Join us for a celebration of love as we begin our happily ever after.Join us for a celebration of love as we begin.</p>
        </div>
    </div>
    <div class="column exploreUsColumn">
        <div class="card cardFont">
            <img src="img/wedding2.jpg" alt="Unable to load">
            <p class="exploreClass"><b>FOOD FESTIVAL</b></p>
            <p class="explorePara">One of the largest food festival in the UK attracting thousands of visitors from all over the world.</p>
        </div>
    </div>
    <div class="column exploreUsColumn">
        <div class="card cardFont">
            <img src="img/cooperate1.jpg" alt="Unable to load">
            <p class="exploreClass"><b>BIKER LAND</b></p>
            <p class="explorePara">One of the largest bike show in the UK attracting thousands of visitors from all over the world.</p>
        </div>
    </div>
</div>  

<?php include "includes/footer.html";
?>
