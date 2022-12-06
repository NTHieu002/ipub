@extends('admin.index')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>
                        All Banner /
                        <a href="{{ url('/admin/banner-upload') }}"
                            class=" badge badge-sl text-secondary font-weight-bold  bg-gradient-info text-white"
                            data-toggle="tooltip" data-original-title="Edit user">
                            Add New
                        </a>
                    </h6>
                    @if (session('status'))
                    <div id="alert" class="alert alert-success col-md-6 float-right">
                        {{ session('status') }}
                    </div>
                    @endif
                </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        {{-- <h6 class="text-uppercase text-secondary text-x font-weight-bolder opacity-9 text-black"
                            style="margin-left: 23px">{{ $book_cate_item['category_name'] }} / <span class="text-white badge badge-sm bg-gradient-info">{{ $book_cate_item->books_count }}</span> Books</h6> --}}

                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Number</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Banner
                                        </th>
                                        {{-- <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Author</th> --}}
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($banners as $banner)
                                        <tr>
                                            <td>
                                                <p class="text-l font-weight-bold mb-0" style="margin-left: 30px">{{ $i++ }}
                                                </p>
                                            </td>
                                            <td>
                                                <div class="d-flex  py-1">
                                                  <div>
                                                    <img id="banner" src="http://localhost/ipub/public/uploads/images/{{ $banner->image }}" class="avatar avatar-xl me-3" alt="book-1">
                                                  </div>
                                                </div>
                                              </td>
                                            {{-- <td>
                                                <p class="text-l font-weight-bold mb-0">{{ $ebook->book_name }}
                                                </p>
                                            </td> --}}
                                            {{-- <td class="align-middle text-center">
                                                <span id="author-{{ $ebook->id }}" class="text-secondary text-l font-weight-bold"></span>
                                            </td> --}}
                                            <td class="align-middle text-center text-sm">
                                                @if ($banner->banner_status == 0)
                                                    <span class="badge badge-sm bg-gradient-success"><a class="text-white"
                                                            href="{{ url('/banner-offline/' . $banner->image_id) }}">Online</a></span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-danger"><a class="text-white"
                                                            href="{{ url('/banner-online/' . $banner->image_id) }}">Offline</a></span>
                                                @endif
                                            </td>
                                            {{-- <td class="align-middle">
                                                <a href="{{ url('/admin/banner/edit-banner/'.$banner->image_id) }}"
                                                    class=" badge badge-sl text-secondary font-weight-bold text-l bg-gradient-info text-white"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    Edit
                                                </a>
                                            </td> --}}
                                            <td class="align-middle">
                                                <a href="{{ url('/delete-banner/' . $banner->image_id) }}"
                                                    class="badge badge-sm bg-gradient-danger text-white text-secondary font-weight-bold text-l "
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
   
    {{-- <script type="text/javascript">
        @foreach ($cate as $book_cate_item )
            @foreach ($book_cate_item->books as $ebook )
                var book_{{ $ebook->id }} = ePub("http://localhost/ipub/public/uploads/books/{{ $ebook->book }}");
                console.log()
                var img_cover_{{ $ebook->id }} = document.getElementById("img-cover-{{ $ebook->id }}");
                book_{{ $ebook->id }}.coverUrl().then(function(url){
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
            
        @endforeach

    </script> --}}
    <script type="text/javascript">
        const myTimeout = setTimeout(nofty, 1500);

        function nofty() {
            try {
                document.getElementById("alert").remove();
            } catch (error) {

            }
        }
    </script>
@endsection
