{{-- banner --}}
<div class="hero">
    <div class="hero-slide">
        @foreach ($banner as $banner_item)
            <div class="img overlay" style="background-image: url('./public/uploads/images/{{ $banner_item->image }}')"></div>
        @endforeach
        
    </div>

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center">
                <h1 class="heading" data-aos="fade-up">Easiest way to read your dream book</h1>
                <form action="{{ url('search') }}"  method="GET" class="narrow-w form-search d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="200">
                    <input type="search" name="key" class="form-control px-4" placeholder="Book name or Author">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>