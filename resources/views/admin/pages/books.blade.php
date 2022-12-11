@extends('admin.index')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>
                        All Book /
                        <a href="{{ url('/admin/accessory') }}"
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
                @foreach ($cate as $book_cate_item)
                    <div class="card-body px-0 pt-0 pb-2">
                        <h6 class="text-uppercase text-secondary text-x font-weight-bolder opacity-9 text-black"
                            style="margin-left: 23px">{{ $book_cate_item['category_name'] }} / <span
                                class="text-white badge badge-sm bg-gradient-info">{{ $book_cate_item->books_count }}</span>
                            Books</h6>

                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Number</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Author</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th class="text-secondary opacity-7"></th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($book_cate_item->books as $ebook)
                                        <tr>
                                            <td>
                                                <p class="text-l font-weight-bold mb-0" style="margin-left: 30px">
                                                    {{ $i++ }}
                                                </p>
                                            </td>
                                            <td>
                                                <div class="d-flex  py-1">
                                                    <div>
                                                        <img id="img-cover-{{ $ebook->id }}"
                                                            class="avatar avatar-xl me-3" alt="book-1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $ebook->book_name }}</h6>
                                                        <p id="title-{{ $ebook->id }}"
                                                            class="text-xs text-secondary mb-0"></p>
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- <td>
                                                <p class="text-l font-weight-bold mb-0">{{ $ebook->book_name }}
                                                </p>
                                            </td> --}}
                                            <td class="align-middle text-center">
                                                <span id="author-{{ $ebook->id }}"
                                                    class="text-secondary text-l font-weight-bold"></span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($ebook->book_status == 0)
                                                    <span class="badge badge-sm bg-gradient-success"><a class="text-white"
                                                            href="{{ url('/book-offline/' . $ebook->id) }}">Online</a></span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-danger"><a class="text-white"
                                                            href="{{ url('/book-online/' . $ebook->id) }}">Offline</a></span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ url('/admin/book/edit-book/' . $ebook->id) }}"
                                                    class=" badge badge-sl text-secondary font-weight-bold text-l bg-gradient-info text-white"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    Edit
                                                </a>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ url('/delete-book/' . $ebook->id) }}"
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
                @endforeach
            </div>
        </div>
    </div>

    <script type="text/javascript">
        @foreach ($cate as $book_cate_item)
            @foreach ($book_cate_item->books as $ebook)
                var book_{{ $ebook->id }} = ePub("http://localhost/ipub/public/uploads/books/{{ $ebook->book }}");
                console.log()
                var img_cover_{{ $ebook->id }} = document.getElementById("img-cover-{{ $ebook->id }}");
                book_{{ $ebook->id }}.coverUrl().then(function(url) {
                    img_cover_{{ $ebook->id }}.src = url;
                })
                var title_{{ $ebook->id }} = document.getElementById("title-{{ $ebook->id }}");
                var author_{{ $ebook->id }} = document.getElementById("author-{{ $ebook->id }}");
                book_{{ $ebook->id }}.loaded.metadata.then(function(meta) {
                    title_{{ $ebook->id }}.textContent = meta.title;
                    author_{{ $ebook->id }}.textContent = meta.creator;
                    // console.log(meta);
                })
            @endforeach
        @endforeach
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            var side_bar_item_active = $("ul li.nav-item a.active");
            // side_bar_item.addClass('hello')
            // side_bar_item.removeClass('active');
            var side_bar_item = $("#books");
            side_bar_item_active.removeClass('active');
            side_bar_item.addClass('active');
        });
        const myTimeout = setTimeout(nofty, 1500);

        function nofty() {
            try {
                document.getElementById("alert").remove();
            } catch (error) {

            }
        }
    </script>
@endsection
