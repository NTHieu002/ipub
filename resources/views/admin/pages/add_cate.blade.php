@extends('admin.index')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Add New Category</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="card-body">
                <p class="text-uppercase text-sm">Category Information</p>
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
                    <form action="{{ url('/store-cate') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="book-name" class="form-control-label">Category Name</label>
                                <input class="form-control" type="text" onkeyup="ChangeToSlug()" name="category-name" id="slug">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="book-slug" class="form-control-label">Category Slug</label>
                                <input class="form-control" type="text" name="category-slug" id="convert_slug">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="book-status" class="form-control-label">Category Status</label>
                                <select class="form-control" name="category-status" id=""> 
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
            var side_bar_item = $("#category");
            side_bar_item_active.removeClass('active');
            side_bar_item.addClass('active');
        });
    function ChangeToSlug()
        {
            var slug;
         
            //L???y text t??? th??? input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //?????i k?? t??? c?? d???u th??nh kh??ng d???u
                slug = slug.replace(/??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'a');
                slug = slug.replace(/??|??|???|???|???|??|???|???|???|???|???/gi, 'e');
                slug = slug.replace(/i|??|??|???|??|???/gi, 'i');
                slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'o');
                slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???/gi, 'u');
                slug = slug.replace(/??|???|???|???|???/gi, 'y');
                slug = slug.replace(/??/gi, 'd');
                //X??a c??c k?? t??? ?????t bi???t
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //?????i kho???ng tr???ng th??nh k?? t??? g???ch ngang
                slug = slug.replace(/ /gi, "-");
                //?????i nhi???u k?? t??? g???ch ngang li??n ti???p th??nh 1 k?? t??? g???ch ngang
                //Ph??ng tr?????ng h???p ng?????i nh???p v??o qu?? nhi???u k?? t??? tr???ng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //X??a c??c k?? t??? g???ch ngang ??? ?????u v?? cu???i
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox c?? id ???slug???
            document.getElementById('convert_slug').value = slug;
        }
   
</script>
@endsection