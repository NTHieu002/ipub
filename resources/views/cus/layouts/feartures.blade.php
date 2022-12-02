<section class="features-1">
    <div class="container">
        <div class="row">
            @foreach ($books as $ebook )
            <div class="col-6 col-lg-3"  data-aos="fade-up" data-aos-delay="300">
                <div class="box-feature">
                    <a href="{{'./book/'. $ebook->book_slug }}" class="img">
                        <img id="img-cover-{{ $ebook->id }}" alt="Image" class="img-fluid" srcset="">
                    </a>
                    <p style="margin-top: 20px"><a href="#" class="learn-more">Learn More</a></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
</section>