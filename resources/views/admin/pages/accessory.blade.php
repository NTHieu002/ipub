@extends('admin.index')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Upload eBook</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="card-body">
                <p class="text-uppercase text-sm">eBook Information</p>
                <div class="row">
                    @if ($errors->any())
                        <div class="alert alert-danger col-md-9">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session('status'))
                        <div class="alert alert-success col-md-9">
                            {{ session('status')}}
                        </div>
                    @endif
                    <form action="{{ url('/store-book') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="book-name" class="form-control-label">Book Name</label>
                                <input class="form-control" type="text" onkeyup="ChangeToSlug()" name="book-name" id="slug">
                            </div>
                        </div>
                        {{-- <div class="col-md-9">
                            <div class="form-group">
                                <label for="book-img" class="form-control-label">Book Image</label>
                                <input class="form-control" type="file" name="book_img" id="">
                            </div>
                        </div> --}}
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="book-desc" class="form-control-label">Book Description</label>
                                <textarea class="form-control" type="text" name="book-desc" id=""></textarea>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="book" class="form-control-label">Book</label>
                                <input class="form-control" type="file" name="book" id="">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="book-slug" class="form-control-label">Book Slug</label>
                                <input class="form-control" type="text" name="book-slug" id="convert_slug">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="book-status" class="form-control-label">Book Category</label>
                                <select class="form-control" name="book-category" id=""> 
                                    @foreach ($cate as $cat_item )
                                        <option value="{{ $cat_item->category_id }}">{{ $cat_item->category_name }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="book-status" class="form-control-label">Book Status</label>
                                <select class="form-control" name="book-status" id=""> 
                                    <option value="0">Active</option>
                                    <option value="1">UnActive</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg ms-auto" data-toggle="tooltip" data-original-title="Edit user">
                            Summit
                        </button>
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
            var side_bar_item_active = $("ul li.nav-item a.active");
            // side_bar_item.addClass('hello')
            // side_bar_item.removeClass('active');
            var side_bar_item = $("#accessory");
            side_bar_item_active.removeClass('active');
            side_bar_item.addClass('active');
        });
 
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
   
</script>
@endsection