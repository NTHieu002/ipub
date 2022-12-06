@extends('layouts.app')

@section('content')
    <div class="hero page-inner overlay" style="background-image: url('../public/images/hero_bg_1.jpg');">

        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 id="title" class="heading" data-aos="fade-up"></h1>

                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center" style="font-size: 30px">
                            <li class="breadcrumb-item "><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item text-white-50 ">My Library</li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">Welcome Back {{ $user->name }}</li>
                        </ol>
                    </nav>


                </div>
            </div>


        </div>
    </div>

    <section class="features-1">
        <div class="container">
            <div class="row">
                <h4>Your Ebook</h4>
            </div>
            <br>
            <div class="row">
                @foreach ($user_book as $ebook )
                <div class="col-6 col-lg-3"  data-aos="fade-up" data-aos-delay="300">
                    <div class="box-feature">
                        <a href="{{ URL::to('/book/'. $ebook->book_slug) }}" class="img">
                            <img id="img-cover-{{ $ebook->id }}" alt="Image" class="img-fluid" srcset="">
                        </a>
                        <p style="margin-top: 20px"><a href="{{ URL::to('/book/'. $ebook->book_slug) }}" class="btn btn-primary floar-left">Read Now</a></p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
    </section>

    <div class="section"  id="upload">
		<div class="container">
            <div class="row">
                <h4>Upload Your Ebook</h4>
            </div>
            <br>
			<div class="row">
                
				<div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
					<div class="contact-info">

						<div class="address mt-2">
							<i class="fa-solid fa-book"></i>
							<h4 class="mb-2">Book Name:</h4>
							<p>The name of book which you like it</p>
						</div>
                        
						<div class="address mt-2">
                            <i class="fa-solid fa-book"></i>
							<h4 class="mb-2">Book:</h4>
							<p>Chosse book you want to upload</p>
						</div>

					</div>
				</div>
				<div class="col-lg-8" data-aos="fade-up" data-aos-delay="200" >
					<form action="{{ url('/store-book-user/'.$user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger col-4">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session('status'))
                            <div class="alert alert-success col-4">
                                {{ session('status')}}
                            </div>
                        @endif
						<div class="row">
							<div class="col-8 mb-3">
								<input type="text" class="form-control" placeholder="Book Name" onkeyup="ChangeToSlug()" name="book-name" id="slug">
							</div>
                            <div class="col-8 mb-3">
                                <input type="hidden" name="book-slug" class="form-control" placeholder="Book Slug" id="convert_slug">
                            </div>
                            <div class="col-8 mb-3">
								<input type="file" class="form-control" placeholder="Book Name" name="book">
							</div>
							<div class="col-12">
								<input type="submit" value="Upload now" class="btn btn-primary">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> <!-- /.untree_co-section -->
    <script type="text/javascript">
 
        function ChangeToSlug()
            {
                var slug;
             
                //Lấy text từ thẻ input title 
                slug = document.getElementById("slug").value;
                slug = slug.toLowerCase();
                //Đổi ký tự có dấu thành không dấu
                    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                    slug = slug.replace(/đ/gi, 'd');
                    //Xóa các ký tự đặt biệt
                    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                    //Đổi khoảng trắng thành ký tự gạch ngang
                    slug = slug.replace(/ /gi, "-");
                    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                    slug = slug.replace(/\-\-\-\-\-/gi, '-');
                    slug = slug.replace(/\-\-\-\-/gi, '-');
                    slug = slug.replace(/\-\-\-/gi, '-');
                    slug = slug.replace(/\-\-/gi, '-');
                    //Xóa các ký tự gạch ngang ở đầu và cuối
                    slug = '@' + slug + '@';
                    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                    //In slug ra textbox có id “slug”
                document.getElementById('convert_slug').value = slug;
            }
        
        @foreach ($user_book as $ebook )
        var book_{{ $ebook->id }} = ePub("../public/uploads/books/{{ $ebook->book }}");
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
    <script type="text/javascript">
        setTimeout(() => {
                document.getElementById("upload").scrollIntoView({
                    behavior: 'smooth'
                });
        }, 1000);
    </script>
@endsection
