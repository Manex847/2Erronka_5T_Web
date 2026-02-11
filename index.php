<!doctype html>
<html lang="eu">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BirtekIndex</title>
    <link rel="stylesheet" href="styles.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />

    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"
    />
  </head>
  <body>
    <?php
    include "Menua.php";
    ?>

    <main>
      <section class="slogana">
        <h1>BIRTEK</h1>
        <h4>BIRziklatu TEKnologia eta bigarren bizitza bat eman</h4>
      </section>
      <section class="slidermain">
        <div class="dispositibamultzoa autoplay">
          <div width="100%" class="Slider1">
            <img
              src="Argazkiak/Slider/AsusVisionM1.jpeg"
              alt="Asus Vision M1"
              style="width: 50%"
            />
          </div>
          <div width="100%" class="Slider1">
            <img
              src="Argazkiak/Slider/PcGamer.webp"
              alt="PCGamer"
              style="width: 50%"
            />
          </div>
          <div width="100%" class="Slider1">
            <img
              src="Argazkiak/Slider/Iphone17.webp"
              alt="Iphone17"
              style="width: 50%"
            />
          </div>
          <div width="100%" class="Slider1">
            <img
              src="Argazkiak/Slider/Ps5Pro.webp"
              alt="Ps5PPro"
              style="width: 50%"
            />
          </div>
          <div width="100%" class="Slider1">
            <img src="Argazkiak/Slider/Tele.webp" alt="Tv" style="width: 50%" />
          </div>
        </div>
      </section>

      <section>
        
          <a class="erosibotoia" href="Produktuak.php">IKUSI PRODUKTUAK</a>
        
      </section>

      <section class="asoziatuak">
        <img
          src="Argazkiak/MicrosoftLogo.webp"
          alt="MicrosoftLogo"
          width="100px"
        />

        <img
          src="Argazkiak/AsusLogo.webp"
          alt="AsusLogo"
          width="100px"
        />

        <img
          src="Argazkiak/GoogleLogo.webp"
          alt="GoogleLogo"
          width="100px"
        />

        <img
          src="Argazkiak/BlackMagicLogo.webp"
          alt="BlackMagicLogo"
          width="100px"
        />
      </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script>
      $(document).ready(function () {
        $(".autoplay").slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 2000,
          dots: true,
          arrows: false,
          infinite: true,
          responsive: [
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 1,
              },
            },
          ],
        });
      });

    </script>
  </body>
</html>
