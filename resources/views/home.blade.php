@extends('layouts.app')

@section('content')

@include('cus.layouts.banner')

<div class="section">
    <div class="container">
        <div class="row mb-5 align-items-center">
            <div class="col-lg-6">
                <h2 class="font-weight-bold text-primary heading">Popular eBook</h2>
            </div>
            <div class="col-lg-6 text-lg-end">
                <p><a href="#" target="_blank" class="btn btn-primary text-white py-3 px-4">View all eBook</a></p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="property-slider-wrap">
                    <div class="property-slider">
                        @foreach ($books as $ebook )

                            <div class="property-item">

                                <a href="{{'./book/'. $ebook->book_slug }}" class="img">
                                    <img id="cover-{{ $ebook->id }}" alt="Image" class="img-fluid" srcset="">
                                </a>

                                <div class="property-content">
                                    <div class="price mb-2"><span>$19</span></div>
                                    <div>
                                        <span id="title-{{ $ebook->id }}" class="d-block mb-2 text-black-100"></span>
                                        <span class="city d-block mb-3">{{ $ebook->book_name }}</span>

                                        <div class="specs d-flex mb-4">
                                            <span class="d-block d-flex align-items-center me-3">
                                                <i class="fa-solid fa-pen-nib"></i> &nbsp;
                                                <span id="author-{{ $ebook->id }}"></span>
                                            </span>
                                        </div>

                                        <a href="{{'./book/'. $ebook->book_slug }}" class="btn btn-primary py-2 px-3">Read book</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>


                    <div id="property-nav" class="controls" tabindex="0" aria-label="Carousel Navigation">
                        <span class="prev" data-controls="prev" aria-controls="property" tabindex="-1">Prev</span>
                        <span class="next" data-controls="next" aria-controls="property" tabindex="-1">Next</span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


@include('cus.layouts.feartures')

<div class="section">
    <div class="row justify-content-center footer-cta" data-aos="fade-up">
        <div class="col-lg-7 mx-auto text-center">
            <h2 class="mb-4 ">Upload ebook and Be part of the ebook community</h2>
            <p><a href="{{ url('/my-library/'.Auth::user()->id) }}" target="_blank" class="btn btn-primary text-white py-3 px-4">Read your ebok now</a></p>
        </div> <!-- /.col-lg-7 -->
    </div> <!-- /.row -->
</div>

<script type="text/javascript">
    @foreach ($books as $ebook )
        var book_{{ $ebook->id }} = ePub("./public/uploads/books/{{ $ebook->book }}");
        
        var cover_{{ $ebook->id }} = document.getElementById("cover-{{ $ebook->id }}");
        var img_cover_{{ $ebook->id }} = document.getElementById("img-cover-{{ $ebook->id }}");
        book_{{ $ebook->id }}.coverUrl().then(function(url){
            cover_{{ $ebook->id }}.src = url;
            img_cover_{{ $ebook->id }}.src = url;
        })
        var title_{{ $ebook->id }} = document.getElementById("title-{{ $ebook->id }}");
        var author_{{ $ebook->id }} = document.getElementById("author-{{ $ebook->id }}");
        book_{{ $ebook->id }}.loaded.metadata.then(function(meta){
            title_{{ $ebook->id }}.textContent = meta.title;
            author_{{ $ebook->id }}.textContent = meta.creator;
            // console.log(meta);
        })

        
    @endforeach
</script>

@endsection
