




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMURINZI</title>

    <style>
        /* Scroll to Top Button Styles */
        #scrollToTopBtn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 36px;
            height: 36px;
            border: none;
            border-radius: 50%;
            background-color: #f4f4f4;
            color: #000;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            display: none;
            z-index: 1000;
        }

        #scrollToTopBtn:hover {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>

   @include('layouts.header')
   @include('web.top')
   @include('web.getstarted')
   @include('web.about')
   @include('web.partners')
   @include('web.products2')
   @include('web.manage')
   @include('web.down')
   @include('web.solutions')
   @include('web.why')
   @include('web.connect')
   @include('web.modules')
   @include('web.try')
   @include('web.chatboot')
   @include('layouts.footer')


    <!-- Scroll to Top Button -->
    <button id="scrollToTopBtn" title="Go to top">↑</button>

    <script>
        // Show button after scrolling 300px
        const scrollToTopBtn = document.getElementById("scrollToTopBtn");

        window.addEventListener("scroll", () => {
            scrollToTopBtn.style.display = window.scrollY > 300 ? "block" : "none";
        });

        scrollToTopBtn.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    </script>
    
</body>
</html>
