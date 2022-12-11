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
                            <li class="breadcrumb-item text-white-50 ">Profile</li>
                            <li class="breadcrumb-item text-white-50">{{ Auth::user()->name }}</li>
                        </ol>
                        <ol class="breadcrumb text-center justify-content-center" style="font-size: 30px">
                            <li class="breadcrumb-item text-white-50 ">
                                <img src="{{ asset('/public/images') }}/{{ $user->image }}" class="rounded-circle"
                                    style="width: 150px;" alt="Avatar" />
                            </li>
                        </ol>
                    </nav>


                </div>
            </div>


        </div>
    </div>
    {{-- 
    <section class="features-1">
        <div class="container">
            <div class="row">
                <h4>Your Prodfile</h4>
            </div>
            <br>
            <div class="row">
                @foreach ($user_book as $ebook)
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
        
    </section> --}}

    <div class="section" id="upload">
        <div class="container">
            <div class="row">
                <h4>Edit your profile</h4>
            </div>
            <br>
            <div class="row">

                <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
                    <div class="contact-info">

                        <div class="address mt-2">
                            <i class="fa-solid fa-book"></i>
                            <h4 class="mb-2">User Name:</h4>
                            <p>The name of you</p>
                        </div>

                        <div class="address mt-2">
                            <i class="fa-solid fa-book"></i>
                            <h4 class="mb-2">Avatar:</h4>
                            <p>Chosse your avatar</p>
                        </div>

                    </div>
                </div>
                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                    <form action="{{ url('/store-profile/' . Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger col-8">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('status'))
                            <div class="alert alert-success col-8">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-8 mb-3">
                                <input type="text" class="form-control" placeholder="Book Name" name="user_name"
                                    value="{{ Auth::user()->name }}">
                                <input type="hidden" value="{{ $user->role_id }}" name="role_id">
                            </div>
                            <div class="col-8 mb-3">
                                <img id="img-preview" src="{{ asset('/public/images') }}/{{ $user->image }}" class="rounded-circle" style="width: 100px;" alt="Avatar" />

                                <input accept="image/*" id="file-input" type="file" name="user_avt" class="form-control"
                                    placeholder="Upload your avatar">
                            </div>

                            <div class="col-12">
                                <input type="submit" value="Update now" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- /.untree_co-section -->
    <script type="text/javascript">
        function ChangeToSlug() {
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
    </script>
    <script type="text/javascript">
        const input = document.getElementById('file-input');
        const image = document.getElementById('img-preview');
        input.addEventListener('change', (e) => {
            if (e.target.files.length) {
                const src = URL.createObjectURL(e.target.files[0]);
                image.src = src;
            }
        });
    </script>
@endsection
