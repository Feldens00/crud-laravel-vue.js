@php 
    $slides = DB::table('slides')->get();

@endphp

<!-- ======= Hero Section ======= -->
<section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <div class="carousel-inner" role="listbox">

        <!-- Slides -->
        @foreach($slides as $key => $slide)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" style="background-image: url( {{ asset($slide->image) }} );">
                <div class="carousel-container">
                    <div class="carousel-content animate__animated animate__fadeInUp">
                    <h2>{{ $slide->title }}</h2>
                    <p>{{ $slide->description }}</p>
                    <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
                    </div>
                </div>
            </div>
        @endforeach

       
      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    </div>
  </section>
  <!-- End Hero -->