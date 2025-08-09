<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Image Carousel</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #0A1128;
    }

    .section-container {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 40px 20px;
      gap: 20px;
      flex-wrap: wrap;
      background: #0A1128;
    }

    .carousel-wrapper {
      width: 1000px;
      max-width: 100%;
      height:100vh;
    }

    .carousel-container {
      position: relative;
      width: 100%;
      height: 280px;
      border-radius: 6px;
      overflow: hidden;
    }

    .slide {
      position: absolute;
      width: 100%;
      height: 100%;
      display: none;
    }

    .slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .slide.active {
      display: block;
      animation: fade 0.8s ease-in-out;
    }

    @keyframes fade {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .dots {
      text-align: center;
      margin-top: 10px;
    }

    .dot {
      height: 10px;
      width: 10px;
      margin: 0 4px;
      background-color: #bbb;
      border-radius: 50%;
      display: inline-block;
      transition: background-color 0.3s ease;
      cursor: pointer;
    }

    .dot.active {
      background-color: rgb(255, 182, 0);
    }

    .hero-tagline {
    font-size: 4.5rem;         /* large font */
    font-weight: 600;          /* bold and clear */
    color: white;              /* white text */
    text-align: center;        /* center aligned */
    padding: 1.5rem 1rem;      /* breathing space */
    margin: 0;
    font-family: 'Inter', sans-serif; /* clean modern font */
}
.hero-subtext {
    font-size: 1rem;
    font-weight: 400;
    color: white;
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
    padding: 1rem 1.5rem;
    font-family: 'Inter', sans-serif;
    line-height: 1.6;
}
  </style>
</head>
<body>

<div class="section-container">
  <div class="carousel-wrapper">
    <div class="carousel-container">
      <div class="slide active">
        <img src="{{asset('images/support.png')}}" alt="Slide 1">
      </div>
      <div class="slide">
        <img src="{{asset('images/support2.png')}}" alt="Slide 2">
      </div>
      <div class="slide">
        <img src="{{asset('images/support3.png')}}" alt="Slide 3">
      </div>
      <div class="slide">
        <img src="{{asset('images/support4.png')}}" alt="Slide 4">
      </div>
    </div>
    <div class="dots">
      <span class="dot active" onclick="showSlide(0)"></span>
      <span class="dot" onclick="showSlide(1)"></span>
      <span class="dot" onclick="showSlide(2)"></span>
      <span class="dot" onclick="showSlide(3)"></span>
    </div>
      <p class="hero-tagline">Manage and Grow your <br> business with ease</p>

      <p class="hero-subtext">
      UMURINZI empowers local entrepreneurs with smart tools to streamline sales, monitor stock, <br> and grow customer loyalty — Designed for small businesses <br> across Africa.
      </p>
  </div>
</div>
<script>
  let currentSlide = 0;
  const slides = document.querySelectorAll('.slide');
  const dots = document.querySelectorAll('.dot');

  function showSlide(index) {
    slides.forEach((slide, i) => {
      slide.classList.remove('active');
      dots[i].classList.remove('active');
    });
    slides[index].classList.add('active');
    dots[index].classList.add('active');
    currentSlide = index;
  }

  setInterval(() => showSlide((currentSlide + 1) % slides.length), 4000);
</script>

</body>
</html>
