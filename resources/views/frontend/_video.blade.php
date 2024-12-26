<!-- Video Section -->
<section id="video" class="gallery section light-background">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Video</h2>
        <p><span>Check</span> <span class="description-title">Our Video Gallery</span></p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
            <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "centeredSlides": true,
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 0
                },
                "768": {
                  "slidesPerView": 3,
                  "spaceBetween": 20
                },
                "1200": {
                  "slidesPerView": 5,
                  "spaceBetween": 20
                }
              }
            }
          </script>
            <div class="swiper-wrapper align-items-center">

                @foreach ($videos as $video)
                    <div class="swiper-slide">
                        <div class="embed-responsive embed-responsive-16by9">
                            <a class="glightbox" data-gallery="images-gallery"
                            href="https://www.youtube.com/watch?v={{ $video->link }}?autoplay=1">
                                <img src="https://img.youtube.com/vi/{{ $video->link }}/hqdefault.jpg" class="img-fluid" alt="{{ $video->name }}">
                            </a>
                        </div>
                    </div>

                @endforeach

            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>



</section><!-- /Gallery Section -->

