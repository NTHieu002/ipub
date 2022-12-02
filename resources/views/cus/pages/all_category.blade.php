@extends('layouts.app')

@section('content')
    <div class="hero page-inner overlay" style="background-image: url('http://localhost/ipub/public/images/hero_bg_1.jpg');">

        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading" data-aos="fade-up">Category</h1>

                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item "><a href="{{ URL::to('/') }}">Home</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    @foreach ($cate as $book_cate_item )
    <section class="features-1">
        <div id="{{ strtolower($book_cate_item['category_name']) }}" class="container">
            <div class="row">
                <h4>{{ $book_cate_item['category_name'] }}</h4>
            </div>
            <br>
            <div class="row">
                @foreach ($book_cate_item->books as $ebook )
                <div class="col-6 col-lg-3"  data-aos="fade-up" data-aos-delay="300">
                    <div class="box-feature">
                        <a href="{{ URL::to('/book/'. $ebook->book_slug) }}" class="img">
                            <img id="img-cover-{{ $ebook->id }}" alt="Image" class="img-fluid" srcset="">
                        </a>
                        <p style="margin-top: 20px"><a href="{{ URL::to('/book/'. $ebook->book_slug) }}" class="learn-more">Read Now</a></p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
    </section>
        
    

    <script type="text/javascript">
    
        @foreach ($book_cate_item->books as $ebook )
            @if (isset($slug_category))
                var book_{{ $ebook->id }} = ePub("../public/uploads/books/{{ $ebook->book }}");
            @else
                var book_{{ $ebook->id }} = ePub("./public/uploads/books/{{ $ebook->book }}");    
            @endif
            var img_cover_{{ $ebook->id }} = document.getElementById("img-cover-{{ $ebook->id }}");
            book_{{ $ebook->id }}.coverUrl().then(function(url){
                img_cover_{{ $ebook->id }}.src = url;
            })
            // var title_{{ $ebook->id }} = document.getElementById("title-{{ $ebook->id }}");
            // var author_{{ $ebook->id }} = document.getElementById("author-{{ $ebook->id }}");
            // book_{{ $ebook->id }}.loaded.metadata.then(function(meta){
            //     title_{{ $ebook->id }}.textContent = meta.title;
            //     author_{{ $ebook->id }}.textContent = meta.creator;
            //     // console.log(meta);
            // })   
        @endforeach

        </script>
    @endforeach
    <script type="text/javascript">
        setTimeout(() => {
            @if (isset($slug_category))
                document.getElementById("{{ $slug_category }}").scrollIntoView({
                    behavior: 'smooth'
                });
            @endif
        }, 1000);
    </script>
@endsection